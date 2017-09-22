<?php
namespace SDES\ServicesTheme\ThemeCustomizer;

require_once( get_stylesheet_directory() . '/functions/rest-api.php' );
	use SDES\ServicesTheme\API;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\Campaign;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

/**
 * Helper class for Front Page.
 */
class FrontPage_Settings {
	/**
	 * Load scripts only needed on the front page (for the Angular app).
	 * @see wp_enqueue_scripts
	 */
	public static function front_page_scripts() {
		$ng_directory = '/ng-app/';
		$baseURL = get_stylesheet_directory_uri() . $ng_directory;
		// Polyfills - see https://angular.io/docs/ts/latest/guide/browser-support.html
		wp_enqueue_script( 'core-js-shim', 'https://cdn.jsdelivr.net/core-js/2.4.1/shim.min.js' );
		wp_enqueue_script( 'polfyill-classList', 'https://cdn.jsdelivr.net/classlist/2014.01.31/classList.min.js' );
		wp_enqueue_script( 'polfyill-intl', 'https://cdn.polyfill.io/v2/polyfill.min.js?features=Intl.~locale.en' );
		wp_enqueue_script( 'polyfill-animations', 'https://cdn.jsdelivr.net/web-animations/2.2.2/web-animations.min.js' );
		wp_script_add_data( 'polyfill-animations', 'conditional', 'gte IE 10' );
		wp_enqueue_script( 'polyfill-typedarray', 'https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.30/polyfill.min.js' ); // Or 'https://cdn.rawgit.com/inexorabletash/polyfill/0.1.30/polyfill.min.js');
		wp_enqueue_script( 'polyfill-blob', 'https://cdn.rawgit.com/eligrey/Blob.js/079824b6c118fbcd0b99c561d57ad192d2c6619b/Blob.js' );
		wp_enqueue_script( 'polyfill-formdata', 'https://cdn.rawgit.com/francois2metz/html5-formdata/9eee5d49070825a07a794cfa5decf0fd2c045463/formdata.js' );
		// Angular 2 dependencies
		wp_enqueue_script( 'reflect-metadata', 'https://unpkg.com/reflect-metadata@0.1.3/Reflect.js' );
		// SystemJS Dependency loader (for ES6 style modules).
		wp_enqueue_script( 'systemjs', 'https://unpkg.com/systemjs@0.19.31/dist/system.js' );
		// wp_enqueue_script('config', get_stylesheet_directory_uri() . $ng_directory . 'config.js');
		wp_enqueue_script( 'config-cdn', get_stylesheet_directory_uri() . $ng_directory . 'config.cdn.js' );
		wp_enqueue_script( 'config-local', get_stylesheet_directory_uri() . $ng_directory . 'config.ucf_local.js' ); // Set window.ucf_local_config.
		wp_add_inline_script('config-local',
		"jQuery(document).ready(function(){
			System.baseURL = '" . $baseURL . "';
				System.config(window.ucf_local_config); // Uncomment to load config.ucf_local.js instead of config.cdn.js.
				System.import('" . $baseURL . "main')
					  .then(
					  	function( success ) { 
					    },
					  	function( cdnErr ) {
							// Local fallbacks. See: https://github.com/systemjs/systemjs/issues/986#issuecomment-168422454
							System.config(window.ucf_local_config);
							System.import('" . $baseURL . "main')
								  .then(
								  	function ( success ) { console.info('Successfully loaded from local files after CDN failure: ', cdnErr ); }
								  , function( err ) {
								  	console.error( 'Failed loading from CDN: ', cdnErr );
								  	console.error( err );
								  } );
					  });
		});"
		); // /inline_script
	}

	/**
	 * Fetch and format settings used by the Angular app, and store in NG_APP_SETTINGS.
	 */
	public static function front_page_settings() {
		// Load settings.
		$search_query = array_key_exists( 'q', $_REQUEST ) ? $_REQUEST['q'] : '';
		$search_default = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-search_default', '' );
		$services_limit = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-services_limit', 200 );
		$ucf_search_lead = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_lead',
		'From orientation to graduation, the UCF experience creates<br>opportunities that last a lifetime. <b>Let\'s get started</b>.' );
		$ucf_search_placeholder = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_placeholder', 'What can we help you with today?' );
		
		// Build REST request object.
		$request = new \WP_REST_Request();
		$request_search = ( '' !== $search_query ) ? $search_query : $search_default;
		$request->set_query_params( array( 'limit' => $services_limit, 'search' => $request_search ) );
		// Send request directly to API backend.
		$services_contexts = API\route_services_summary( $request );

		$ucf_searchResults_initial = $services_contexts;
		$ucf_searchSuggestions = API\route_services_titles();
		$ucf_service_categories = API\route_categories();
		global $post;
		$ucf_campaign_primary = Campaign::get_render_context( get_post( get_post_meta( $post->ID, 'page_campaign_primary', true ) ) );
		$ucf_campaign_sidebar = Campaign::get_render_context( get_post( get_post_meta( $post->ID, 'page_campaign_sidebar', true ) ) );

		$NG_APP_SETTINGS = array(
			'ucf_searchResults_initial' => $ucf_searchResults_initial,
			'ucf_searchSuggestions' => $ucf_searchSuggestions,
			'ucf_service_categories' => $ucf_service_categories,
			'ucf_search_lead' => wp_kses_post( $ucf_search_lead ),
			'ucf_search_placeholder' => esc_attr( $ucf_search_placeholder ),
			'ucf_campaign_primary' => $ucf_campaign_primary,
			'ucf_campaign_sidebar' => $ucf_campaign_sidebar,
			'search_query' => $search_query,
			'search_default' => $search_default,
			'services_contexts' => $services_contexts,
			'services_limit' => $services_limit,
		);

		// Set NG_APP_SETTINGS for consumption by Angular's javascript via front_page_settings.js
		wp_enqueue_script( 'front-page-settings', get_stylesheet_directory_uri() . '/js/front_page_settings.js');
		wp_localize_script( 'front-page-settings', 'NG_APP_SETTINGS',  $NG_APP_SETTINGS );

		// Return NG_APP_SETTINGS for consumption by PHP.
		return $NG_APP_SETTINGS;
	}
}
