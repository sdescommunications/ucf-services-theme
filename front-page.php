<?php
/**
 * Display the Front Page of the site, per the WordPress Template Hierarchy.
 */

require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\Spotlight;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static;

get_header();
?>
<header class="site-header">
	<div class="header-image" style="background-image: url(<?= \header_image(); ?>);">
		<div class="header-center">
			<div class="title-wrapper">
				<div class="title-header-container">
					<h1 class="site-title">
						<a href="<?= \bloginfo( 'url' ); ?>"><?= \bloginfo( 'name' ); ?></a>
					</h1>
					<?= WeatherBox::display_weather(); ?>
				</div>
			</div>
		</div>
	</div>
</header>


<main>

<article class="col-md-9 col-xs-12">
	<?php if (have_posts()) :
		 while (have_posts()) : the_post();
			the_content();
		endwhile;
	else:
		SDES_Static::Get_No_Posts_Message();
	endif; ?>
</article>

<aside class="col-md-2 col-xs-12">
	<?php
		global $post;
		echo Spotlight::toHTML( get_post_meta( $post->ID, 'page_spotlight', true ) );
	?>
</aside>
</main>
<div class="clearfix"></div>

<?php
	$icon_links[0] = '77'; // SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-', '' );
	$icon_links[1] = '79';
	$icon_links[2] = '81';
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
