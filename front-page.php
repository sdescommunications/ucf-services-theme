<?php
/**
 * Display the Front Page of the site, per the WordPress Template Hierarchy.
 */

require_once( get_stylesheet_directory() . '/header-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\Header as Header;

require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;

require_once( get_stylesheet_directory() . '/functions/rest-api.php' );
	use SDES\ServicesTheme\API;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\Campaign;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static;

// WordPress does not allow "<br>" tags within bloginfo('name'), so allow setting width.
$sitetitle_anchor_maxwidth = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-sitetitle_anchor_maxwidth', '360px' );
$frontsearch_lead = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_lead',
	'From orientation to graduation, the UCF experience creates<br>opportunities that last a lifetime. <b>Let\'s get started</b>.' );
$frontsearch_placeholder = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_placeholder', 'What can we help you with today?' );
$student_services_api = get_rest_url() . 'rest/v1/services/summary'; // The API attribute for ucf-app-student-services.

	function header_load_scripts() {
		$ng_directory = '/ng-app/';
		$baseURL = get_stylesheet_directory_uri() . $ng_directory;
		// Polyfills - see https://angular.io/docs/ts/latest/guide/browser-support.html
		wp_enqueue_script('core-js-shim', 'https://cdn.jsdelivr.net/core-js/2.4.1/shim.min.js');
		wp_enqueue_script('polfyill-classList', 'https://cdn.jsdelivr.net/classlist/2014.01.31/classList.min.js');
		wp_enqueue_script('polfyill-intl', 'https://cdn.polyfill.io/v2/polyfill.min.js?features=Intl.~locale.en');
		wp_enqueue_script('polfyill-animations', 'https://cdn.jsdelivr.net/web-animations/2.2.2/web-animations.min.js');
		wp_enqueue_script('polyfill-typedarray', 'https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.27/polyfill.min.js'); // Or 'https://cdn.rawgit.com/inexorabletash/polyfill/0.1.27/polyfill.min.js');
		wp_enqueue_script('polyfill-blob', 'https://cdn.rawgit.com/eligrey/Blob.js/079824b6c118fbcd0b99c561d57ad192d2c6619b/Blob.js');
		wp_enqueue_script('polyfill-formdata', 'https://cdn.rawgit.com/francois2metz/html5-formdata/9eee5d49070825a07a794cfa5decf0fd2c045463/formdata.js');
		// Angular 2 dependencies
		wp_enqueue_script('zonejs', 'https://unpkg.com/zone.js@0.6.21/dist/zone.js');
		wp_enqueue_script('reflect-metadata', 'https://unpkg.com/reflect-metadata@0.1.3/Reflect.js');
		// SystemJS Dependency loader (for ES6 style modules).
		wp_enqueue_script('systemjs', 'https://unpkg.com/systemjs@0.19.31/dist/system.js');
		// wp_enqueue_script('config', get_stylesheet_directory_uri() . $ng_directory . 'config.js');
		wp_enqueue_script('config-cdn', get_stylesheet_directory_uri() . $ng_directory . 'config.cdn.js');
		wp_enqueue_script('config-local', get_stylesheet_directory_uri() . $ng_directory . 'config.ucf_local.js'); // Set window.ucf_local_config.
		wp_enqueue_script('ng2-bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/ng2-bootstrap/1.1.4/ng2-bootstrap.min.js');
		wp_add_inline_script('config-local',
			"System.baseURL = '" . $baseURL . "';
			// System.config(window.ucf_local_config); // Uncomment to load config.ucf_local.js instead of config.cdn.js.
			System.import('" . $baseURL . "/main')
				  .then(
				  	function( success ) { 
				    },
				  	function( cdnErr ) {
						// Local fallbacks. See: https://github.com/systemjs/systemjs/issues/986#issuecomment-168422454
						System.config(window.ucf_local_config);
						System.import('" . $baseURL . "/main')
							  .then(
							  	function ( success ) { console.info('Successfully loaded from local files after CDN failure: ', cdnErr ); }
							  , function( err ) {
							  	console.error( 'Failed loading from CDN: ', cdnErr );
							  	console.error( err );
							  } );
				  });"
		); // /inline_script
	}
	add_action('wp_enqueue_scripts', 'header_load_scripts');
	
get_header(); 
?>

<script>
<?php
	// Load settings.
	$services_limit = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-services_limit', 7 );
	$search_default = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-search_default', "" );  // Also sent to defaultQuery attribute for ucf-app-student-services.
	// Build REST request object.
	$request = new \WP_REST_Request();
	$search_query = array_key_exists("q", $_REQUEST) ? $_REQUEST["q"] : "";  // Also sent to query attribute for ucf-app-student-services.
	$request_search = ("" !== $search_query ) ? $search_query : $search_default;
	$request->set_query_params( array( "limit" => $services_limit, 'search' => $request_search ) );
	// Send request directly to API backend.
	$services_contexts = API\route_services_summary( $request );

	$json_services = json_encode( $services_contexts );
	$search_suggestions = API\route_services_titles();
	$categories = API\route_categories();
	$campaign_primary = Campaign::get_render_context( get_post( get_post_meta( $post->ID, 'page_campaign_primary', true ) ) );
	$campaign_sidebar = Campaign::get_render_context( get_post( get_post_meta( $post->ID, 'page_campaign_sidebar', true ) ) );
?>
	window.ucf_searchResults_initial = <?= $json_services ?>;
	window.ucf_searchSuggestions = <?= json_encode( $search_suggestions ) ?>;
	window.ucf_service_categories = <?= json_encode( $categories ) ?>;
	window.ucf_search_lead = "<?= wp_kses_post( $frontsearch_lead ) ?>";
	window.ucf_search_placeholder = "<?= esc_attr( $frontsearch_placeholder ) ?>"; 
	window.ucf_campaign_primary = <?= json_encode( $campaign_primary ) ?>;
	window.ucf_campaign_sidebar = <?= json_encode( $campaign_sidebar ) ?>;

</script>
<style>
	.header-center a {
		max-width: <?= $sitetitle_anchor_maxwidth ?> !important;
	}
</style>
<header class="site-header">
	<div class="header-image" style="background-image: url(<?= \header_image(); ?>);">
		<?php Header::display_nav_header(); ?>
		<div class="container">
			<?php Header::display_nav_header_xs(); ?>
			<div class="header-center">
				<div class="title-wrapper">
					<div class="title-header-container">
						<h1 class="site-title">
							<a href="<?= \bloginfo( 'url' ); ?>">
								<?= \bloginfo( 'name' ); ?>
							</a>
						</h1>
						<?= WeatherBox::display_weather(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<main>
  <div class="container">
	<ucf-app-student-services 
		[results]='initialResults'
		[api]='<?= $student_services_api ?>'
		[query]='<?= $search_query ?>'
		[defaultQuery]='<?= $search_default ?>'
		[title]="<?= the_title() ?>">
		<?php include( get_stylesheet_directory() . '/ng-app/app-student-services/app-student-services.component.php' ); ?>
	</ucf-app-student-services>
  </div>
</main>

<div class="clearfix"></div>

<?php
	$icon_links[0] = get_post_meta( $post->ID, 'page_icon_link-1', true );
	$icon_links[1] = get_post_meta( $post->ID, 'page_icon_link-2', true );
	$icon_links[2] = get_post_meta( $post->ID, 'page_icon_link-3', true );
	echo do_shortcode(
		"[callout color='#ffcc00' text-color='#000000']
			[icon_link icon_link_id='${icon_links[0]}'][/icon_link]
			[icon_link icon_link_id='${icon_links[1]}'][/icon_link]
			[icon_link icon_link_id='${icon_links[2]}'][/icon_link]
		[/callout]"
	);
?>

<?php
get_footer();
