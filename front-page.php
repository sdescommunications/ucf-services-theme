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
	<h2 class="title"><?= the_title() ?></h2>
	<?php if (have_posts()) :
		 while (have_posts()) : the_post();
			the_content();
		endwhile;
	else:
		SDES_Static::Get_No_Posts_Message();
	endif; ?>
</article>

<aside class="col-md-2 col-xs-12">
	<div class="row filter-by">
		<h2>Filter By</h2>
		<ul>
			<?= wp_list_categories( array(
					'show_option_none' => '<!-- No categories -->',
					'orderby' => 'title',
					'exclude' => array( 1, ),
					'title_li' => '',
					'depth' => 1,
					'taxonomy' => 'category',
				) )
			?>
		</ul>
	</div>
	<div class="clearfix"></div>
	<style>
		.spotlight-wrapper { position: relative; }
	</style>
	<div class="row">
		<div class="spotlight-wrapper">
		<?php
			global $post;
			echo Spotlight::toHTML( get_post_meta( $post->ID, 'page_spotlight', true ) );
		?>
		</div>
	</div>
</aside>
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
