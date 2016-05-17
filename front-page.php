<?php
/**
 * Display the Front Page of the site, per the WordPress Template Hierarchy.
 */

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static;

get_header();
?>
<article>

<!-- content area -->
<div class="container site-content" id="content">

</div> <!-- /DIV.container.site-content -->

<?php if (have_posts()) :
	 while (have_posts()) : the_post();
		the_content();
	endwhile;
else:
	SDES_Static::Get_No_Posts_Message();
endif; ?>

</article>
<?php
get_footer();
