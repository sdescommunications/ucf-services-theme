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
	/**
	* Example Feed:
	*	{
	*	  "successfulFetch": "yes",
	*	  "provider": "http://weather.gov/",
	*	  "cachedAt": "Thu, 12 May 2016 19:21:42 -0400",
	*	  "feedUpdatedAt": "Thu, 12 May 2016 18:53:00 -0400",
	*	  "date": "2016-05-12",
	*	  "condition": "Fair",
	*	  "temp": "83&#186;",
	*	  "tempN": 83,
	*	  "imgCode": 32,
	*	  "imgSmall": "https://weather.smca.ucf.edu/img/weather-small/32.png",
	*	  "imgMedium": "https://weather.smca.ucf.edu/img/weather-medium/32.png",
	*	  "imgLarge": "https://weather.smca.ucf.edu/img/weather-large/WC32.png"
	*	}
	*/
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

	// TODO: fail better - return don't disply if n/a
	/**
	 *
	 *
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L117-L135
	 */
	public static function display_weather() {
		$weather = static::get_weather_data();
		$weather->location = property_exists( $weather, 'location' ) ? $weather->location : self::LOCATION_DEFAULT;
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
				'timeout' => 15,
			),
		);
		$context = stream_context_create( $opts );
		$file = file_get_contents( SDES_Static::get_theme_mod_defaultIfEmpty( 'weather_feed_url', self::WEATHER_FEED_URL ), false, $context );
		if ( false === $file ) {
			return (object) array(
				'condition' => 'n/a',
				'icon' => 'wi wi-na',
				'tempN' => '&ndash;',
			);
		}
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
		$icon_prefix = 'wi wi-';
		$icons_to_conditions = array(
				'day-sunny' => array(
					'fair',
					'default',
				),
				'hot' => array(
					'hot',
					'haze',
				),
				'cloudy' => array(
					'overcast',
					'partly cloudy',
					'mostly cloudy',
				),
				'snowflake-cold' => array(
					'blowing snow',
					'cold',
					'snow',
				),
				'showers' => array(
					'showers',
					'drizzle',
					'mixed rain/sleet',
					'mixed rain/hail',
					'mixed snow/sleet',
					'hail',
					'freezing drizzle',
				),
				'cloudy-gusts' => array(
					'windy'
				),
				'fog' => array(
					'dust',
					'smoke',
					'foggy',
				),
				'storm-showers' => array(
					'scattered thunderstorms',
					'scattered thundershowers',
					'scattered showers',
					'freezing rain',
					'isolated thunderstorms',
					'isolated thundershowers',
				),
				'lightning' => array(
					'tornado',
					'severe thunderstorms',
				),
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


class WeatherBox_Tutorial {
	public static function display_weather() {
		ob_start();
		?>
			<style>
				.tutorial-separator {
					height: 50px; 
					background: repeating-linear-gradient(
						-45deg,
						#eee, #ddd 10px,
						#eaeaea 10px, #eaeaea 20px
					);
				}
			</style>
			<div class="tutorial-separator"></div>
			<?= static::in_header_center() ?>
			<div class="tutorial-separator"></div>
			<?= static::in_site_nav_xs() ?>
			<div class="tutorial-separator"></div>
			<?= static::in_sections_navbar() ?>
			<div class="tutorial-separator"></div>
		<?php
		return ob_get_clean();
	}

	public static function in_header_center() {
		ob_start();
		?>
			.header-center .weather<br>
			(HEADER.site-header > .header-image > .header-center > .title-wrapper > .title-header-container > .weather):<br>
			<style>
				#tutorial-1 .header-image { height: 616.5px; background-color: #ccc; }
			</style>
			<span id="tutorial-1">
			<header class="site-header">
				<div class="header-image">
					<div class="header-center">
						<div class="title-wrapper">
							<div class="title-header-container">
								<?= WeatherBox::display_weather(); ?>
							</div>
						</div>
					</div>
				</div>
			</header>
			</span>
		<?php
		return ob_get_clean();
	}

	public static function in_site_nav_xs() {
		ob_start();
		?>
			#site-nav-xs .weather<br>
			(MAIN.site-main > #site-nav-xs > .weather):<br>
			<style>
				#tutorial-2 .site-main { height: 50px;  background-color: #000; }
			</style>
			<span id="tutorial-2">
			<main class="site-main">
				<nav id="site-nav-xs">
					<?= WeatherBox::display_weather() ?>
				</nav>
			</main>
			</span>
		<?php
		return ob_get_clean();
	}

	public static function in_sections_navbar() {
		ob_start();
		?>
			#sections-navbar.center .weather<br>
			(NAV#sections-navbar.center > .container-fluid > #sections-menu.collapse.navbar-collapse > .weather):<br>
			<style>
				#tutorial-3 #sections-navbar { height: 100px; background-color: #ffc904;}
			</style>
			<span id="tutorial-3">
			<nav id="sections-navbar" class="navbar navbar-gold center">
				<div class="container-fluid">
					<div class="navbar-header">
						<span class="navbar-title">Skip To Section</span>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sections-menu">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="sections-menu">
							<ul class="nav navbar-nav">

							</ul>
						<?= WeatherBox::display_weather() ?>
					</div>
				</div>
			</nav>
			</span>
		<?php
		return ob_get_clean();
	}
}
