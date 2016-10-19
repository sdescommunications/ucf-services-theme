<?php
/**
 * Entry point for a WordPress theme, along with the style.css file.
 * Includes or references all functionality for this theme.
 */

require_once( 'functions/class-sdes-static.php' );
use SDES\SDES_Static as SDES_Static;


require_once( 'custom-taxonomies.php' );  // Define and Register taxonomies for this theme.
require_once( 'custom-posttypes.php' );   // Define and Register custom post_type's (CPTs) for this theme.
// require_once( 'functions/Settings.php' );     // Admin settings for IT staff.
require_once( 'functions/ThemeCustomizer.php' ); // Admin > Appearance > Customize. (Non-admin settings.)
require_once( 'functions/admin.php' );           // Admin/login functions.
require_once( 'functions/admin-theme.php' );     // Theme-specific admin/login functions.
require_once( 'shortcodes.php' );           // Enable shortcodes.
require_once( 'functions/rest-api.php' );   // Register REST routes here.


function __init__() {
    add_theme_support( 'custom-header', array(
        'width' => 2000,
        'height' => 520
    ) );
    // add_theme_support( 'post-thumbnails' );
    // add_image_size( 'thumb-sidebar-campaign', 360, 275, $crop = true );
}
add_action( 'after_setup_theme', '__init__' );

// Enqueue Datepicker + jQuery UI CSS
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles');
add_action( 'admin_enqueue_scripts', 'enqueue_scripts_and_styles');
function enqueue_scripts_and_styles(){
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
}

/**
 * Add .img-responsive to img tags.
 * @see https://developer.wordpress.org/reference/functions/the_content/ WP-Ref: the_content()
 * @see http://stackoverflow.com/a/20499803 Stack-Overflow: /a/20499803
 */
function img_add_responsive_class_content( $content ){
    try {
        return SDES_Static::img_add_responsive_class_content( $content );
    } catch ( Exception $e ) {
        $adminmsg =
            ( SDES_Static::Is_UserLoggedIn_Can( 'install_themes' ) )
            ? '<a class="text-danger adminmsg" style="color: red !important;"'
            . ' href="javascript:jQuery(\'pre.exception\').toggle();">Admin Alert: %1$s<br>'
            . '<pre class="exception" style="display: none;">%2$s</pre></a>'
            : '<!-- %1$s -->';
        $text = 'Image tags may not have the class `img-responsive`. Please add it manually and/or check the filter.';
        echo sprintf( $adminmsg, $text, esc_html( $e ) );
        return $content;
    }
}
add_filter('the_content', 'img_add_responsive_class_content');

/**
 * Add .img-responsive to img tags in sidecolumn metadata fields.
 * Note: ${meta_type}s are "comment, post, user" so both post_sidecolumn and page_sidecolumn fields are filtered.
 * @see https://developer.wordpress.org/reference/hooks/get_meta_type_metadata/ WP-Ref: get_{meta_type}_metadata
 * @see http://wordpress.stackexchange.com/a/175179 Stack-Overflow: /a/175179
 */
function img_add_responsive_class_sidecolumn( $value, $object_id, $meta_key, $single ){
    if( false === strpos( $meta_key, '_sidecolumn' ) ) {
        return $value;
    } else {
        remove_filter( 'get_post_metadata', __FUNCTION__, true );
        $value = get_post_meta( $object_id, $meta_key, true );
        add_filter( 'get_post_metadata', __FUNCTION__, true, 4 );
        return img_add_responsive_class_content( $value );
    }
}
add_filter('get_post_metadata', 'img_add_responsive_class_sidecolumn', true, 4);

//TODO: add screenshot.png for Theme.
