<?php
/**
 * Display the Front Page of the site, per the WordPress Template Hierarchy.
 */

require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;

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
<article>

<?php if (have_posts()) :
	 while (have_posts()) : the_post();
		the_content();
	endwhile;
else:
	SDES_Static::Get_No_Posts_Message();
endif; ?>

</article>
</main>
<?php
get_footer();
