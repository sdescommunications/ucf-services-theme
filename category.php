<?php
/**
 * Show posts for a category.
 * @see http://stackoverflow.com/a/8832952
 * @see https://codex.wordpress.org/Category_Templates#What_categories_do_you_show_to_the_visitors.3F
 */

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

<style>
	.site-header { margin-bottom: 0; padding-bottom: 0; }
</style>
<header class="site-header">
	<div class="header-image" style="background-image: url(<?= \header_image(); ?>);">
		<div class="header-center">
			<div class="title-wrapper">
				<div class="title-header-container">
					<h1 class="site-title">
						<a href="<?= $cat_link ?>"><?= $cat_name ?></a>
					</h1>
				</div>
			</div>
		</div>
	</div>
</header>


<main>
	<nav id="student_service-navbar" class="navbar navbar-gold">
		<div class="container-fluid">
			<div class="navbar-header">
				<span class="navbar-title">Skip To Section</span>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#student_service-menu">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse header-center" id="student_service-menu">
				<ul class="nav navbar-nav">
					<li><a href="<?= bloginfo( 'url' ); ?>"><?= bloginfo( 'name' ); ?></a></li>
					<li><a href="<?= $cat_link ?>"><?= $cat_name ?></a></li>
				</ul>
				<?= WeatherBox::display_weather() ?>
			</div>
	</nav>

	<article>
		<h1 class='title'><?= single_cat_title() ?></h1>
		<p class='description'><?= category_description() ?></p>
	<?php
		$args = array ( 'post_type' => StudentService::NAME, 'category' => $cat_id );
		$category_posts = get_posts( $args );
		if ( 0 !== count( $category_posts ) ) :
			foreach( $category_posts as $post ) :	setup_postdata($post);
				echo StudentService::toHTML( $post );
			endforeach;
		else:
			SDES_Static::Get_No_Posts_Message();
		endif;
		wp_reset_postdata();
	?>

	</article>
</main>
<?php
get_footer();
