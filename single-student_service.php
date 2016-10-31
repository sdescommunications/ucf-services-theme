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
		<div class="navbar-header">
			<span class="navbar-title">Navigation</span>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#student_service-menu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
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
			  echo StudentService::toPageHTML( $post );
	endwhile;
	else :
		SDES_Static::Get_No_Posts_Message();
	endif; ?>
	</article>
	</div>
</main>
<?php
get_footer();
