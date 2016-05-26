<?php
/**
 * The Footer contents provided to WordPress' get_footer() function.
 *
 * graphviz.gv: "footer.php" -> { "footer-settings.php"; "class-sdes-static.php"; "Gravity Forms Plugin"; };
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
		$max_news = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-news_max_items', 3 );
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

	public static function display_footer_events() {
	    $max_events = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-events_max_items', 4 );
	    $items = Footer_Settings::get_events( 0, $max_events );
	    ob_start();
	?>
	    <div class="footer-events">
	    <?php foreach( $items as $item ) : ?>
	        <?php
	            $month = $item->get_date( 'M' );
	            $day = $item->get_date( 'j' );
	            $start_date = $item->get_item_tags( 'http://events.ucf.edu', 'startdate' );
	        	$end_date = $item->get_item_tags( 'http://events.ucf.edu', 'enddate' );
	        	$start_time = date( 'g:i a', strtotime( $start_date[0]['data'] ) );
	        	$end_time = date( 'g:i a', strtotime( $end_date[0]['data'] ) );
	        	$time_string = '';
	        	if ( $start_time == $end_time ) {
	        		$time_string = $start_time;
	        	} else {
	        		$time_string = $start_time . ' - ' . $end_time;
	        	}
	        ?>
	        <a href="<?php echo $item->get_link(); ?>" target="_blank">
	        	<div class="row event">
		        	<div class="col-xs-2 col-sm-4 col-md-3">
		        		<div class="event-date">
		        			<span class="month"><?php echo $month; ?></span>
		                	<span class="day"><?php echo $day; ?></span>
		               	</div>
		        	</div>
		        	<div class="col-xs-10 col-sm-8 col-md-9">
		        		<div class="event-details">
			                <h4><?php echo $item->get_title(); ?></h4>
			                <?php
			                ?>
			                <p class="time"><?php echo $time_string; ?></p>
			            </div>
		        	</div>
		    	</div>
		    </a>
	    <?php endforeach; ?>
	    </div>
	<?php
	    echo ob_get_clean();
	}

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L233-L244
	 */
	public static function display_contact_info() {
		$org_name  = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-organization_name', '' );
		$org_phone = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-organization_phone', '' );
		$org_email = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-organization_email', '' );
		ob_start();
	?>
		<h2 class="org-name"><?php echo $org_name; ?></h2>
		<p>Phone: <a class="read-more" href="tel:<?php echo str_replace( array( '-', '(', ')' ), '', $org_phone);?>"><?php echo $org_phone; ?></a></p>
		<p>Email: <a class="read-more" href="mailto:<?php echo $org_email; ?>"><?php echo $org_email; ?></a></p>
	<?php
		echo ob_get_clean();
	}

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L246-L249
	 */
	public static function display_contact_form() {
		$form_id = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-footer_contact_form', '' );
		echo do_shortcode( '[gravityform id="'.$form_id.'" title="false" description="false"]' );
	}

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L251-L307
	 */
	public static function display_social() {
		$prefix = 'services_theme-social_';
		$facebook_url   = SDES_Static::get_theme_mod_defaultIfEmpty( $prefix . 'facebook_url', '' );
		$twitter_url    = SDES_Static::get_theme_mod_defaultIfEmpty( $prefix . 'twitter_url', '' );
		$googleplus_url = SDES_Static::get_theme_mod_defaultIfEmpty( $prefix . 'googleplus_url', '' );
		$linkedin_url   = SDES_Static::get_theme_mod_defaultIfEmpty( $prefix . 'linkedin_url', '' );
		$instagram_url  = SDES_Static::get_theme_mod_defaultIfEmpty( $prefix . 'instagram_url', '' );
		$pinterest_url  = SDES_Static::get_theme_mod_defaultIfEmpty( $prefix . 'pinterest_url', '' );
		$youtube_url    = SDES_Static::get_theme_mod_defaultIfEmpty( $prefix . 'youtube_url', '' );
		ob_start();
	?>
		<div class="social">
		<?php if ( $facebook_url ) : ?>
			<a href="<?php echo $facebook_url; ?>" target="_blank" class="social-icon ga-event-link">
				<span class="fa fa-facebook"></span>
				<span class="sr-only">Like us on Facebook</span>
			</a>
		<?php endif; ?>
		<?php if ( $twitter_url ) : ?>
			<a href="<?php echo $twitter_url; ?>" target="_blank" class="social-icon ga-event-link">
				<span class="fa fa-twitter"></span>
				<span class="sr-only">Follow us on Twitter</span>
			</a>
		<?php endif; ?>
		<?php if ( $googleplus_url ) : ?>
			<a href="<?php echo $googleplus_url; ?>" target="_blank" class="social-icon ga-event-link">
				<span class="fa fa-google-plus"></span>
				<span class="sr-only">Follow us on Google+</span>
			</a>
		<?php endif; ?>
		<?php if ( $linkedin_url ) : ?>
			<a href="<?php echo $linkedin_url; ?>" target="_blank" class="social-icon ga-event-link">
				<span class="fa fa-linkedin"></span>
				<span class="sr-only">View our LinkedIn page</span>
			</a>
		<?php endif; ?>
		<?php if ( $instagram_url ) : ?>
			<a href="<?php echo $instagram_url; ?>" target="_blank" class="social-icon ga-event-link">
				<span class="fa fa-instagram"></span>
				<span class="sr-only">View our Instagram page</span>
			</a>
		<?php endif; ?>
		<?php if ( $pinterest_url ) : ?>
			<a href="<?php echo $pinterest_url; ?>" target="_blank" class="social-icon ga-event-link">
				<span class="fa fa-pinterest-p"></span>
				<span class="sr-only">View our Pinterest page</span>
			</a>
		<?php endif; ?>
		<?php if ( $youtube_url ) : ?>
			<a href="<?php echo $youtube_url; ?>" target="_blank" class="social-icon ga-event-link">
				<span class="fa fa-youtube"></span>
				<span class="sr-only">View our YouTube page</span>
			</a>
		<?php endif; ?>
		</div>
	<?php
		echo ob_get_clean();
	}

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L137-L153
	 */
	public static function display_footer_menu() {
		$menu = Footer_Settings::get_remote_menu( 'services_theme-remote_menus_footer_menu' );
		if ( empty( $menu) ) {
			return;
		}
		ob_start();
	?>
		<ul class="list-inline site-footer-menu">
		<?php foreach( $menu->items as $item ) : ?>
			<li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	<?php
		echo ob_get_clean();
	}
}
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

<?php wp_footer(); ?>
</body>
</html>
