<?php
/**
 * Display the Front Page of the site, per the WordPress Template Hierarchy.
 */

require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;

require_once( get_stylesheet_directory() . '/functions/rest-api.php' );
	use SDES\ServicesTheme\API;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static;

// WordPress does not allow "<br>" tags within bloginfo('name'), so allow setting width.
$sitetitle_anchor_maxwidth = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-sitetitle_anchor_maxwidth', '360px' );
$frontsearch_lead = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_lead',
	'From orientation to graduation, the UCF experience creates<br>opportunities that last a lifetime. <b>Let\'s get started</b>.' );
$frontsearch_placeholder = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_placeholder', 'What can we help you with today?' );
$student_services_api = get_rest_url() . 'rest/v1/services/';
get_header();
?>
<script>
<?php
	$services_limit = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-services_limit', 7 );
	$request = new \WP_REST_Request();
	$search_query = array_key_exists("search", $_REQUEST) ? $_REQUEST["search"] : "";
	$request->set_query_params( array( "limit" => $services_limit, 'search' => $search_query ) );
	$services_contexts = API\route_services( $request );
	$json_services = json_encode( $services_contexts );
	$search_suggestions = API\route_services_titles();
	$categories = API\route_categories();
?>
	window.ucf_searchResults_initial = <?= $json_services ?>;
	window.ucf_searchSuggestions = <?= json_encode( $search_suggestions ) ?>;
	window.ucf_service_categories = <?= json_encode( $categories ) ?>;

</script>
<style>
	.header-center a {
		max-width: <?= $sitetitle_anchor_maxwidth ?> !important;
	}
</style>
<header class="site-header">
	<div class="header-image" style="background-image: url(<?= \header_image(); ?>);">
		<div class="container">
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
