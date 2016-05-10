<?php
/**
 * The Footer contents provided to WordPress' get_footer() function.
 *
 * graphviz.gv: "footer.php" -> { "footer-settings.php"; "class-sdes-static.php"; };
 */

require_once( get_stylesheet_directory() . '/footer-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\Footer_Settings as Footer_Settings;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

/**
 * Logic for displaying footer elements.
 */
class Footer {
	/**
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L155-L185
	 */
	public static function display_footer_news() {
		$max_news = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-news_max_items', '' );
		$items = Footer_Settings::get_news(0, $max_news);
		$placeholder = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-news_placeholder_image', '' );
		ob_start();
	?>
		<div class="footer-news">
		<?php foreach( $items as $key=>$item ) : $image = SDES_Static::get_article_image( $item ); ?>
			<a href="<?php echo $item->get_link(); ?>">
				<div class="row news-item">
					<div class="col-xs-2 col-sm-4 col-md-3">
						<div class="news-thumbnail">
						<?php if ( $image ) : ?>
							<img class="img-responsive" src="<?php echo $image; ?>" alt="Feed image for <?php echo $item->get_title(); ?>">
						<?php else : ?>
							<img class="img-responsive" src="<?php echo $placeholder; ?>" alt="UCF Today">
						<?php endif; ?>
						</div>
					</div>
					<div class="col-xs-10 col-sm-8 col-md-9">
						<div class="news-details">
							<h3><?php echo $item->get_title(); ?></h3>
						</div>
					</div>
				</div>
			</a>
		<?php endforeach; ?>
		</div>
	<?php
		echo ob_get_clean();
	}
}
?>
	</main>
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
							<?php //display_footer_events(); ?>
						</div>
						<a class="all-link more-events-link" href="http://events.ucf.edu">More Events &rsaquo;</a>
					</div>
					<div class="col-sm-4">
						<div class="footer-col right-col">
							<h2>Contact Us</h2>
							<?php //display_contact_info(); ?>
							<h2>Questions and Comments</h2>
							<?php //display_contact_form(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-site-footer">
			<div class="container">
				<p class="main-site-title">University of Central Florida</p>
				<?php //display_social(); ?>
				<?php //display_footer_menu() ; ?>
			</div>
		</div>

<?php wp_footer(); ?>
</body>
</html>
