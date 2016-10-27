<?php
/**
 * Helper classes for the Header - require from ThemeCustomizer.php to add action to 'customize_register' before it fires.
 *
 * Graphviz.gv: "header-settings.php" -> { "class-feedmanager.php"; "class-sdes-customizer-helper.php"; "class-sdes-static.php"; };
 *
 * @package SDES\ServicesTheme\ThemeCustomizer
 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions/config.php#L449-L502
 */

namespace SDES\ServicesTheme\ThemeCustomizer;

require_once( get_stylesheet_directory() . '/functions/class-feedmanager.php' );
	use FeedManager;

require_once( get_stylesheet_directory() . '/functions/class-sdes-customizer-helper.php' );
	use SDES\CustomizerControls\SDES_Customizer_Helper;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

/**
 * Class to define header settings and Theme Customizer controls.
 */
class Header_Settings {
	const HEADER_NAV_URL = 'http://www.ucf.edu/wp-json/ucf-rest-menus/v1/menus/52';

	/**
	 * Retrieve and cache remote feeds as json objects, e.g., services_theme-remote_menus_header_menu_feed.
	 *
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions.php#L42-L75
	 * @todo Evaluate general PHP alternatives to WP transients (PSR-6 caching).
	 */
	public static function get_remote_menu( $menu_name ) {
		global $wp_customize;
		$customizing = isset( $wp_customize );
		$result_name = $menu_name.'_json';
		$result = get_transient( $result_name );
		if ( false === $result || $customizing ) {
			$opts = array(
				'http' => array(
					'timeout' => 15,
				),
			);
			$context = stream_context_create( $opts );
			$file_location = SDES_Static::get_theme_mod_defaultIfEmpty( $menu_name.'_feed', self::HEADER_NAV_URL );
			if ( empty( $file_location ) ) {
				return;
			}
			$headers = get_headers( $file_location );
			$response_code = substr( $headers[0], 9, 3 );
			if ( '200' !== $response_code ) {
				return;
			}
			$result = json_decode( file_get_contents( $file_location, false, $context ) ); // @codingStandardsIgnoreLine WordPress.VIP.RestrictedFunctions.file_get_contents
			if ( ! $customizing ) {
				set_transient( $result_name, $result, (60 * 60 * 24) );
			}
		}
		return $result;
	}

	public static function register_header_settings( $wp_customize ) {
		// $panelId = 'header_panel';
		// $wp_customize->add_panel( $panelId, array(
		  // 'title' => __( 'Header' ),
		  // 'description' => 'Header Settings', // Include html tags such as <p>.
		  // 'priority' => 1000, // Mixed with top-level-section hierarchy.
		// ) );
		// $section_args = array( 'panelId' => $panelId );
		$section_args = array();

		static::add_section_remote_menus( $wp_customize, $section_args );
	}

	public static function add_section_remote_menus( $wp_customize, $args = null ) {
		/* SECTION */
		$section = 'services_theme-remote_menus';
		$wp_customize->add_section(
			$section,
			array(
				'title'    => 'Remote Menus',
				'description' => '',
				'priority' => 1000, // Set to 30 to be just below "Site Identity".
				'panel' => array_key_exists( 'panelId', $args ) ? $args['panelId'] : '',
			)
		);
		$wp_customize->add_setting(
			'services_theme-remote_menus_header_menu_feed',
			array(
				'default'     => self::HEADER_NAV_URL,
			)
		);
		$wp_customize->add_control(
			'services_theme-remote_menus_header_menu_feed',
			array(
				'type'        => 'text',
				'label'       => 'Header Menu Feed',
				'description' => 'The JSON feed of the www.ucf.edu header menu.',
				'section'     => $section,
			)
		);
	}
}
add_action( 'customize_register', __NAMESPACE__.'\Header_Settings::register_header_settings' );


/**
 * Helper class for generating Header HTML.
 */
class Header {
	/**
	 * Display the header menu on MD and LG screens (by default, 992px or larger).
	 *
	 * @see: https://github.com/UCF/Students-Theme/blob/2489e796a9438180e67f729dcd7ef655eecdd24f/functions.php#L86-L92
	 */
	public static function display_nav_header() {
		$menu = Header_Settings::get_remote_menu( 'services_theme-remote_menus_header_menu_feed' );
		if ( empty( $menu ) ) {
			return;
		}
		ob_start();
	?>
		<nav id="nav-header-wrap" role="navigation" class="screen-only hidden-xs hidden-sm">
			<ul id="header-menu" class="menu-list-unstyled list-inline text-center horizontal">
			<?php foreach ( $menu->items as $item ) : ?>
				<li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>
			<?php endforeach; ?>
			</ul>
		</nav>
	<?php
		echo ob_get_clean();
	}

	/**
	 * Display the header menu on XS and SM screens (by default, screens smaller than 991px).
	 *
	 * @see: https://github.com/UCF/Students-Theme/blob/2489e796a9438180e67f729dcd7ef655eecdd24f/functions.php#L94-L111
	 */
	public static function display_nav_header_xs() {
		$menu = Header_Settings::get_remote_menu( 'services_theme-remote_menus_header_menu_feed' );
		if ( empty( $menu ) ) {
			return;
		}
		ob_start();
	?>			
		<nav id="site-nav-xs" class="hidden-md hidden-lg navbar navbar-inverse">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-menu-xs-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span class="navbar-title">Navigation</span>
			</div>
			<div class="collapse navbar-collapse" id="header-menu-xs-collapse">
				<ul id="header-menu-xs" class="menu nav navbar-nav">
				<?php foreach ( $menu->items as $item ) : ?>
					<li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a></li>
				<?php endforeach; ?>
				</ul>
			</div>
		</nav>
	<?php
		echo ob_get_clean();
	}
}
