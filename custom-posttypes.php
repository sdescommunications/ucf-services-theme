<?php
/**
 *  Add and configure custom posttypes for this theme.
 */

namespace SDES\ServicesTheme\PostTypes;
use \WP_Query;
use SDES\SDES_Static as SDES_Static;
require_once( get_stylesheet_directory().'/functions/class-sdes-metaboxes.php' );
	use SDES\SDES_Metaboxes;
require_once( get_stylesheet_directory().'/functions/class-custom-posttype.php' );
	use SDES\CustomPostType;

/**
 * The built-in post_type named 'Post'.
 */
class Post extends CustomPostType {
	public
		$name           = 'post',
		$plural_name    = 'Posts',
		$singular_name  = 'Post',
		$add_new_item   = 'Add New Post',
		$edit_item      = 'Edit Post',
		$new_item       = 'New Post',
		$public         = true,
		$use_title      = true,
		$use_editor     = true,  // WYSIWYG editor, post content field
		$use_revisions  = true,  // Revisions on post content and titles
		$use_thumbnails = true, // Featured images
		$use_order      = true,  // Wordpress built-in order meta data
		$use_metabox    = true,  // Enable if you have custom fields to display in admin
		$use_shortcode  = false, // Auto generate a shortcode for the post type
								 // (see also objectsToHTML and toHTML methods).
		$taxonomies     = array( 'post_tag', 'category' ),
		$built_in       = true,
		// Optional default ordering for generic shortcode if not specified by user.
		$default_orderby = null,
		$default_order   = null;
}

/**
 * The built-in post_type named 'Page'.
 */
class Page extends CustomPostType {
	public
		$name           = 'page',
		$plural_name    = 'Pages',
		$singular_name  = 'Page',
		$add_new_item   = 'Add New Page',
		$edit_item      = 'Edit Page',
		$new_item       = 'New Page',
		$public         = true,
		$use_editor     = true,
		$use_thumbnails = false,
		$use_order      = true,
		$use_title      = true,
		$use_metabox    = true,
		$built_in       = true;

	public function fields() {
		$prefix = $this->options( 'name' ).'_';
		return array(
			array(
				'name'  => 'Side Column',
				'descr' => 'Show content in column to the right or left of the page (e.g., menuPanels).',
				'id'    => $prefix.'sidecolumn',
				'type'  => 'editor',
				'args'  => array( 'tinymce' => true ),
			),
		);
	}
}


/**
 * Spotlight - a box with text and a background image or a solid background color.
 *
 * @see https://github.com/UCF/Students-Theme/blob/master/custom-post-types.php#L617-L710
 */
class Spotlight extends CustomPostType {
	public
		$name           = 'spotlight',
		$plural_name    = 'Spotlights',
		$singular_name  = 'Spotlight',
		$add_new_item   = 'Add New Spotlight',
		$edit_item      = 'Edit Spotlight',
		$new_item       = 'New Spotlight',
		$public         = True,
		$use_editor     = False,
		$use_thumbnails = True,
		$use_order      = False,
		$use_title      = True,
		$use_metabox    = True,
		$taxonomies     = array();
	public function fields() {
		$prefix = $this->options( 'name' ).'_';
		return array(
			array(
				'name'        => 'Title Text Color',
				'description' => 'The color of the overlay text',
				'id'          => $prefix.'text_color',
				'type'        => 'color',
				'default'     => '#ffffff'
			),
			array(
				'name'        => 'Button Color',
				'description' => 'The background color of the call to action button',
				'id'          => $prefix.'btn_background',
				'type'        => 'color',
				'default'     => '#ffcc00'
			),
			array(
				'name'        => 'Button Text Color',
				'description' => 'The text color of the call to action button',
				'id'          => $prefix.'btn_foreground',
				'type'        => 'color',
				'default'     => '#ffffff'
			),
			array(
				'name'        => 'Button Text',
				'description' => 'The text of the call to action button',
				'id'          => $prefix.'btn_text',
				'type'        => 'text'
			),
			array(
				'name'        => 'URL',
				'description' => 'The url of the call to action',
				'id'          => $prefix.'url',
				'type'        => 'text'
			)
		);
	}
	public static function toHTML( $object ) {
		$image_url = has_post_thumbnail( $object->ID ) ?
			wp_get_attachment_image_src( get_post_thumbnail_id( $object->ID ), 'spotlight' ) :
			null;
		if ( $image_url ) {
			$image_url = $image_url[0];
		}
		$url = get_post_meta( $object->ID, 'spotlight_url', true );
		$title_color = get_post_meta( $object->ID, 'spotlight_text_color', true );
		$btn_background = get_post_meta( $object->ID, 'spotlight_btn_background', true );
		$btn_foreground = get_post_meta( $object->ID, 'spotlight_btn_foreground', true );
		$btn_text = get_post_meta( $object->ID, 'spotlight_btn_text', true );
		$btn_styles = array();
		if ( $btn_background ) : $btn_styles[] = 'background: '.$btn_background; endif;
		if ( $btn_foreground ) : $btn_styles[] = 'color: '.$btn_foreground; endif;
		ob_start();
		if ( $image_url && $url ) :
	?>
		<a class="call-to-action" href="<?php echo $url; ?>" target="_blank">
			<img src="<?php echo $image_url; ?>" alt="<?php echo $object->post_title; ?>">
			<h2 <?php if ( $title_color ) : echo 'style="color: '.$title_color.'"'; ?>><?php echo $object->post_title; endif; ?></h2>
			<?php if ( $btn_text ) : ?>
			<div class="btn-wrapper">
				<span class="btn btn-lg btn-ucf" <?php if ( !empty( $btn_styles) ) : echo implode( ' ', $btn_styles ); endif; ?>>
					<?php echo $btn_text; ?>
				</span>
			</div>
			<?php endif; ?>
		</a>
	<?php
		endif;
		return ob_get_clean();
	}
}



/**
 * A (FontAwesome) icon displayed with a title and description.
 *
 * @see https://github.com/UCF/Students-Theme/blob/master/custom-post-types.php#L564-L615
 * @see https://github.com/UCF/Students-Theme/blob/master/functions/custom-fields.php#L6-L90
 * @see sc_icon_link sc_icon_link
 */
class IconLink extends CustomPostType {
	public
		$name           = 'icon_link',
		$plural_name    = 'Icon Links',
		$singular_name  = 'Icon Link',
		$add_new_item   = 'Add New Icon Link',
		$edit_item      = 'Edit Icon Link',
		$new_item       = 'New Icon Link',
		$public         = True,
		$use_editor     = True,
		$use_thumbnails = False,
		$use_order      = True,
		$use_title      = True,
		$use_metabox    = True,
		$taxonomies     = array( );
	public function fields() {
		$prefix = $this->options( 'name' ) . '_';
		return array(
			array(
				'name' => 'Icon',
				'description' => '',
				'id' => $prefix.'icon',
				'type' => 'icon'
			),
			array(
				'name' => 'URL',
				'description' => 'The URL of the icon link',
				'id' => $prefix.'url',
				'type' => 'text'
			)
		);
	}
	public static function toHTML( $object ) {
		$icon = get_post_meta( $object->ID, 'icon_link_icon', true );
		$url = get_post_meta( $object->ID, 'icon_link_url', true );
		ob_start();
	?>
		<div class="icon-link">
			<a href="<?php echo $url; ?>" target="_blank">
				<div class="icon-wrapper">
					<span class="fa <?php echo $icon; ?>"></span>
				</div>
				<h3><?php echo $object->post_title; ?></h3>
				<p><?php echo $object->post_content; ?></p>
			</a>
		</div>
	<?php
		return ob_get_clean();
	}
}



/**
 * Register custom post types when the theme is initialized.
 * @see http://codex.wordpress.org/Plugin_API/Action_Reference/init WP-Codex: init action hook.
 */
function register_custom_posttypes() {
	CustomPostType::Register_Posttypes(array(
		__NAMESPACE__.'\Post',
		__NAMESPACE__.'\Page',
		__NAMESPACE__.'\Spotlight',
		__NAMESPACE__.'\IconLink',
	));
}
add_action( 'init', __NAMESPACE__.'\register_custom_posttypes' );
