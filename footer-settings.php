<?php
/**
 * A helper class for the Footer - call from ThemeCustomizer.php to add action to 'customize_register' before it fires.
 *
 * graphviz.gv: "footer-settings.php" -> { "class-feedmanager.php"; "class-sdes-customizer-helper.php"; "class-sdes-static.php"; };
 *
 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions/config.php#L449-L502
 */

namespace SDES\ServicesTheme\ThemeCustomizer;

require_once( get_stylesheet_directory() . '/functions/class-feedmanager.php' );
	use FeedManager;

require_once( get_stylesheet_directory() . '/functions/class-sdes-customizer-helper.php' );
	use SDES\CustomizerControls\SDES_Customizer_Helper;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

class Footer_Settings {
	const NEWS_URL = 'https://today.ucf.edu/feed/';
	const EVENTS_URL = 'http://events.ucf.edu/feed.rss';
	const FOOTER_NAV_URL = 'http://www.ucf.edu/wp-json/ucf-rest-menus/v1/menus/48';

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/functions/feeds.php#L207-L211
	 */
	public static function get_news( $start = null, $limit = null ) {
		$url     = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-news_url', self::NEWS_URL );
		$news    = FeedManager::get_items( $url, $start, $limit );
		return $news;
	}

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/functions/feeds.php#L200-L205
	 */
	public static function get_events( $start = null, $limit = null ) {
		$url     = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-events_url', self::EVENTS_URL );
		$events  = array_reverse( FeedManager::get_items( $url ) );
		$events  = array_slice( $events, $start, $limit );
		return $events;
	}

	/**
	 * Retrieve and cache remote feeds as json objects, e.g., services_theme-remote_menus_footer_menu_feed.
	 *
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L42-L75
	 * @todo Evaluate general PHP alternatives to WP transients (PSR-6 caching).
	 */
	public static function get_remote_menu( $menu_name ) {
		global $wp_customize;
		$customizing = isset( $wp_customize );
		$result_name = $menu_name.'_json';
		$result = get_transient( $result_name );
		if ( false === $result || $customizing ) {
			$opts = array(
				'http' => array(
					'timeout' => 15,
				),
			);
			$context = stream_context_create( $opts );
			$file_location = SDES_Static::get_theme_mod_defaultIfEmpty( $menu_name.'_feed', self::FOOTER_NAV_URL );
			if ( empty( $file_location ) ) {
				return;
			}
			$headers = wp_remote_retrieve_body( wp_remote_get ( $file_location ));//get_headers( $file_location );
			$response_code = substr( $headers[0], 9, 3 );
			if ( $response_code !== '200' ) {
				return;
			}
			$result = json_decode( file_get_contents( $file_location, false, $context ) );
			if ( ! $customizing ) {
				set_transient( $result_name, $result, (60 * 60 * 24) );
			}
		}
		return $result;
	}

	protected static function array_key_default( $key, $array, $default ) {
		return array_key_exists( $key, $array )
			? $array[ $key ]
			: $default;
	}

	public static function register_footer_settings( $wp_customizer ) {
		$panelId = 'footer_panel';
		$wp_customizer->add_panel( $panelId, array(
			'title' => __( 'Footer' ),
			'description' => 'Footer Settings', // Include html tags such as <p>.
			'priority' => 1000, // Mixed with top-level-section hierarchy.
		) );
		$section_args = array( 'panelId' => $panelId );

		// Leave "Remote Menus" outside of the footer panel.
		$footer_section_args = array( 'panelId' => '' );
		static::add_section_remote_menus( $wp_customizer, $footer_section_args );

		static::add_section_events( $wp_customizer, $section_args );

		static::add_section_organization( $wp_customizer, $section_args );

		static::add_section_news( $wp_customizer, $section_args );

		static::add_section_social( $wp_customizer, $section_args );

		static::add_section_contact( $wp_customizer, $section_args );

	}

	public static function add_section_remote_menus( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-remote_menus';
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'Remote Menus',
				'description' => '',
				'priority' => 1000, // Set to 30 to be just below "Site Identity".
				'panel' => static::array_key_default( 'panelId', $args, '' ),
			)
		);
		/** ARGS */
		$remote_menus_footer_menu_feed_args = static::array_key_default( 'services_theme-remote_menus_footer_menu_feed', $args, '' );
		SDES_Static::set_default_keyValue_array( $remote_menus_footer_menu_feed_args, array(
			'default' => self::FOOTER_NAV_URL,
			'description' => 'The JSON feed of the www.ucf.edu footer menu.',
		));

		/** FIELDS */
		// remote_menus_footer_menu_feed
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-remote_menus_footer_menu_feed',	// Id.
			'Footer Menu Feed',	// Label.
			$section,			// Section.
			$remote_menus_footer_menu_feed_args	// Arguments array.
		);
	}

	public static function add_section_events( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-events';
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'Events',
				'description' => 'Settings for event lists used throughout the site.',
				'priority' => 400,
				'panel' => static::array_key_default( 'panelId', $args, '' ),
			)
		);
		/** ARGS */
		$events_max_items_args = static::array_key_default( 'services_theme-events_max_items', $args, '' );
		SDES_Static::set_default_keyValue_array( $events_max_items_args, array(
			'control_type' => 'select',
			'default' => 4,
			'description' => 'Maximum number of events to display when outputting event information.',
			'choices'     => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
			),
		));

		$events_url_args = static::array_key_default( 'services_theme-events_url', $args, '' );
		SDES_Static::set_default_keyValue_array( $events_url_args, array(
			'default' => self::EVENTS_URL,
			'description' => 'Base URL for the calendar you wish to use. Example: <em>http://events.ucf.edu/mycalendar</em>',
		));

		/** FIELDS */
		// events_max_items
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-events_max_items',					// Id.
			__( 'Events Max Items' ),	// Label.
			$section,				// Section.
			$events_max_items_args	// Arguments array.
		);

		// Events_url
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-events_url',	// Id.
			'Events Calendar URL',			// Label.
			$section,			// Section.
			$events_url_args	// Arguments array.
		);
	}

	/**
	 * @todo Compare against BaseTheme's `Contact Info` for ideas/improvements.
	 */
	public static function add_section_organization( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-organization';
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'Organization Info',
				'description' => 'Contact information',
				'priority' => 600,
				'panel' => static::array_key_default( 'panelId', $args, '' ),
			)
		);
		/** ARGS */
		$organization_name_args = static::array_key_default( 'services_theme-organization_name', $args, '' );
		SDES_Static::set_default_keyValue_array( $organization_name_args, array(
			'description' => 'The name that will be displayed with organization info is displayed',
		));

		// TODO: add phone number validation.
		// TODO: add `tel:` links to BaseTheme.
		$organization_phone_args = static::array_key_default( 'services_theme-organization_phone', $args, '' );
		SDES_Static::set_default_keyValue_array( $organization_phone_args, array(
			'description' => 'The phone number that will be displayed with organization info is displayed',
		));

		$organization_email_args = static::array_key_default( 'services_theme-organization_email', $args, '' );
		SDES_Static::set_default_keyValue_array( $organization_email_args, array(
			'description' => 'The email address that will be displayed with organization info is displayed',
		));

		/** FIELDS */
		// organization_name
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-organization_name',		// Id.
			__( 'Organization Name' ),	// Label.
			$section,					// Section.
			$organization_name_args		// Arguments array.
		);

		// organization_phone
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-organization_phone',		// Id.
			__( 'Organization Phone' ),	// Label.
			$section,					// Section.
			$organization_phone_args	// Arguments array.
		);

		// organization_email
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-organization_email',	// Id.
			__( 'Organization Email' ),	// Label.
			$section,					// Section.
			$organization_email_args	// Arguments array.
		);
	}

	public static function add_section_news( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-news';
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'News',
				'description' => 'Settings for news feeds used throughout the site.',
				'priority' => 200,
				'panel' => static::array_key_default( 'panelId', $args, '' ),
			)
		);

		/** ARGS */
		$news_max_items_args = static::array_key_default( 'services_theme-news_max_items', $args, '' );
		SDES_Static::set_default_keyValue_array( $news_max_items_args, array(
			'control_type' => 'select',
			'default' => 2,
			'description' => 'Maximum number of articles to display when outputting news information.',
			'choices'     => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
			),
		));

		$news_url_args = static::array_key_default( 'services_theme-news_url', $args, '' );
		SDES_Static::set_default_keyValue_array( $news_url_args, array(
			'default' => self::NEWS_URL,
			'description' => 'Use the following URL for the news RSS feed <br>Example: <em>http://today.ucf.edu/feed/</em>',
		));

		$news_placeholder_image_args = static::array_key_default( 'services_theme-news_placeholder_image', $args, '' );
		SDES_Static::set_default_keyValue_array( $news_placeholder_image_args, array() );

		/** FIELDS */
		// news_max_items
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-news_max_items',	// Id.
			'News Max Items',		// Label.
			$section,				// Section.
			$news_max_items_args	// Arguments array.
		);

		// news_url
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-news_url',	// Id.
			'News Feed',	// Label.
			$section,		// Section.
			$news_url_args	// Arguments array.
		);

		// news_placeholder_image
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-news_placeholder_image',			// Id.
			__( 'Placeholder thumbnail for news stories.' ),	// Label.
			$section,						// Section.
			$news_placeholder_image_args	// Arguments array.
		);
	}

	public static function add_section_social( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-social';
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'Social Media',
				'description' => '',
				'priority' => 900,
				'panel' => static::array_key_default( 'panelId', $args, '' ),
			)
		);

		$networks = array(
			'facebook' => array(
				'label' => 'Facebook URL',
				'description' => 'URL to the Facebook page you would like to direct visitors to.  Example: <em>https://www.facebook.com/UCF</em>',
			),
			'twitter' => array(
				'label' => 'Twitter URL',
				'description' => 'URL to the Twitter user account you would like to direct visitors to.  Example: <em>http://twitter.com/UCF</em>',
			),
			'googleplus' => array(
				'label' => 'Google+ URL',
				'description' => 'URL to the Google+ user account you would like to direct visitors to.  Example: <em>http://plus.google.com/UCF</em>',
			),
			'linkedin' => array(
				'label' => 'LinkedIn URL',
				'description' => 'URL to the LinkedIn user account you would like to direct visitors to.  Example: <em>http://linkedin.com/UCF</em>',
			),
			'instagram' => array(
				'label' => 'Instagram URL',
				'description' => 'URL to the Instagram user account you would like to direct visitors to.  Example: <em>http://instagram.com/UCF</em>',
			),
			'pinterest' => array(
				'label' => 'Pinterest URL',
				'description' => 'URL to the Pinterest user account you would like to direct visitors to.  Example: <em>http://pinterest.com/UCF</em>',
			),
			'youtube' => array(
				'label' => 'YouTube URL',
				'description' => 'URL to the YouTube user account you would like to direct visitors to.  Example: <em>http://youtube.com/UCF</em>',
			),
		);

		foreach ( $networks as $network => $network_args ) {
			/** ARGS */
			$social_url_args = static::array_key_default( "services_theme-social_{$network}_url" , $args, '' );
			SDES_Static::set_default_keyValue_array( $social_url_args, array(
				'description' => $network_args['description'],
				'sanitize_callback' => 'esc_url',
				'sanitize_js_callback' => 'esc_url',
			));

			/** FIELDS */
			// social_{$network}_url
			SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
				$wp_customizer,			// WP_Customize_Manager.
				"services_theme-social_{$network}_url",	// Id.
				$network_args['label'],	// Label.
				$section,				// Section.
				$social_url_args		// Arguments array.
			);
		}
	}

	public static function add_section_contact( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-contact';
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'Contact',
				'description' => '',
				'priority' => 800,
				'panel' => static::array_key_default( 'panelId', $args, '' ),
			)
		);

		/** ARGS */
		$form_choices = array( '' => '-- Choose Form --' );
		if ( method_exists( '\RGFormsModel', 'get_forms' ) ) {
			$forms = \RGFormsModel::get_forms( null, 'title' );
			foreach ( $forms as $form ) {
				$form_choices[ $form->id ] = $form->title;
			}
		}
		$footer_contact_gravityform_args = static::array_key_default( 'services_theme-footer_contact_gravityform', $args, '' );
		SDES_Static::set_default_keyValue_array( $footer_contact_gravityform_args, array(
			'control_type' => 'select',
			'default' => 4,
			'description' => 'The form that will be shown in the footer.',
			'choices'     => $form_choices,
		));

		/** FIELDS */
		// footer_contact_gravityform
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-footer_contact_gravityform',	// Id.
			__( 'Footer Contact Form' ),	// Label.
			$section,				// Section.
			$footer_contact_gravityform_args	// Arguments array.
		);
	}
}
add_action( 'customize_register', __NAMESPACE__.'\Footer_Settings::register_footer_settings' );



/**
 * Logic for displaying footer elements.
 */
class Footer {
	/**
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L155-L185
	 */
	public static function display_footer_news() {
		$max_news = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-news_max_items', 3 );
		$items = Footer_Settings::get_news( 0, $max_news );
		$placeholder = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-news_placeholder_image', '' );
		ob_start();
	?>
		<div class="footer-news">
		<?php foreach ( $items as $key => $item ) : $image = SDES_Static::get_article_image( $item ); ?>
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
	    <?php foreach ( $items as $item ) : ?>
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
			                <h3><?php echo $item->get_title(); ?></h3>
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
		<?php if ( $org_name ) : ?>
		<h2 class="org-name"><?php echo $org_name; ?></h2>
		<?php endif; ?>
		<p>Phone: <a class="read-more" href="tel:<?php echo str_replace( array( '-', '(', ')' ), '', $org_phone );?>"><?php echo $org_phone; ?></a></p>
		<p>Email: <a class="read-more" href="mailto:<?php echo $org_email; ?>"><?php echo $org_email; ?></a></p>
	<?php
		echo ob_get_clean();
	}

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L246-L249
	 */
	public static function display_contact_form() {
		$form_id = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-footer_contact_gravityform', '' );
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
			<a href="<?php echo $googleplus_url; ?>" target="_blank" class="social-icon ga-event-link google-plus">
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
		if ( empty( $menu ) ) {
			return;
		}
		ob_start();
	?>
		<ul class="list-inline site-footer-menu">
		<?php foreach ( $menu->items as $item ) : ?>
			<li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>
		<?php endforeach; ?>
		</ul>
	<?php
		echo ob_get_clean();
	}
}
