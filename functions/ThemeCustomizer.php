<?php
/**
 * Add and configure Theme Customizer options for this theme (non-admin settings).
 * Relies implementation in SDES_Customizer_Helper.
 */

namespace SDES\ServicesTheme\ThemeCustomizer;
use \WP_Customize_Control;
use \WP_Customize_Color_Control;
require_once( get_stylesheet_directory() . '/functions/class-sdes-customizer-helper.php' );
	use SDES\CustomizerControls\SDES_Customizer_Helper;
require_once( get_stylesheet_directory() . '/functions/classes-wp-customize-control.php' );
	use SDES\CustomizerControls\Textarea_CustomControl;
	use SDES\CustomizerControls\Phone_CustomControl;
require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;


/**
 * Add component settings.
 */
require_once( get_stylesheet_directory() . '/footer-settings.php' );
require_once( get_stylesheet_directory() . '/functions/class-weatherbox.php' );


/**
 * Defines all of the sections, settings, and controls for the various
 * options introduced into the Theme Customizer
 *
 * @see http://developer.wordpress.org/themes/advanced-topics/customizer-api/ WP-Handbook: The Customizer API
 * @see http://codex.wordpress.org/Theme_Customization_API WP-Codex: Theme Customization API
 * @see http://codex.wordpress.org/Plugin_API/Action_Reference/customize_register WP-Codex: customize_register()
 * @see http://codex.wordpress.org/Class_Reference/WP_Customize_Control WP-Codex: class WP_Customize_Control
 * @see http://codex.wordpress.org/Data_Validation WP-Codex: Data Validation
 * @param   object $wp_customizer    A reference to the WP_Customize_Manager Theme Customizer.
 */
function register_theme_customizer( $wp_customizer ) {

	add_to_section_TitleAndTagline( $wp_customizer );

	add_section_social_options( $wp_customizer );

}
add_action( 'customize_register', __NAMESPACE__.'\register_theme_customizer' );

/**
 * Register taglineURL option with the built-in `title_tagline` section, add settings and controls.
 */
function add_to_section_TitleAndTagline( $wp_customizer, $args = null ) {
	$section = 'title_tagline';

	// Sitetitle Anchor Width
	$sitetitle_anchor_width_args = $args['services_theme-sitetitle_anchor_width'];
	SDES_Static::set_default_keyValue_array( $sitetitle_anchor_width_args, array(
		'description' => 'Default width: "400px"',
		'transport' => 'refresh',
		'default' => '400px',
		'sanitize_callback' => 'esc_attr',
	));
	SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type
		$wp_customizer,			// WP_Customize_Manager.
		'services_theme-sitetitle_anchor_width',	// Id.
		'Title Width',					// Label.
		$section,						// Section.
		$sitetitle_anchor_width_args	// Arguments array.
	);

	// Sitetitle Anchor Max Width
	$sitetitle_anchor_maxwidth_args = $args['services_theme-sitetitle_anchor_maxwidth'];
	SDES_Static::set_default_keyValue_array( $sitetitle_anchor_maxwidth_args, array(
		'description' => 'Default max-width: "460px"',
		'transport' => 'refresh',
		'default' => '460px',
		'sanitize_callback' => 'esc_attr',
	));
	SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type
		$wp_customizer,			// WP_Customize_Manager.
		'services_theme-sitetitle_anchor_maxwidth',	// Id.
		'Title Max Width',				// Label.
		$section,						// Section.
		$sitetitle_anchor_maxwidth_args	// Arguments array.
	);
}

/** Register the social_options section, add settings and controls. */
function add_section_social_options( $wp_customizer, $args = null ) {
	/* SECTION */
	$section = 'services_theme-social_options';
	$wp_customizer->add_section(
		$section,
		array(
			'title'    => 'Social',
			'priority' => 300,
			'panel' => $args['panelId'],
		)
	);

	/** ARGS */
	// TODO: Sanitize social links.
	$facebook_args = $args['services_theme-facebook'];
	SDES_Static::set_default_keyValue_array( $facebook_args, array(
		'sanitize_callback' => 'esc_url',
		'sanitize_js_callback' => 'esc_url',
	));

	$twitter_args = $args['services_theme-twitter'];
	SDES_Static::set_default_keyValue_array( $twitter_args, array(
		'sanitize_callback' => 'esc_url',
		'sanitize_js_callback' => 'esc_url',
	));

	$youtube_args = $args['services_theme-youtube'];
	SDES_Static::set_default_keyValue_array( $youtube_args, array(
		'sanitize_callback' => 'esc_url',
		'sanitize_js_callback' => 'esc_url',
	));

	/** FIELDS */
	// Facebook
	SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
		$wp_customizer,			// WP_Customize_Manager.
		'services_theme-facebook',	// Id.
		'Facebook',				// Label.
		$section,				// Section.
		$facebook_args			// Arguments array.
	);

	// Twitter
	SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
		$wp_customizer,			 // WP_Customize_Manager.
		'services_theme-twitter', // Id.
		'Twitter',				 // Label.
		$section,				 // Section.
		$twitter_args			 // Arguments array.
	);

	// Youtube
	SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
		$wp_customizer,			 // WP_Customize_Manager.
		'services_theme-youtube', // Id.
		'Youtube',				 // Label.
		$section,				 // Section.
		$twitter_args			 // Arguments array.
	);
}
