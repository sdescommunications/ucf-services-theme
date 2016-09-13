<?php
/**
 * Add and configure Shortcodes for this theme.
 * Relies on the implementation in ShortcodeBase.
 */

namespace SDES\ServicesTheme\Shortcodes;

use \StdClass;
use \Exception;
use \SimpleXMLElement;

require_once( get_stylesheet_directory() . '/functions/class-shortcodebase.php' );
	use SDES\Shortcodes\ShortcodeBase;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

require_once( get_stylesheet_directory() . '/vendor/autoload.php' );
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

	public static function callback( $attr, $content = '' ) {
		$attr = array_merge(
			$attr,
			array(
				'class' => '',
				'style' => '',
			)
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
			),
			array(
				'name'      => 'Auto Paragraph',
				'id'        => 'wpautop',
				'help_text' => 'Add paragraph tags to the content (default: false).',
				'type'      => 'bool',
				'default'   => false
			)
		), // The parameters used by the shortcode.
		$callback    = 'callback',
		$wysiwyg     = true; // Whether to add it to the shortcode Wysiwyg modal.
	public static function callback( $attr, $content='' ) {
		$attr = shortcode_atts( array(
				'color' => '#ffcc00',
				'text-color' => '#000',
				'wpautop' => false,
			),
			$attr
		);
		$style = '';
		$style .= !empty( $attr['color'] ) ? 'background: ' . $attr['color'] . ';' : '';
		$style .= !empty( $attr['text-color'] ) ? ' color: ' . $attr['text-color'] . ';' : '';

		$restore_autop = has_filter( 'the_content', 'wpautop' );
		if ( false === $attr['wpautop'] ) { remove_filter( 'the_content', 'wpautop' ); }
		ob_start();
		?>
			<aside class="callout"<?php echo !empty( $style ) ? ' style="' . $style . '"' : ''; ?>>
				<div class="container">
					<?php echo apply_filters( 'the_content', $content ); ?>
				</div>
			</aside>
		<?php
		if ( $restore_autop ) { add_filter( 'the_content', 'wpautop' ); }
		return ob_get_clean();
	}
}


require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\Campaign;
/**
 * [call_to_action] - A square "Call to Action" box (aka, Campaign).
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
		$posts = get_posts( array( 'post_type' => 'campaign' ) );
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
			echo Campaign::toHTML( $post );
		}
		return ob_get_clean();
	}
}

class sc_campaign extends ShortcodeBase {
	public
		$name        = 'Campaign', // The name of the shortcode.
		$command     = 'campaign', // The command used to call the shortcode.
		$description = 'Display a campaign.', // The description of the shortcode.
		$params      = array(
			array(
				'name'      => 'Campaign Object',
				'id'        => 'campaign_id',
				'help_text' => 'Choose the campaign to display.',
				'type'      => 'dropdown',
				'choices'   => array()
			),
			array(
				'name'      => 'Image',
				'id'        => 'image_id',
				'help_text' => 'Choose an image to display.',
				'type'      => 'image',
			),
			array(
				'name'      => 'Link',
				'id'        => 'url',
				'help_text' => 'The url for this campaign.',
				'type'      => 'text',
			),
			array(
				'name'      => 'Title',
				'id'        => 'title',
				'help_text' => 'The title for this campaign.',
				'type'      => 'text',
			),
			array(
				'name'      => 'Long Text',
				'id'        => 'long',
				'help_text' => 'The long-form text for this campaign.',
				'type'      => 'text',
			),
			array(
				'name'      => 'Short Text',
				'id'        => 'short',
				'help_text' => 'The short-form text for this campaign.',
				'type'      => 'text',
			),
			array(
				'name'      => 'Button',
				'id'        => 'btn_text',
				'help_text' => 'The button text for this campaign.',
				'type'      => 'text',
			),
		), // The parameters used by the shortcode.
		$closing_tag = false,
		$callback    = 'callback',
		$wysiwyg     = True; // Whether to add it to the shortcode Wysiwyg modal.

	public function __construct() {
		$this->params[0]['choices'] = $this->get_choices();
	}

	private function get_choices() {
		$posts = get_posts( array( 'post_type' => 'campaign' ) );
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
				'campaign_id' => null,
				'image_id' => '',
				'image_url' => '',
				'url' => '',
				'title' => '',
				'long' => '',
				'short' => '',
				'btn_text' => '',
				'layout' => 'rectangle',
			), $attr
		);
		$context = null;
		if ( ! SDES_Static::is_null_or_whitespace( $attr['campaign_id'] ) ) {
			$post = get_post( $attr['campaign_id'] );
			$context = (object) Campaign::get_render_context( $post );
		} else {
			$context = (object) array(
				'image_id' => $attr['image_id'],
				'image_url' => $attr['image_url'],
				'url' => $attr['url'],
				'title' => $attr['title'],
				'long' => $attr['long'],
				'short' => $attr['short'],
				'btn_text' => $attr['btn_text'],
			);
		}
		$context->image_url = ( ! SDES_Static::is_null_or_whitespace( $context->image_url ) )
			? $context->image_url
			: wp_get_attachment_image_src( $context->image_id, 'thumb' )[0];

		if( ! static::shouldShow($context) ) { return '<span class="campaign-invalid"><!-- Invalid Campaign --></span>'; }
		ob_start();
		switch ( $attr['layout'] ) {
			case 'square':
				echo static::render_square( $context );
				break;
			case 'rectangle':
			default:
				echo static::render( $context );
				break;
		}
		return ob_get_clean();
	}

	public static function shouldShow( $ctxt ) {
		if( "" == $ctxt->title || "" == $ctxt->btn_text ) { return false; }
		return true;
	}

	public static function render( $ctxt ) {
		ob_start();
		?>
			<div class="container-fluid">
				<div class="row campaign">
					<div class="col-sm-5 campaign-image">
						<img src="<?= $ctxt->image_url ?>">
					</div>
					<div class="col-sm-7 campaign-content">
						<div class="campaign-title">
							<a href="<?= $ctxt->url ?>"><?= $ctxt->title ?></a>
						</div>
						<p><?= $ctxt->long ?></p>
						<a href="<?= $ctxt->url ?>">
							<span class="btn btn-default btn-lg" type="button">
								<?= $ctxt->btn_text ?>
							</span>
						</a>
					</div>
				</div>
			</div>
		<?php
		return ob_get_clean();
	}

	public static function render_square( $ctxt ) {
		ob_start();
		?>
			<div class="campaign" style="background: #f3f3f3;">
				<div class="campaign-content">
					<div class="campaign-title">
						<a href="<?= $ctxt->url ?>"><?= $ctxt->title ?></a>
					</div>
					<p><?= $ctxt->short ?></p>
					<a href="<?= $ctxt->url ?>">
						<span class="btn btn-default btn-lg" type="button">
							<?= $ctxt->btn_text ?>
						</span>
					</a>
				</div>
			</div>
		<?php
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
		__NAMESPACE__.'\sc_campaign',
	));
}
add_action( 'init', __NAMESPACE__.'\register_shortcodes' );
