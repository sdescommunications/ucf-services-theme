<?php
/**
 * Default layout, per the WordPress Template Hierarchy.
 * This is a page of last resort, and should be overriden in most cases.
 */

require_once( 'functions/class-sdes-static.php' );
use SDES\SDES_Static;

get_header();
?>
<main>
<article>

<!-- content area -->
<div class="container site-content" id="content">

</div> <!-- /DIV.container.site-content -->

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
else :
	SDES_Static::Get_No_Posts_Message();
endif; ?>

</article>
</main>
<?php
get_footer();
