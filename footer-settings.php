<?php
/**
 * A helper class for the Footer - call from ThemeCustomizer.php to add action to 'customize_register' before it fires.
 *
 * graphviz.gv: "footer-settings.php" -> { "class-feedmanager.php"; "class-sdes-customizer-helper.php"; "class-sdes-static.php"; };
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
	public static function get_news( $start=null, $limit=null ) {
		$url     = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-news_url', '' );
		$news    = FeedManager::get_items( $url, $start, $limit );
		return $news;
	}

	public static function register_footer_settings( $wp_customizer ) {
		static::add_section_news( $wp_customizer );
	}

	public static function add_section_news( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-news';
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'News',
				'description' => 'Settings for news feeds used throughout the site.',
				'priority' => 250,
				'panel' => $args['panelId'],
			)
		);

		/** ARGS */
		$news_max_items_args = $args['services_theme-news_max_items'];
		SDES_Static::set_default_keyValue_array( $news_max_items_args, array(
			'control_type' => 'select',
			'default' => 2,
			'description' => 'Maximum number of articles to display when outputting news information.',
			'choices'     => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5
			),
		));

		$news_url_args = $args['services_theme-news_url'];
		SDES_Static::set_default_keyValue_array( $news_url_args, array(
			'default' => 'http://today.ucf.edu/feed/',
			'description' => 'Use the following URL for the news RSS feed <br>Example: <em>http://today.ucf.edu/feed/</em>',
		));

		$news_placeholder_image_args = $args['services_theme-news_placeholder_image'];
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
}
add_action( 'customize_register', __NAMESPACE__.'\Footer_Settings::register_footer_settings' );
