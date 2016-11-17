<?php
/**
 * Entry point for a WordPress theme, along with the style.css file.
 * Includes or references all functionality for this theme.
 */

// Utility functions.
require_once( 'functions/class-sdes-static.php' ); // Contains reusable functions (SDES_Static class) and DOMDocument_Smart wrapper class.
	use SDES\SDES_Static as SDES_Static;


// Custom Taxonomies.
require_once( 'functions/class-custom-taxonomy.php' ); // Base class for creating custom taxonomies.
require_once( 'custom-taxonomies.php' );  // Define and Register taxonomies for this theme.


// Custom Posttypes.
require_once( 'functions/classes-metabox-metafields.php' ); // Manage metafield types.
require_once( 'functions/class-sdes-metaboxes.php' );  // Add metabox functionality to class-custom-posttype.
require_once( 'functions/custom-metafields.php' );  // Add theme-specific metafields.

require_once( 'functions/class-feedmanager.php' );  // Manage and model external feeds used by custom posttypes (FeedManager, UcfEventModel, and UcfAcademicCalendarModel).

require_once( 'functions/class-custom-posttype.php' ); // Base class for creating custom posttypes.
require_once( 'custom-posttypes.php' );   // Define and Register custom post_type's (CPTs) for this theme.


// Main settings files.
// require_once( 'functions/Settings.php' );     // Admin settings for IT staff. (Placeholder, unused in this theme).
require_once( 'functions/class-sdes-customizer-helper.php' ); // SDES_Customizer_Helper class, was intended to reduce boilerplate in ThemeCustomizer.php.
require_once( 'functions/classes-wp-customize-control.php' ); // Controls that extend WP_Customize_Control.
require_once( 'functions/ThemeCustomizer.php' ); // Admin > Appearance > Customize. (Non-admin settings.)


// Admin area customizations.
require_once( 'functions/admin-mce-editor.php' );  // Filters for mce_css, mce_buttons_2, and tiny_mce_before_init (loaded alongside admin.php).
require_once( 'functions/admin.php' );           // Admin/login functions.
require_once( 'functions/admin-theme.php' );     // Theme-specific admin/login functions.


// Other functionality.
require_once( 'functions/class-shortcodebase.php' ); // Classes used for shortcodes: ShortcodeBase_Loader, IShortcodeUI, ShortcodeBase, and Shortcode_CustomPostType_Wrapper.
require_once( 'shortcodes.php' );           // Add custom shortcodes here.

require_once( 'functions/rest-api.php' );   // Register REST routes here.


// Functions used in template hierarchy.
require_once( 'header-settings.php' ); // Header class (template logic) and Header_Settings class (Theme Customizer settings).
require_once( 'footer-settings.php' ); // Footer class (template logic) and Footer_Settings class (Theme Customizer settings).

require_once( 'functions/class-weatherbox.php' ); // The WeatherBox class used in front-page.php (and examples in WeatherBox_Tutorial class).




function __init__() {
	/*
	 * To edit the document title, use hooks. See: https://www.developersq.com/change-page-post-title-wordpress-4-4/
	 * https://developer.wordpress.org/reference/hooks/pre_get_document_title/
	 * https://developer.wordpress.org/reference/hooks/document_title_separator/
	 * https://developer.wordpress.org/reference/hooks/document_title_parts/
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header', array(
		'width' => 2000,
		'height' => 520,
	) );
	// add_theme_support( 'post-thumbnails' );
	// add_image_size( 'thumb-sidebar-campaign', 360, 275, $crop = true );
}
add_action( 'after_setup_theme', '__init__' );

// Enqueue Datepicker + jQuery UI CSS
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );
add_action( 'admin_enqueue_scripts', 'enqueue_scripts_and_styles' );
function enqueue_scripts_and_styles() {
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true );
}

/**
 * Add .img-responsive to img tags.
 *
 * @see https://developer.wordpress.org/reference/functions/the_content/ WP-Ref: the_content()
 * @see http://stackoverflow.com/a/20499803 Stack-Overflow: /a/20499803
 */
function img_add_responsive_class_content( $content ) {
	try {
		return SDES_Static::img_add_responsive_class_content( $content );
	} catch ( Exception $e ) {
		$adminmsg = ( SDES_Static::Is_UserLoggedIn_Can( 'install_themes' ) )
			? '<a class="text-danger adminmsg" style="color: red !important;"'
			. ' href="javascript:jQuery(\'pre.exception\').toggle();">Admin Alert: %1$s<br>'
			. '<pre class="exception" style="display: none;">%2$s</pre></a>'
			: '<!-- %1$s -->';
		$text = 'Image tags may not have the class `img-responsive`. Please add it manually and/or check the filter.';
		echo sprintf( $adminmsg, $text, esc_html( $e ) );
		return $content;
	}
}
add_filter( 'the_content', 'img_add_responsive_class_content' );

/**
 * Add .img-responsive to img tags in sidecolumn metadata fields.
 * Note: ${meta_type}s are "comment, post, user" so both post_sidecolumn and page_sidecolumn fields are filtered.
 *
 * @see https://developer.wordpress.org/reference/hooks/get_meta_type_metadata/ WP-Ref: get_{meta_type}_metadata
 * @see http://wordpress.stackexchange.com/a/175179 Stack-Overflow: /a/175179
 */
function img_add_responsive_class_sidecolumn( $value, $object_id, $meta_key, $single ) {
	if ( false === strpos( $meta_key, '_sidecolumn' ) ) {
		return $value;
	} else {
		remove_filter( 'get_post_metadata', __FUNCTION__, true );
		$value = get_post_meta( $object_id, $meta_key, true );
		add_filter( 'get_post_metadata', __FUNCTION__, true, 4 );
		return img_add_responsive_class_content( $value );
	}
}
add_filter( 'get_post_metadata', 'img_add_responsive_class_sidecolumn', true, 4 );

// TODO: add screenshot.png for Theme.
