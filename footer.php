<?php
/**
 * The Footer contents provided to WordPress' get_footer() function.
 *
 * graphviz.gv: "footer.php" -> { "footer-settings.php"; "class-sdes-static.php"; "Gravity Forms Plugin"; };
 */

require_once( get_stylesheet_directory() . '/footer-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\Footer as Footer;
	use SDES\ServicesTheme\ThemeCustomizer\Footer_Settings as Footer_Settings;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

?>
	<footer class="site-footer">
		<div class="container">
			<div class="row">
				<div class="wrapper">
					<div class="col-sm-4">
						<div class="footer-col left-col">
							<h2>News</h2>
							<?php Footer::display_footer_news(); ?>
						</div>
						<a class="all-link" href="http://today.ucf.edu">More News &rsaquo;</a>
					</div>
					<div class="col-sm-4">
						<div class="footer-col center-col">
							<h2>Events</h2>
							<?php Footer::display_footer_events(); ?>
						</div>
						<a class="all-link more-events-link" href="http://events.ucf.edu">More Events &rsaquo;</a>
					</div>
					<div class="col-sm-4">
						<div class="footer-col right-col">
							<h2>Contact Us</h2>
							<?php Footer::display_contact_info(); ?>
							<h2>Questions and Comments</h2>
							<?php Footer::display_contact_form(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-site-footer">
			<div class="container">
				<p class="main-site-title">University of Central Florida</p>
				<?php Footer::display_social(); ?>
				<?php Footer::display_footer_menu() ; ?>
			</div>
		</div>
	</footer>

<?php
	/* Instead of adding scripts or styles here, call: `add_action('wp_footer', 'YOUR_FUNCTION');`
	 * Always call 'wp_footer' just before the closing </body> tag or it may break plugins and themes.
	 * See: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer
	 */
	do_action( 'wp_footer' );
?>
</body>
</html>
