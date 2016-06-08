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
			<li><a href="<?= the_permalink();; ?>"><?= the_title(); ?></a></li>
		</ul>
		<?= WeatherBox::display_weather() ?>
	</div>
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
