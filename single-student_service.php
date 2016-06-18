<?php


require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\StudentService;

require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );
	use SDES\WeatherBox;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
use SDES\SDES_Static;

get_header();
?>
<main class="site-main">

<div style="height: 300px;"></div>

<nav id="student_service-navbar" class="navbar navbar-gold breadcrumbs">
	<div class="container">
	  <div class="row">
		<div class="navbar-header">
			<span class="navbar-title">Skip To Section</span>
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
			<li><a href="<?= bloginfo( 'url' ); ?>"><?= bloginfo( 'name' ); ?></a></li>
		<?php if ( $mainCategory && property_exists( $mainCategory, 'name' ) ) : ?>
			<li><a href="<?= get_category_link( $mainCategory ); ?>"><?= $mainCategory->name; ?></a></li>
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

<article>

<?php if (have_posts()) :
	 while (have_posts()) : the_post();
		global $post;
		echo StudentService::toHTML( $post );
		echo "<hr><hr>";
		echo StudentService::toPageHTML( $post );
	endwhile;
else:
	SDES_Static::Get_No_Posts_Message();
endif; ?>

</article>
</main>
<?php
get_footer();
