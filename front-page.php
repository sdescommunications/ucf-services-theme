<?php
/**
 * Display the Front Page of the site, per the WordPress Template Hierarchy.
 */
require_once( get_stylesheet_directory() . '/header-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\Header as Header;
require_once( get_stylesheet_directory() . '/front-page-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\FrontPage_Settings as FrontPage_Settings;
require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;
require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static;
$NG_APP_SETTINGS = FrontPage_Settings::front_page_settings();  // Store NG_APP_SETTINGS for use by PHP pre-rendering.
add_action( 'wp_enqueue_scripts', 'SDES\ServicesTheme\ThemeCustomizer\FrontPage_Settings::front_page_scripts' );
get_header();
// WordPress does not allow "<br>" tags within bloginfo('name'), so allow setting width.
$sitetitle_anchor_maxwidth = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-sitetitle_anchor_maxwidth', '360px' );
?>
<style>
	.header-center a {
		max-width: <?= $sitetitle_anchor_maxwidth ?> !important;
	}

	@media (max-width: 767px) {
	  .campaign {
	    display:none;
	  }
	}

</style>
<header class="site-header">
	<div class="header-image" >

		<video id="video" autoplay preload="auto" loop muted>
             <!-- <source src="vid/video.webm" type="video/webm" /> -->
             <source src="http://assets.sdes.ucf.edu/video/003.mp4" type="video/mp4" />
             Your browser does not support the video tag. Please upgrade your browser.
         </video>
 
         <style type="text/css">
  		
 			.header-image video {
 
 			    position: absolute;
 			    z-index: -1;
 			    background: url(http://assets.sdes.ucf.edu/video/bg.jpg) no-repeat;
 			    background-size: 100% 100%;
 			    top: -170px;
 			    left: 0px;
 			    min-width: 100%;
 			    min-height: 55%;
 			    width: auto;
 			    height: auto;
 
 			}
 
 			.search .search-lead {
 			    font-family: "gotham_lightregular", helvetica, arial, sans-serif;
 			    margin: 30px auto;
 			    display: block;
 			    text-align: center;
 			    font-size: 27px;
 			    letter-spacing: 1px;
 			}
 
 
 			.search {
 			    padding: 0;
 			    border-bottom: 0;
 			    margin: 0 0 70px 0;
 			}
 
 
 
 			.site-header {
 			    padding-bottom: 0px;
 			    margin-bottom: 30px;
 			    position: relative;
 			    display: block;
 			    overflow: hidden;
 			}
 
		</style>

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

<?php
	$student_services_api = get_rest_url() . 'rest/v1/services/summary';
?>
<main>
	<div class="container">
	<ucf-app-student-services 
		[results]='initialResults'
		[api]='<?= $student_services_api ?>'
		[query]='<?= $NG_APP_SETTINGS["search_query"] ?>'
		[defaultQuery]='<?= $NG_APP_SETTINGS["search_default"] ?>'
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