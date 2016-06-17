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

// WordPress does not allow "<br>" tags within bloginfo('name'), so allow setting width.
$sitetitle_anchor_width = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-sitetitle_anchor_width', '400px' );
$sitetitle_anchor_maxwidth = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-sitetitle_anchor_maxwidth', '460px' );
$frontsearch_lead = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_lead',
	'From orientation to graduation, the UCF experience creates<br>opportunities that last a lifetime. <b>Let\'s get started</b>.' );
$frontsearch_placeholder = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-frontsearch_placeholder', 'What can we help you with today?' );
get_header();
?>
<style>
	.header-center a {
		width: <?= $sitetitle_anchor_width ?>;
		max-width: <?= $sitetitle_anchor_maxwidth ?>;
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
	<article class="row page-wrap">
		<section id="search-frontpage" class="container-fluid">
			<div class="row search">
				<div class="col-md-10 col-md-offset-1">
					<div class="search-lead"><?=  $frontsearch_lead ?></div>
				</div>
				<div class="col-md-6 col-md-offset-3 search-bar">
					<div class="search-bar">
						<form action="#">
							<button class="fa fa-search"></button>
							<input type="search" class="form-control" placeholder="<?= $frontsearch_placeholder ?>">
						</form>
					</div>
				</div>
			</div>
		</section> <!-- /.search -->

		<div class="container-fluid">
		  <div class="row">
			<section id="filter" class="col-md-3 col-md-push-9 side-bar">
				<span class="filter-by">
					<h2>Filter By</h2>
					<div class="panel panel-default">
						<ul class="list-group">
							<?php
							$categories = get_categories( array(
								'orderby' => 'name',
								'exclude' => array( 1, ), // Uncategorized.
								'parent' => 0,
								'taxonomy' => 'category',
							) );
							if ( null !== $categories ) :
							  foreach ( $categories  as $category ) : ?>
								<li class="cat-item cat-item-<?= $category->cat_ID ?>">
									<input class="filter-checkbox" type="checkbox" id="filter-services-<?= $category->cat_ID ?>">
									<label class="list-group-item filter-label" for="filter-services-<?= $category->cat_ID ?>">
											<?= $category->name ?>
									</label>
								</li>
							<?php endforeach;
							else:
								 echo '<!-- No categories -->';
							endif; ?>
						</ul>
					</div>
				</span>
				<div class="clearfix"></div>

				<div class="row">
					<div class="col-xs-12">
					<?php
						global $post;
						echo Spotlight::toHTML( get_post_meta( $post->ID, 'page_spotlight', true ) );
					?>
					</div>
				</div>
			</section> <!-- /#filter -->

			<section id="services" class="col-sm-12 col-md-9 col-lg-9 col-md-pull-3">
				<h2 class="title"><?= the_title() ?></h2>
				<?php if (have_posts()) :
					 while (have_posts()) : the_post();
						the_content();
					endwhile;
				else:
					SDES_Static::Get_No_Posts_Message();
				endif; ?>
			</section> <!-- /#services -->
		  </div>
		</div>
	</article>
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
