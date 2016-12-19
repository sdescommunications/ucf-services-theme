<?php
/**
 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/functions/feeds.php#L18-L137
 * External dependencies:
 *  "class-feedmanager.php" -> { SimplePie; get_site_transient; set_site_transient; };
 */

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

	/**
	 * Handles fetching and processing of feeds.  Currently uses SimplePie to parse
	 * retrieved feeds, and automatically handles caching of content fetches.
	 * Multiple calls to the same feed url will not result in multiple parsings, per
	 * request as they are stored in memory for later use.
	 * */
class FeedManager {
	static private
	$feeds        = array(),
	$cache_length = 0xD2F0;
	/**
	 * Provided a URL, will return an array representing the feed item for that
	 * URL.  A feed item contains the content, url, simplepie object, and failure
	 * status for the URL passed.  Handles caching of content requests.
	 *
	 * @return array
	 * @author Jared Lang
	 * */
	static protected function __new_feed( $url ) {
		require_once ABSPATH . '/wp-includes/class-simplepie.php';
		$simplepie = null;
		$failed    = false;
		$cache_key = 'feedmanager-'.md5( $url );
		$content   = get_site_transient( $cache_key );
		if ( $content === false ) {
			$content = @wp_remote_retrieve_body( wp_remote_get( $url ));//$content = @file_get_contents( $url );
			if ( $content === false ) {
				$failed  = true;
				$content = null;
				error_log( 'FeedManager failed to fetch data using url of '.$url );
			} else {
				set_site_transient( $cache_key, $content, self::$cache_length );
			}
		}
		if ( $content ) {
			$simplepie = new SimplePie();
			$simplepie->set_raw_data( $content );
			$simplepie->init();
			$simplepie->handle_content_type();
			if ( $simplepie->error ) {
				error_log( $simplepie->error );
				$simplepie = null;
				$failed    = true;
			}
		} else {
			$failed = true;
		}
		return array(
			'content'   => $content,
			'url'       => $url,
			'simplepie' => $simplepie,
			'failed'    => $failed,
		);
	}
	/**
	 * Returns all the items for a given feed defined by URL
	 *
	 * @return array
	 * @author Jared Lang
	 * */
	static protected function __get_items( $url ) {
		if ( ! array_key_exists( $url, self::$feeds ) ) {
			self::$feeds[ $url ] = self::__new_feed( $url );
		}
		if ( ! self::$feeds[ $url ]['failed'] ) {
			return self::$feeds[ $url ]['simplepie']->get_items();
		} else {
			return array();
		}
	}
	/**
	 * Retrieve the current cache expiration value.
	 *
	 * @return void
	 * @author Jared Lang
	 * */
	static public function get_cache_expiration() {
		return self::$cache_length;
	}
	/**
	 * Set the cache expiration length for all feeds from this manager.
	 *
	 * @return void
	 * @author Jared Lang
	 * */
	static public function set_cache_expiration( $expire ) {
		if ( is_number( $expire ) ) {
			self::$cache_length = (int) $expire;
		}
	}
	/**
	 * Returns all items from the feed defined by URL and limited by the start
	 * and limit arguments.
	 *
	 * @return array
	 * @author Jared Lang
	 * */
	static public function get_items( $url, $start = null, $limit = null ) {
		if ( $start === null ) {$start = 0;}
		$items = self::__get_items( $url );
		$items = array_slice( $items, $start, $limit );
		return $items;
	}
}

class UcfAcademicCalendarModel {
	public static $calendar_url = 'http://calendar.ucf.edu/feed/upcoming';
	public static $more_events = 'http://calendar.ucf.edu/';
	protected $event;
	public function __construct( $item ) {
		$this->event = $item;
	}

	public static function get_academic_calendar_items() {
		$result_name = 'academic_calendar_renamed';//$result_name = 'academic_calendar';
		$retval = get_transient( $result_name );
		if ( false === $retval ) {
			$opts = array(
				'http' => array(
					'timeout' => 15,
				),
			);
			$context = stream_context_create( $opts );
			$file_location = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-academic_cal_feed_url', self::$calendar_url );
			if ( empty( $file_location ) ) {
				return;
			}
			$result = json_decode( wp_remote_retrieve_body( wp_remote_get( $file_location, false, $context )) );//$result = json_decode( file_get_contents( $file_location, false, $context ) );
			if ( empty( $result ) ) {
				return;
			}
			$result = $result->terms[0]->events;
			foreach ( $result as $r ) {
				if ( $r->isImportant ) {
					$retval[] = $r;
				}
				if ( count( $retval ) == 7 ) {
					break;
				}
			}
			set_transient( $result_name, $retval, (60 * 60 * 12) );
		}
		return $retval;
	}

	public function title() {
		return static::get_title( $this->event );
	}
	public static function get_title( $item ) {
		return $item->summary;
	}

	public function link() {
		return static::get_link( $this->event );
	}
	public static function get_link( $item ) {
		return $item->directUrl;
	}

	public function description() {
		return static::get_description( $this->event );
	}
	public static function get_description( $item ) {
		return $item->description;
	}

	public function month_day() {
		return static::get_month_day( $this->event );
	}
	public static function get_month_day( $item ) {
		return date( 'M j', strtotime( $item->dtstart ) );
	}

	public function month() {
		return static::get_month( $this->event );
	}
	public static function get_month( $item ) {
		return date( 'M', strtotime( $item->dtstart ) );
	}

	public function day() {
		return static::get_day( $this->event );
	}
	public static function get_day( $item ) {
		return date( 'j', strtotime( $item->dtstart ) );
	}

	public function start_date() {
		return static::get_start_date( $this->event );
	}
	public static function get_start_date( $item ) {
		return strtotime( $item->dtstart );
	}

	public function end_date() {
		return static::get_end_date( $this->event );
	}
	public static function get_end_date( $item ) {
		return empty( $tem->dtend ) ? '' : strtotime( $tem->dtend );
	}

	public function start_time() {
		return static::get_start_time( $this->event );
	}
	public static function get_start_time( $item ) {
		return date( 'g:i a', strtotime( static::get_start_date( $item ) ) );
	}

	public function end_time() {
		return static::get_end_time( $this->event );
	}
	public static function get_end_time( $item ) {
		return date( 'g:i a', strtotime( static::get_end_date( $item ) ) );
	}

	public function time_string() {
		return static::get_time_string( $this->event );
	}
	public static function get_time_string( $item ) {
		$start_time = self::get_start_time( $this );
		$end_time = self::get_end_time( $this );
		if ( $start_time == $end_time ) {
			return $start_time;
		} else {
			return $start_time . ' - ' . $end_time;
		}
	}
	public static function more_link() {
		return static::$more_events;
	}
}

class UcfEventModel {
	// TODO - remove events_url?
	public static $events_url = 'http://events.ucf.edu';
	protected $event;
	public function __construct( $item ) {
		$this->event = $item;
	}

	public function title() {
		return static::get_title( $this->event );
	}
	public static function get_title( $item ) {
		return $item->get_title();
	}

	public function link() {
		return static::get_link( $this->event );
	}
	public static function get_link( $item ) {
		return $item->get_link();
	}

	public function description() {
		return static::get_description( $this->event );
	}
	public static function get_description( $item ) {
		return $item->get_description();
	}

	public function month_day() {
		return static::get_month_day( $this->event );
	}
	public static function get_month_day( $item ) {
		return $item->get_date( 'M j' );
	}

	public function month() {
		return static::get_month( $this->event );
	}
	public static function get_month( $item ) {
		return $item->get_date( 'M' );
	}

	public function day() {
		return static::get_day( $this->event );
	}
	public static function get_day( $item ) {
		return $item->get_date( 'j' );
	}

	public function start_date() {
		return static::get_start_date( $this->event );
	}
	public static function get_start_date( $item ) {
		return $item->get_item_tags( static::$events_url, 'startdate' )[0]['data'];
	}

	public function end_date() {
		return static::get_end_date( $this->event );
	}
	public static function get_end_date( $item ) {
		return $item->get_item_tags( static::$events_url, 'enddate' )[0]['data'];
	}

	public function start_time() {
		return static::get_start_time( $this->event );
	}
	public static function get_start_time( $item ) {
		return date( 'g:i a', strtotime( static::get_start_date( $item ) ) );
	}

	public function end_time() {
		return static::get_end_time( $this->event );
	}
	public static function get_end_time( $item ) {
		return date( 'g:i a', strtotime( static::get_end_date( $item ) ) );
	}

	public function time_string() {
		return static::get_time_string( $this->event );
	}
	public static function get_time_string( $item ) {
		$start_time = self::get_start_time( $this );
		$end_time = self::get_end_time( $this );
		if ( $start_time == $end_time ) {
			return $start_time;
		} else {
			return $start_time . ' - ' . $end_time;
		}
	}
	public static function more_link() {
		return static::$events_url;
	}
}
