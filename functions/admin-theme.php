<?php
/**
 * Configure the Admin Dashboard (/wp-admin/).
 */

namespace SDES\ServicesTheme\Admin;
use \WP_Query;
require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;
// require_once( get_stylesheet_directory() . '/functions/class-sdes-helper.php' );
// 	use SDES\ServicesTheme\SDES_Helper as SDES_Helper;


/**
 * Hide Appearance > Themes (/wp-admin/themes.php)
 * @see http://codex.wordpress.org/remove_submenu_page WP-Codex: remove_submenu_page()
 */
// function remove_theme_submenu() {
// 	$page = remove_submenu_page( 'themes.php', 'themes.php' );
// }
// add_action( 'admin_menu', __NAMESPACE__.'\remove_theme_submenu', 999 );


/**
 * Hide links to "Themes.php" in adminbar (in the dropdown menu between "My Sites" and "Customize").
 * @see http://codex.wordpress.org/Function_Reference/remove_node WP-Codex: remove_node()
 */
// function remove_theme_link_adminbar( $wp_admin_bar ) {
// 	$wp_admin_bar->remove_node( 'themes' );
// }
// add_action( 'admin_bar_menu', __NAMESPACE__.'\remove_theme_link_adminbar', 999 );
