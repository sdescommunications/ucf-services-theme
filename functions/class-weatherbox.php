<?php
/**
 * Display a weather icon, location, and temperature based on a feed.
 *
 * graphviz.gv: "class-weatherbox.php" -> { "weather-icons"; "class-sdes-customizer-helper.php"; "class-sdes-static.php"; "_weather.scss"};
 */
namespace SDES;

require_once( get_stylesheet_directory() . '/functions/class-sdes-customizer-helper.php' );
	use SDES\CustomizerControls\SDES_Customizer_Helper;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

class WeatherBox {
	const LOCATION_DEFAULT = 'Orlando, FL';
	const WEATHER_FEED_URL = 'http://weather.smca.ucf.edu/';

	public static function register_settings( $wp_customizer ) {

		static::add_section_home_custom( $wp_customizer );

	}

	public static function add_section_home_custom( $wp_customizer, $args = null ) {
		/* SECTION */
		$section = 'services_theme-home_custom';
		// TODO: check if section is already registered.
		$wp_customizer->add_section(
			$section,
			array(
				'title'    => 'Home Customization',
				'description' => '',
				'priority' => 200,
				'panel' => $args['panelId'],
			)
		);
		/** ARGS */
		$home_custom_footer_menu_feed_args = $args['services_theme-home_custom_footer_menu_feed'];
		SDES_Static::set_default_keyValue_array( $home_custom_footer_menu_feed_args, array(
			'default' => self::WEATHER_FEED_URL,
			'description' => 'The url of the CM Weather Feed',
		));

		/** FIELDS */		
		// home_custom_footer_menu_feed
		SDES_Customizer_Helper::add_setting_and_control('WP_Customize_Control', // Control Type.
			$wp_customizer,			// WP_Customize_Manager.
			'services_theme-home_custom_footer_menu_feed',	// Id.
			'Weather Feed URL',	// Label.
			$section,			// Section.
			$home_custom_footer_menu_feed_args	// Arguments array.
		);
	}

	/**
	 * 
	 *
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L117-L135
	 */
	public static function display_weather() {
		$weather = static::get_weather_data();
		$weather->location = property_exists( $weather, 'location') ? $weather->location : self::LOCATION_DEFAULT;
		ob_start();
		?>
		<?php if ( $weather ) : ?>
			<div class="weather">
				<?php if ( $weather->icon ) : ?>
					<span class="icon" title="<?php echo $weather->condition; ?>">
						<span class="<?php echo $weather->icon; ?>"></span>
					</span>
				<?php endif; ?>
				<span class="location"><?= $weather->location ?></span>
				<span class="vertical-rule"></span>
				<span class="temp"><?php echo $weather->tempN; ?>&deg;F</span>
			</div>
		<?php endif; ?>
		<?php
		return ob_get_clean();
	}

	/**
	 * 
	 *
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L309-323
	 */
	public static function get_weather_data() {
		$opts = array(
			'http' => array(
				'timeout' => 15
			)
		);
		$context = stream_context_create( $opts );
		$file = file_get_contents( SDES_Static::get_theme_mod_defaultIfEmpty( 'weather_feed_url', self::WEATHER_FEED_URL ), false, $context );
		$weather = json_decode( $file );
		$weather->icon = static::get_weather_icon( $weather->condition );
		return $weather;
	}

	/**
	 * 
	 * 
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L325-390
	 */
	public static function get_weather_icon( $condition ) {
		// https://erikflowers.github.io/weather-icons/
		$icon_prefix = "wi wi-";
		$icons_to_conditions = array(
				'day-sunny' => array(
					'fair',
					'default'
				),
				'hot' => array(
					'hot',
					'haze'
				),
				'cloudy' => array(
					'overcast',
					'partly cloudy',
					'mostly cloudy'
				),
				'snowflake-cold' => array(
					'blowing snow',
					'cold',
					'snow'
				),
				'showers' => array(
					'showers',
					'drizzle',
					'mixed rain/sleet',
					'mixed rain/hail',
					'mixed snow/sleet',
					'hail',
					'freezing drizzle'
				),
				'cloudy-gusts' => array(
					'windy'
				),
				'fog' => array(
					'dust',
					'smoke',
					'foggy'
				),
				'storm-showers' => array(
					'scattered thunderstorms',
					'scattered thundershowers',
					'scattered showers',
					'freezing rain',
					'isolated thunderstorms',
					'isolated thundershowers'
				),
				'lightning' => array(
					'tornado',
					'severe thunderstorms'
				)
			);
		$condition = strtolower( $condition );
		foreach ( $icons_to_conditions as $icon => $condition_array ) {
			if ( in_array( $condition, $condition_array ) ) {
				return $icon_prefix . $icon;
			}
		}
		// If the condition for some reason isn't listed here,
		// no icon name will be returned and so no icon will be used
		return false;
	}
}
add_action( 'customize_register', __NAMESPACE__.'\WeatherBox::register_settings' );
