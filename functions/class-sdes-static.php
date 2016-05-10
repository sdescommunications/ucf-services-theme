<?php
/**
 * Static Helper functions that are reusable in any PHP Site.
 * @package SDES Static - Rev2015 WordPress Prototype
 */

namespace SDES;

/**
 * Container for reusable static functions (i.e., the same parameters should always return the same output).
 */
class SDES_Static
{

	/**
	 * Set default value for a given key in $args, which is passed by reference.
	 * @param array  $args    An args array (that is passed in by reference).
	 * @param string $key     The key to set.
	 * @param mixed  $default_value   A default value for the key if it is not already set.
	 */
	public static function set_default_keyValue( &$args, $key, $default_value ) {
		$args[ $key ] = (isset( $args[ $key ] ))
			 ? $args[ $key ]
			 : $default_value;
	}

	/**
	 * Set multiple default values for keys in $args, which is passed by reference.
	 * @param array $args    An args array (that is passed in by reference).
	 * @param array $default_values   An collections of keys and their default values.
	 */
	public static function set_default_keyValue_array( &$args, $default_values ) {
		foreach ( $default_values as $key => $default_value ) {
			$args[ $key ] = (isset( $args[ $key ] ))
				 ? $args[ $key ]
				 : $default_value;
		}
	}

	// TODO: add tests, verify that register function exists.
	/**
	 * For each class provided, create a new instance of the class and call its the register function.
	 * @param Array $classnames_to_register  Listing of class names to `->register()`.
	 * @return Array Array of instantiated classes (array of arrays). Each item has the keys: 'classname', 'instance'.
	 */
	public static function instantiate_and_register_classes( $classnames_to_register = null ) {
		if ( null === $classnames_to_register ) { return; }
		$get_class = function( $classname ) {
			return array( 'classname' => $classname, 'instance' => new $classname );
		};
		$class_instances = array_map( $get_class, $classnames_to_register );
		foreach ( $class_instances as $new_class ) {
			$new_class['instance']->register();
		}
		return $class_instances;
	}


	// TODO: add tests, try-catch block.
	/**
	 * Return a collection links and titles from an RSS feed.
	 * @param string           $uri           The uri of the RSS feed.
	 * @param int              $max_count         The number of items to return.
	 * @param int              $char_limit    Limit the number of characters in the titles, add &hellip; if over.
	 * @param SimpleXMLElement $xml           Reuse an existing SimpleXMLElement.
	 * @return Array A collection of anchors (array of arrays). Each anchor has the keys: 'link', 'title'.
	 */
	public static function get_rss_links_and_titles( $uri,
		$max_count = 8, $char_limit = 45,
		$xml = null ) {
		if ( null === $xml ) { $xml = simplexml_load_file( $uri ); }

		$output = array();
		$i = 0;  // TODO: refactor with generator pattern when VCCW upgrades to PHP 5.5+.
		foreach ( $xml->channel->item  as $idx => $item ) {
			if ( $i++ < $max_count ) {
				$title_truncated
					= ( strlen( $item->title ) > $char_limit )
						? substr( $item->title, 0, $char_limit ) . '&hellip;'
						: (string) $item->title;
				$output[] = array(
					'link' => (string) $item->link,
					'title' => $title_truncated,
					);
			}
		}
		return $output;
	}


	// TODO: Needs tests.
	/**
	 * Always include an area code, show only numbers and the dash symbol, always show 2 dashes.
	 * @param string $value    The value to be sanitized, as passed back by sanitize_callback.
	 */
	public static function sanitize_telephone( $value, $areaCode = '407' ) {
		if ( '' === $value ) { return $value; }
		$value = preg_replace( '/[^0-9-]/', '', $value ); // Remove non-numeric, unless a dash.

		// Prepend area code if necessary.
		if ( strlen( $value ) <= 8 ) {
			$value = $areaCode . '-' . $value;
		}

		// Add first dash if missing.
		$firstDash = 3;
		if ( '-' !== $value[ $firstDash ]  ) {
			$value = substr_replace( $value, '-', $firstDash, 0 );
		}

		// Add last dash if missing.
		$lastDash = 7; // strlen($value)-5; //.
		if ( '-' !== $value[ $lastDash ] ) {
			$value = substr_replace( $value, '-', $lastDash, 0 );
		}

		return $value;
	}


	// TODO: allow relative URLs (in relation to get_site_url()) if url start with '/'.
	/**
	 * Add a protocol to a URL if it does not exist.
	 * @param string $url The url variable to adjust.
	 * @param string $protocol The protocol to prepend to the url. (defaults to http://).
	 */
	public static function url_ensure_prefix( $url, $protocol = 'http' ) {
		if ( false === strrpos( $url, '//' ) ) {
			$url = $protocol . '://' . $url;
		}
		return $url;
	}

	public static function is_null_or_whitespace( $string ) {
		return null === $string || '' === $string || ctype_space( $string );
	}

	/**
	 * *********************
	 * WordPress functions
	 ***********************/
	/**
	 * Returns the default even if the value in the database is null, whitespace, or an empty string.
	 * @param string $value				The theme modification name to pass to get_theme_mod.
	 * @param string $default_to		Default value to return.
	 * @param string $get_theme_mod		Reference to the get_theme_mod function, or a mock for testing.
	 */
	public static function get_theme_mod_defaultIfEmpty( $value, $default_to, $get_theme_mod = 'get_theme_mod' ) {
		$output = $get_theme_mod( $value, $default_to );  // Default if no value stored in database.
		// Default if value in db is null, empty string, or whitespace.
		if ( self::is_null_or_whitespace( $output ) ) { $output = $default_to; }
		return $output;
	}

	/**
	 * Check if user is both logged in and has a given capability.
	 * @param string $capability	A capability or role name to pass to current_user_can.
	 */
	public static function Is_UserLoggedIn_Can( $capability ) {
		return is_user_logged_in() && current_user_can( $capability );
	}

	/**
	 * Get a string of class names for a WP_Post object and optionally apply a filter.
	 * @param object $wp_post	The WP_Post object whose classes will be retrieved.
	 * @param string $filter_tag	A filter to pass to apply_filters.
	 */
	public static function Get_ClassNames( $wp_post, $filter_tag = '' ) {
		$classes = empty( $wp_post->classes ) ? array() : (array) $wp_post->classes;
		$class_names = join( ' ', apply_filters( $filter_tag, array_filter( $classes ), $wp_post ) );
		return $class_names;
	}


	/**
	 * Really get the post type.  A post type of revision will return its parent
	 * post type.
	 * @param int|WPPost $this_post  The post or the post's ID.
	 * @see https://github.com/UCF/Students-Theme/blob/6ca1d02b062b2ee8df62c0602adb60c2c5036867/functions/base.php#L411-L432
	 * @return string  The 'post_type' for a post.
	 * @author Jared Lang
	 * */
	public static function get_post_type( $this_post ) {
		if ( is_int( $this_post ) ) {
			$this_post = get_post( $this_post );
		}
		// Check post_type field.
		$post_type = $this_post->post_type;
		if ( 'revision' === $post_type ) {
			$parent    = (int) $this_post->post_parent;
			$post_type = self::get_post_type( $parent );
		}
		return $post_type;
	}

	/**
	 * Retrieve the alttext for a post id's thumbnail, or default values.
	 */
	public static function get_post_thumbnail_alttext( $post_id, $default_text = 'Thumbnail' ) {
		return self::get_thumbnail_alttext(  get_post_thumbnail_id( $post_id ) , $default_text );
	}

	/**
	 * Retrieve the alttext for a thumbnail, or default values.
	 */
	public static function get_thumbnail_alttext( $thumbnail_id, $default_text = 'Thumbnail' ) {
		$alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
		if( ! self::is_null_or_whitespace( $alt_text ) ) return $alt_text;

		$alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_title', true );
		if( ! self::is_null_or_whitespace( $alt_text ) ) return $alt_text;

		// $alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_caption', true );
		// if( ! self::is_null_or_whitespace( $alt_text ) ) return $alt_text;

		// $alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_description', true );
		// if( ! self::is_null_or_whitespace( $alt_text ) ) return $alt_text;

		return $default_text;
	}


	/**
	 * Use to display a message in locations where have_posts() returns false.
	 * @param Array $args  Any additional arguments for this function.
	 *  Bool   echo    Flag to whether to echo or return text (defaults to true).
	 *  String message The text of the message (defaults to 'No posts were found.').
	 */
	public static function Get_No_Posts_Message( $args = array() ) {
		$defaults = array( 'echo' => true, 'message' => 'No posts were found.' );
		$args = array_merge( $defaults, $args );
		$no_posts =
			( SDES_Static::Is_UserLoggedIn_Can( 'edit_posts' ) )
			? '<a class="text-danger adminmsg" style="color: red !important;"'
			. 'href="' . get_site_url() . '/wp-admin/">Admin Alert: %1$s</a>'
			: '<!-- %1$s -->';
		$output = sprintf( $no_posts, $args['message'] );
		if ( $args['echo'] ) {
			echo $output;
		}
		return $output;
	}
}
