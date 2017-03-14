<?php
/**
 * Show posts for a category.
 *
 * @see http://stackoverflow.com/a/8832952
 * @see https://codex.wordpress.org/Category_Templates#What_categories_do_you_show_to_the_visitors.3F
 */

require_once( get_stylesheet_directory() . '/header-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\Header as Header;

require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\StudentService;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
use SDES\SDES_Static;

$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
$cat_link = get_category_link( $category ) ?: bloginfo( 'url' );
$cat_name = single_cat_title( '', false ) ?: 'Student Services';

get_header();
?>

<header class="subpage-header category-page-header">
	<div class="header-image" style="background-image: url(<?= \header_image(); ?>);">
		<?php Header::display_nav_header(); ?>
		<div class="container">
			<?php Header::display_nav_header_xs(); ?>
			<div class="header-center">
				<div class="title-wrapper">
					<div class="title-header-container">
						<span class="site-title">
							<?= $cat_name ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>


<main class="category-page">
	<nav id="category-navbar" class="navbar navbar-gold breadcrumbs">
		<div class="container">
<!-- 			<div class="navbar-header">
				<span class="navbar-title">Skip To Section</span>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#category-menu">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div> -->
			
			<div id="category-menu">
				<ul class="nav navbar-nav">
					<li><a href="<?= bloginfo( 'url' ) ?>"><?= bloginfo( 'name' ) ?></a></li>
					<li><a href="<?= $cat_link ?>"><?= $cat_name ?></a></li>
				</ul>
				<div class="navbar-right">
					<?= WeatherBox::display_weather() ?>
				</div>
			</div>

			<div class="collapse navbar-collapse header-center" id="collapse-menu">
				<ul class="nav navbar-nav">
					<li><a href="<?= bloginfo( 'url' ) ?>"><?= bloginfo( 'name' ) ?></a></li>
					<li><a href="<?= $cat_link ?>"><?= $cat_name ?></a></li>
				</ul>
			</div>
	</nav>
	<div class="container">
	<article class="row page-wrap">
	  <div class="container-fluid">
		<section id="categories" class="col-sm-12 col-md-12 col-lg-12">
			<h1 class='title'><?= single_cat_title() ?></h1>
			<p class='description'><?= category_description() ?></p>
			<?php
			$args = array(
				'post_type' => StudentService::NAME,
				'category' => $cat_id,
				'orderby' => 'post_title',
				'order' => 'ASC',
			);
			$category_posts = get_posts( $args );
			if ( 0 !== count( $category_posts ) ) :
				foreach ( $category_posts as $post ) :	setup_postdata( $post ); ?>
					<?= StudentService::toHTML( $post ); ?>
				<?php endforeach;
			else :
				SDES_Static::Get_No_Posts_Message();
			endif;
			wp_reset_postdata();
			?>
		</section>
	  </div>
	</article>
	</div>
</main>
<?php
get_footer();
