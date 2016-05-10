<?php
/**
 * Configure the Admin Dashboard (/wp-admin/).
 */
namespace SDES\Admin;
use \WP_Query;
use SDES\SDES_Static as SDES_Static;
require_once( get_stylesheet_directory().'/functions/admin-mce-editor.php' );

// @see https://github.com/UCF/Students-Theme/blob/d56183079c70836adfcfaa2ac7b02cb4c935237d/functions/admin.php#L41-L71
add_action( 'admin_menu', __NAMESPACE__.'\create_help_page' );
function create_help_page() {
	add_menu_page(
		__( 'Help' ), // $page_title,
		__( 'Help' ), // $menu_title,
		'edit_posts',     // $capability,
		'theme-help', // $menu_slug,
		__NAMESPACE__.'\theme_help_page',  // $function,
		'dashicons-editor-help' // $icon_url
		// , $position
	);
}
function theme_help_page() {
	include( get_stylesheet_directory().'/includes/theme-help.php' );
}


function customize_admin_theme() {
	wp_enqueue_style( 'admin-theme', get_stylesheet_directory_uri() . '/css/admin.css' );
	wp_enqueue_script( 'admin-theme', get_stylesheet_directory_uri() . '/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__.'\customize_admin_theme' );
