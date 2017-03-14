<?php

require_once( get_stylesheet_directory() . '/header-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\Header as Header;
require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\StudentService;

require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
use SDES\SDES_Static;

$profile_image_default = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-profile_image_default', '' );
$default_header_image =
	( '' !== $profile_image_default )
		?  wp_get_attachment_image_src( $profile_image_default, 'thumbnail-size', true )[0]
		: get_header_image();
$header_image = ( has_post_thumbnail( get_the_id() ) )
	? wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail-size', true )[0]
	: $default_header_image;

$heading_text =
	get_post_meta( get_the_id(), 'student_service_heading_text', true )
	?: get_bloginfo( 'name' );

get_header();
?>
<header class="subpage-header services-page-header">
	<div class="header-image" style="background-image: url(<?= $header_image ?>);">
		<?php Header::display_nav_header(); ?>
		<div class="container">
			<?php Header::display_nav_header_xs(); ?>
			<div class="header-center">
				<div class="title-wrapper">
					<div class="title-header-container">
						<span class="site-title">
								<?= $heading_text ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<main class="services-page">
	<nav id="student_service-navbar" class="navbar navbar-gold breadcrumbs">
	<div class="container">
	  <div class="row">
<!-- 		<div class="navbar-header">
			<span class="navbar-title">Navigation</span>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#student_service-menu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div> -->
	<?php
		$mainCategoryId = get_post_meta( get_the_id(), 'student_service_main_category_id', true );
		$mainCategory = get_term( $mainCategoryId , 'category' );
	?>
		
	<div id="student_service-menu">
		<ul class="nav navbar-nav">
			<li><a href="<?= bloginfo( 'url' ) ?>"><?= bloginfo( 'name' ); ?></a></li>
		<?php if ( $mainCategory && property_exists( $mainCategory, 'name' ) ) : ?>
			<li><a href="<?= get_category_link( $mainCategory ) ?>"><?= $mainCategory->name; ?></a></li>
		<?php endif; ?>
			<li class="active-breadcrumb"><span class="active-pad"><?= the_title(); ?></span></li>
		</ul>
		<div class="navbar-right">
			<?= WeatherBox::display_weather() ?>
		</div>
	</div>
	  </div> <!-- /.row -->
	</div> <!-- /.container -->
	</nav>

	<div class="container">
	<article class="row page-wrap">
	<?php if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			global $post;
			$stusvc_context = StudentService::get_render_context_from_post( $post ); ?>
			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-8 col-xs-12">
					<h1><?= $stusvc_context['title'] ?></h1>
				</div>
				<div class="col-md-4 col-xs-12">
					<?= StudentService::render_like_tweet_share( $stusvc_context ) ?>
				</div>
			  </div>
			</div>
			<!-- / Title and Social -->

			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-4 col-md-push-8 side-bar">
					<div class="row">
						<div class="col-xs-12" style="margin-bottom: 30px;">
							<?= StudentService::render_campaign( $stusvc_context ) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<?= StudentService::render_contact_table( $stusvc_context ) ?>
							<?= StudentService::render_hours_table( $stusvc_context ) ?>
							<?= StudentService::render_social_buttons( $stusvc_context ) ?>
							<?php
							if ( $stusvc_context['events_cal_feed'] ) {
								$max_events = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-events_max_items', 4 );
								$stusvc_context['events']  = array_reverse( FeedManager::get_items( $stusvc_context['events_cal_feed'] ) );
								$stusvc_context['events']  = array_slice( $stusvc_context['events'], 0, $max_events );
								$stusvc_context['academic_cal'] = false;
								$stusvc_context['more_events'] = UcfEventModel::more_link();
								$stusvc_context['events_cal_title'] = 'Events Calendar';
								echo StudentService::render_events_calendar( $stusvc_context );
							} else { echo '<div class="calendar-events" style="display: none;"></div>'; }
							?>
							<?= '<!-- Map -->' // StudentService::render_map( $stusvc_context ); ?>
							<?= StudentService::render_tag_cloud( $stusvc_context ) ?>
							</div>
						</div>
					</div> <!-- /.side-bar -->
					<div class="col-sm-12 col-md-7 col-lg-7 col-md-pull-4">
						<p class="lead"><?= $stusvc_context['short_descr'] ?></p>
						<?= $stusvc_context['long_descr'] ?>

						<?php if ( $stusvc_context['has_additional'] ) : ?>
						<h2>Additional Services</h2>
						<?php foreach ( $stusvc_context['additional'] as $idx => $link ) :
							if ( '' != $link['title'] ) :
							?>
							<div class="additional-<?= $idx ?>">
								<h3 class="external-link"><a href="<?= $link['url'] ?>">
									<?= $link['title'] ?>
								</a></h3>
								<p><?= $link['descr'] ?></p>
							</div>
					<?php endif;
						endforeach;
					endif; ?>

						<div class="gallery"><?= $stusvc_context['gallery']['flickr'] ?></div>
					</div>
				  </div> <!-- /.row -->
				</div> <!-- /.container-fluid -->
	<?php endwhile;
	else :
		SDES_Static::Get_No_Posts_Message();
	endif; ?>
	</article>
	</div>
</main>
<?php
get_footer();
