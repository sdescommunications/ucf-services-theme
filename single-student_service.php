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
