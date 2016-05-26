<?php
/**
 * Add and configure Shortcodes for this theme.
 * Relies on the implementation in ShortcodeBase.
 */

namespace SDES\ServicesTheme\Shortcodes;

use \StdClass;
use \Exception;
use \SimpleXMLElement;

require_once( get_stylesheet_directory().'/functions/class-shortcodebase.php' );
	use SDES\Shortcodes\ShortcodeBase;

require_once( 'functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

require_once( get_stylesheet_directory().'/vendor/autoload.php' );
use Underscore\Types\Arrays;

/**
 * [row] - Wrap HTML in a Boostrap CSS row.
 *
 * @see https://github.com/UCF/Students-Theme/blob/d56183079c70836adfcfaa2ac7b02cb4c935237d/shortcodes.php#L454-L504
 */
class sc_row extends ShortcodeBase {
	public
	$name        = 'Row',
	$command     = 'row',
	$description = 'Wraps content in a bootstrap row.',
	$render      = false,
	$params      = array(
		array(
			'name'      => 'Add Container',
			'id'        => 'container',
			'help_text' => 'Wrap the row in a container div',
			'type'      => 'checkbox',
		),
		array(
			'name'      => 'Additional Classes',
			'id'        => 'class',
			'help_text' => 'Additional css classes',
			'type'      => 'text',
		),
		array(
			'name'      => 'Inline Styles',
			'id'        => 'style',
			'help_text' => 'Inline css styles',
			'type'      => 'text',
		),
	),
	$callback    = 'callback',
	$wysiwyg     = true;

	public static function callback( $attr, $content = '' ) {
		$attr = shortcode_atts(
			array(
				'container' => 'false',
				'class'     => '',
				'style'    => '',
			), $attr
		);

		ob_start();
		?>
		<?php if ( 'true' === $attr['container'] ) : ?>
		<div class="container">
		<?php endif; ?>
			<div class="row <?php echo $attr['class'] ? $attr['class'] : ''; ?>"<?php echo $attr['style'] ? ' style="' . $attr['style'] . '"' : '';?>>
				<?php echo apply_filters( 'the_content', $content ); ?>
			</div>
		<?php if ( 'true' === $attr['container'] ) : ?>
		</div>
		<?php endif; ?>
		<?php
		return ob_get_clean();
	}
}

/**
 * [column] - Wrap HTML in a Boostrap CSS column.
 *
 * @see https://github.com/UCF/Students-Theme/blob/d56183079c70836adfcfaa2ac7b02cb4c935237d/shortcodes.php#L506-L650
 */
class sc_column extends ShortcodeBase {
	public
	$name        = 'Column',
	$command     = 'column',
	$description = 'Wraps content in a bootstrap column',
	$render      = 'render',
	$params      = array(
		array(
			'name'      => 'Large Size',
			'id'        => 'lg',
			'help_text' => 'The size of the column when the screen is > 1200px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Medium Size',
			'id'        => 'md',
			'help_text' => 'The size of the column when the screen is between 992px and 1199px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Small Size',
			'id'        => 'sm',
			'help_text' => 'The size of the column when the screen is between 768px and 991px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Extra Small Size',
			'id'        => 'xs',
			'help_text' => 'The size of the column when the screen is < 767px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Large Offset',
			'id'        => 'lg_offset',
			'help_text' => 'The offset of the column when the screen is > 1200px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Medium Offset',
			'id'        => 'md_offset',
			'help_text' => 'The offset of the column when the screen is between 992px and 1199px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Small Offset',
			'id'        => 'sm_offset',
			'help_text' => 'The offset of the column when the screen is between 768px and 991px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Extra Small Offset',
			'id'        => 'xs_offset',
			'help_text' => 'The offset of the column when the screen is < 767px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Large Push',
			'id'        => 'lg_push',
			'help_text' => 'Pushes the column the specified number of column widths when the screen is > 1200px (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Medium Push',
			'id'        => 'md_push',
			'help_text' => 'Pushes the column the specified number of column widths when the screen is between 992px and 1199px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Small Push',
			'id'        => 'sm_push',
			'help_text' => 'Pushes the column the specified number of column widths when the screen is between 768px and 991px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Extra Small Push',
			'id'        => 'xs_push',
			'help_text' => 'Pushes the column the specified number of column widths when the screen is < 767px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Large Pull',
			'id'        => 'lg_pull',
			'help_text' => 'Pulls the column the specified number of column widths when the screen is > 1200px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Medium Offset Size',
			'id'        => 'md_pull',
			'help_text' => 'Pulls the column the specified number of column widths when the screen is between 992px and 1199px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Small Offset Size',
			'id'        => 'sm_pull',
			'help_text' => 'Pulls the column the specified number of column widths when the screen is between 768px and 991px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Extra Small Offset Size',
			'id'        => 'xs_pull',
			'help_text' => 'Pulls the column the specified number of column widths when the screen is < 767px wide (1-12)',
			'type'      => 'text',
		),
		array(
			'name'      => 'Additional Classes',
			'id'        => 'class',
			'help_text' => 'Any additional classes for the column',
			'type'      => 'text',
		),
		array(
			'style'     => 'Inline Styles',
			'id'        => 'style',
			'help_text' => 'Any additional inline styles for the column',
			'type'      => 'text',
		),
	),
	$callback    = 'callback',
	$wysiwig     = true;

	/**
	 * @see http://codex.wordpress.org/Function_Reference/shortcode_atts  WP-Codex: shortcode_atts()
	 */
	public static function callback( $attr, $content = '' ) {
		$attr = shortcode_atts(
			array(
			'class' => '',
			'style' => '',
			), $attr
		);
		// Size classes.
		$classes = array( $attr['class'] ? $attr['class'] : '' );

		$prefixes = array( 'xs', 'sm', 'md', 'lg' );
		$suffixes = array( '', '_offset', '_pull', '_push' );

		foreach ( $prefixes as $prefix ) {
			foreach ( $suffixes as $suffix ) {
				if ( array_key_exists( $prefix.$suffix, $attr ) ) {
					$suf = str_replace( '_', '-', $suffix );
					$classes[] = 'col-'.$prefix.$suf.'-'.$attr[ $prefix.$suffix ];
				}
			}
		}

		$ctxt['cls_str'] = esc_attr( implode( ' ', $classes ) );
		$ctxt['style'] = esc_attr( $attr['style'] );
		$ctxt['content'] = apply_filters( 'the_content', $content );
		return static::render( $ctxt );
	}

	public static function render( $ctxt ) {
		ob_start();
		?>
		<div class="<?= $ctxt['cls_str'] ?>" style="<?= $ctxt['style'] ?>">
		<?= $ctxt['content'] ?>
		</div>
		<?php
		return ob_get_clean();
	}
}


require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\IconLink;
/**
 * [icon_link] - Create a full-width box with icon_links centered inside.
 *
 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/shortcodes.php#L410-L460
 * @see https://github.com/UCF/Students-Theme/blob/master/custom-post-types.php#L564-L615
 * @uses IconLink IconLink
 **/
class sc_icon_link extends ShortcodeBase {
	public
		$name        = 'Icon Link', // The name of the shortcode.
		$command     = 'icon_link', // The command used to call the shortcode.
		$description = 'Displays the specified icon link', // The description of the shortcode.
		$params      = array(
			array(
				'name'      => 'Icon Link',
				'id'        => 'icon_link_id',
				'help_text' => 'The icon link you want to display',
				'type'      => 'dropdown',
				'choices'   => array()
			)
		), // The parameters used by the shortcode.
		$callback    = 'callback',
		$closing_tag = false,
		$wysiwyg     = true; // Whether to add it to the shortcode Wysiwyg modal.
	public function __construct() {
		$this->params[0]['choices'] = $this->get_choices();
	}
	private function get_choices() {
		$posts = get_posts( array( 'post_type' => 'icon_link' ) );
		$retval = array( array( 'name' => '-- Choose Icon Link --', 'value' => '' ) );
		foreach( $posts as $post ) {
			$retval[] = array(
				'name'  => $post->post_title,
				'value' => $post->ID
			);
		}
		return $retval;
	}
	public static function callback( $attr, $content='' ) {
		$attr = shortcode_atts( array(
				'icon_link_id' => ''
			), $attr
		);
		if ( isset( $attr['icon_link_id'] ) ) {
			$post = get_post( $attr['icon_link_id'] );
			return IconLink::toHTML( $post );
		} else {
			return '';
		}
	}
}


/**
 * [callout] - A callout box to display colored text over a background color.
 *
 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/shortcodes.php#L363-L408
 */
class sc_callout extends ShortcodeBase {
	public
		$name        = 'Callout', // The name of the shortcode.
		$command     = 'callout', // The command used to call the shortcode.
		$description = 'Creates a callout box', // The description of the shortcode.
		$params      = array(
			array(
				'name'      => 'Color',
				'id'        => 'color',
				'help_text' => 'The color of the callout box',
				'type'      => 'color',
				'default'   => '#ffcc00'
			),
			array(
				'name'      => 'Text',
				'id'        => 'text-color',
				'help_text' => 'The color of the text within the callout box',
				'type'      => 'color',
				'default'   => '#000000'
			)
		), // The parameters used by the shortcode.
		$callback    = 'callback',
		$wysiwyg     = true; // Whether to add it to the shortcode Wysiwyg modal.
	public static function callback( $attr, $content='' ) {
		$attr = shortcode_atts( array(
				'color' => '#ffcc00',
				'text-color' => '#000'
			),
			$attr
		);
		$style = '';
		$style .= !empty( $attr['color'] ) ? 'background: ' . $attr['color'] . ';' : '';
		$style .= !empty( $attr['text-color'] ) ? ' color: ' . $attr['text-color'] . ';' : '';
		ob_start();
		?>
			<aside class="callout"<?php echo !empty( $style ) ? ' style="' . $style . '"' : ''; ?>>
				<div class="container">
					<?php echo apply_filters( 'the_content', $content ); ?>
				</div>
			</aside>
		<?php
		return ob_get_clean();
	}
}


require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\Spotlight;
/**
 * [call_to_action] - A square "Call to Action" box (aka, Spotlight).
 *
 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/shortcodes.php#L113-160
 */
class sc_call_to_action extends ShortcodeBase {
	public
		$name        = 'Call to Action', // The name of the shortcode.
		$command     = 'call_to_action', // The command used to call the shortcode.
		$description = 'Displays a call to action image and text.', // The description of the shortcode.
		$params      = array(
			array(
				'name'      => 'Call to Action Object',
				'id'        => 'cta_id',
				'help_text' => 'Choose the call to action to display',
				'type'      => 'dropdown',
				'choices'   => array()
			)
		), // The parameters used by the shortcode.
		$callback    = 'callback',
		$wysiwyg     = True; // Whether to add it to the shortcode Wysiwyg modal.
	public function __construct() {
		$this->params[0]['choices'] = $this->get_choices();
	}
	private function get_choices() {
		$posts = get_posts( array( 'post_type' => 'spotlight' ) );
		$retval = array( array( 'name' => '--- Choose ---', 'value' => null ) );
		foreach( $posts as $post ) {
			$retval[] = array(
				'name'  => $post->post_title,
				'value' => $post->ID
			);
		}
		return $retval;
	}
	public static function callback( $attr, $content='' ) {
		$attr = shortcode_atts( array(
				'cta_id' => null
			), $attr
		);
		ob_start();
		if ( $attr['cta_id'] ) {
			$post = get_post( $attr['cta_id'] );
			echo Spotlight::toHTML( $post );
		}
		return ob_get_clean();
	}
}

function register_shortcodes() {
	ShortcodeBase::Register_Shortcodes(array(
		__NAMESPACE__.'\sc_row',
		__NAMESPACE__.'\sc_column',
		__NAMESPACE__.'\sc_icon_link',
		__NAMESPACE__.'\sc_callout',
		__NAMESPACE__.'\sc_call_to_action',
	));
}
add_action( 'init', __NAMESPACE__.'\register_shortcodes' );
