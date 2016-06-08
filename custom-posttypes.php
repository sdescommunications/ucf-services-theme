<?php
/**
 *  Add and configure custom posttypes for this theme.
 * graphviz.gv: "custom-posttypes.php" -> {
 *  "class-custom-posttype.php"; "class-sdes-metaboxes.php"; "autoload.php";
 *  "Underscore\\Arrays"; 
 * };
 * graphviz.gv: "custom-posttypes.php" -> { "custom-metafields.php"; }[style="dashed"];
 */

namespace SDES\ServicesTheme\PostTypes;
use \WP_Query;
use SDES\SDES_Static as SDES_Static;
require_once( get_stylesheet_directory() . '/functions/class-sdes-metaboxes.php' );
	use SDES\SDES_Metaboxes;
require_once( get_stylesheet_directory() . '/functions/class-custom-posttype.php' );
	use SDES\CustomPostType;
require_once( get_stylesheet_directory() . '/functions/custom-metafields.php' );
	use SDES\ServicesTheme\ServicesMetaboxes;

require_once( get_stylesheet_directory() . '/vendor/autoload.php' );
use Underscore\Types\Arrays;

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

	// TODO: update .call-to-action to .spotlight
	// TODO: show when $image_url or $url is not set.
	public static function toHTML( $object ) {
		if ( null === $object ) { return "<!-- No Spotlight provided. -->"; }
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
		if ( null === $object ) { return "<!-- No IconLink provided. -->"; }
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



class StudentService extends CustomPostType {
	const ADDITIONAL_FIELDS_COUNT = 4;

	public
		$name           = 'student_service',
		$plural_name    = 'Student Services',
		$singular_name  = 'Student Service',
		$add_new_item   = 'Add New Student Service',
		$edit_item      = 'Edit Student Service',
		$new_item       = 'New Student Service',
		$public         = true,
		$use_editor     = true,
		$use_thumbnails = true,
		$use_order      = true,
		$use_title      = true,
		$use_metabox    = true,
		$use_shortcode  = true,
		$built_in       = false;

	public function fields() {
		$prefix = $this->options( 'name' ).'_';
		/*
		 * student_service_short_description
		 * student_service_events_cal_id
		 * student_service_news_feed
		 * student_service_additional_1-title
		 * student_service_additional_1-url
		 * student_service_additional_1-description
		 * student_service_additional_2-title
		 * student_service_additional_2-url
		 * student_service_additional_2-description
		 * student_service_additional_3-title
		 * student_service_additional_3-url
		 * student_service_additional_3-description
		 * student_service_additional_4-title
		 * student_service_additional_4-url
		 * student_service_additional_4-description
		 * student_service_image
		 * student_service_primary_action
		 * student_service_spotlight
		 * student_service_phone
		 * student_service_email
		 * student_service_url
		 * student_service_location
		 * student_service_hours_monday
		 * student_service_hours_tuesday
		 * student_service_hours_wednesday
		 * student_service_hours_thursday
		 * student_service_hours_friday
		 * student_service_hours_saturday
		 * student_service_hours_sunday
		 * student_service_social_facebook
		 * student_service_social_twitter
		 * student_service_social_youtube
		 */
		return array(
			array(
				'name'  => 'Short Description',
				'descr' => 'A short description of the service.',
				'id'    => $prefix.'short_description',
				'type'  => 'textarea',
			),
			array(
				'name'  => 'UCF Events Calendar ID',
				'descr' => 'The UCF Events feed calendar ID.',
				'id'    => $prefix.'events_cal_id',
				'type'  => 'text',
			),
			array(
				'name'  => 'News Feed (RSS or XML)',
				'descr' => 'A news feed to display for this service.',
				'id'    => $prefix.'news_feed',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 1 - Title',
				'descr' => '',
				'id'    => $prefix.'additional_1-title',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 1 - URL',
				'descr' => '',
				'id'    => $prefix.'additional_1-url',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 1 - Description',
				'descr' => '',
				'id'    => $prefix.'additional_1-description',
				'type'  => 'textarea',
			),
			array(
				'name'  => 'Additional Services 2 - Title',
				'descr' => '',
				'id'    => $prefix.'additional_2-title',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 2 - URL',
				'descr' => '',
				'id'    => $prefix.'additional_2-url',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 2 - Description',
				'descr' => '',
				'id'    => $prefix.'additional_2-description',
				'type'  => 'textarea',
			),
			array(
				'name'  => 'Additional Services 3 - Title',
				'descr' => '',
				'id'    => $prefix.'additional_3-title',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 3 - URL',
				'descr' => '',
				'id'    => $prefix.'additional_3-url',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 3 - Description',
				'descr' => '',
				'id'    => $prefix.'additional_3-description',
				'type'  => 'textarea',
			),
			array(
				'name'  => 'Additional Services 4 - Title',
				'descr' => '',
				'id'    => $prefix.'additional_4-title',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 4 - URL',
				'descr' => '',
				'id'    => $prefix.'additional_4-url',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 4 - Description',
				'descr' => '',
				'id'    => $prefix.'additional_4-description',
				'type'  => 'textarea',
			),
			array(
				'name'  => 'Image',
				'descr' => 'Select an image.',
				'id'    => $prefix.'image',
				'type'  => 'file',
			),
			array(
				'name'  => 'Primary Action',
				'descr' => '',
				'id'    => $prefix.'primary_action',
				'type'  => 'text',
			),
			array(
				'name'  => 'Spotlight',
				'descr' => 'Select a spotlight.',
				'id'    => $prefix.'spotlight',
				'type'  => 'spotlight',
			),
			array(
				'name'  => 'Phone',
				'descr' => '',
				'id'    => $prefix.'phone',
				'type'  => 'text',
			),
			array(
				'name'  => 'Email',
				'descr' => '',
				'id'    => $prefix.'email',
				'type'  => 'text',
			),
			array(
				'name'  => 'URL',
				'descr' => '',
				'id'    => $prefix.'url',
				'type'  => 'text',
			),
			array(
				'name'  => 'Location',
				'descr' => '',
				'id'    => $prefix.'location',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Monday',
				'descr' => '',
				'id'    => $prefix.'hours_monday',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Tuesday',
				'descr' => '',
				'id'    => $prefix.'hours_tuesday',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Wednesday',
				'descr' => '',
				'id'    => $prefix.'hours_wednesday',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Thursday',
				'descr' => '',
				'id'    => $prefix.'hours_thursday',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Friday',
				'descr' => '',
				'id'    => $prefix.'hours_friday',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Saturday',
				'descr' => '',
				'id'    => $prefix.'hours_saturday',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Sunday',
				'descr' => '',
				'id'    => $prefix.'hours_sunday',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - Facebook',
				'descr' => '',
				'id'    => $prefix.'social_facebook',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - Twitter',
				'descr' => '',
				'id'    => $prefix.'social_twitter',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - Youtube',
				'descr' => '',
				'id'    => $prefix.'social_youtube',
				'type'  => 'text',
			),
			// array(
			// 	'name'  => 'Menu',
			// 	'descr' => '',
			// 	'id'    => $prefix.'menu',
			// 	'type'  => 'menu_select',
			// ),
			// array(
			// 	'name'  => '',
			// 	'descr' => '',
			// 	'id'    => $prefix.'',
			// 	'type'  => 'text',
			// ),
		);
	}

	public function register_metaboxes() {
		if ( $this->options( 'use_metabox' ) ) {
			$metabox = $this->metabox();
			add_meta_box(
				$metabox['id'],
				$metabox['title'],
				'SDES\\ServicesTheme\\ServicesMetaboxes::show_meta_boxes',
				$metabox['page'],
				$metabox['context'],
				$metabox['priority']
			);
		}
	}

	/**
	 * Return an array of only the metadata fields used to create a render context.
	 * @param WP_Post $stusvc The stusvc whose metadata should be retrieved.
	 * @return Array The fields to pass into get_render_context.
	 */
	private static function get_render_metadata( $stusvc ) {
		$metadata_fields = array();
		$metadata_fields['stusvc_short_descr'] = get_post_meta( $stusvc->ID, 'student_service_short_description', true );
		$metadata_fields['stusvc_additional'] = 
		 Arrays::each(
		  Arrays::range( static::ADDITIONAL_FIELDS_COUNT ),
		  function( $i ) use ( $stusvc ) {
			return array(
				'title' => get_post_meta( $stusvc->ID, 'student_service_additional_' . $i . '-title', true ),
				'url' => get_post_meta( $stusvc->ID, 'student_service_additional_' . $i . '-url', true ),
				'descr' => get_post_meta( $stusvc->ID, 'student_service_additional_' . $i . '-description', true ),
			);
		 });
		$metadata_fields['stusvc_image']           = get_post_meta( $stusvc->ID, 'student_service_image', true );
		$metadata_fields['stusvc_primary_action']  = get_post_meta( $stusvc->ID, 'student_service_primary_action', true );
		$metadata_fields['stusvc_spotlight']       = get_post_meta( $stusvc->ID, 'student_service_spotlight', true );
		$metadata_fields['stusvc_phone']           = get_post_meta( $stusvc->ID, 'student_service_phone', true );
		$metadata_fields['stusvc_email']           = get_post_meta( $stusvc->ID, 'student_service_email', true );
		$metadata_fields['stusvc_url']             = get_post_meta( $stusvc->ID, 'student_service_url', true );
		$metadata_fields['stusvc_location']        = get_post_meta( $stusvc->ID, 'student_service_location', true );
		$metadata_fields['stusvc_hours_monday']    = get_post_meta( $stusvc->ID, 'student_service_hours_monday', true );
		$metadata_fields['stusvc_hours_tuesday']   = get_post_meta( $stusvc->ID, 'student_service_hours_tuesday', true );
		$metadata_fields['stusvc_hours_wednesday'] = get_post_meta( $stusvc->ID, 'student_service_hours_wednesday', true );
		$metadata_fields['stusvc_hours_thursday']  = get_post_meta( $stusvc->ID, 'student_service_hours_thursday', true );
		$metadata_fields['stusvc_hours_friday']    = get_post_meta( $stusvc->ID, 'student_service_hours_friday', true );
		$metadata_fields['stusvc_hours_saturday']  = get_post_meta( $stusvc->ID, 'student_service_hours_saturday', true );
		$metadata_fields['stusvc_hours_sunday']    = get_post_meta( $stusvc->ID, 'student_service_hours_sunday', true );
		$metadata_fields['stusvc_social_facebook'] = get_post_meta( $stusvc->ID, 'student_service_social_facebook', true );
		$metadata_fields['stusvc_social_twitter']  = get_post_meta( $stusvc->ID, 'student_service_social_twitter', true );
		$metadata_fields['stusvc_social_youtube']  = get_post_meta( $stusvc->ID, 'student_service_social_youtube', true );
 		$metadata_fields['stusvc_events_cal_id']   = get_post_meta( $stusvc->ID, 'student_service_events_cal_id', true );
		$metadata_fields['stusvc_news_feed']       = get_post_meta( $stusvc->ID, 'student_service_news_feed', true );
		return $metadata_fields;
	}

	/**
	 * Generate a render context for a student_service, given its WP_Post object and an array of its metadata fields.
	 * Expected fields:
	 * $stusvc - post_content, post_title
	 * $metadata_fields - stusvc_short_descr
	 * @param WP_Post $stusvc The post object to be displayed.
	 * @param Array   $metadata_fields The metadata fields associated with this stusvc.
	 */
	public static function get_render_context( $stusvc, $metadata_fields ) {
		return array(
			'permalink' => get_permalink( $stusvc ),
			'title' => $stusvc->post_title,
			'short_descr' => $metadata_fields['stusvc_short_descr'],
			'long_descr' => $stusvc->post_content,
			'additional' => $metadata_fields['stusvc_additional'],
			'image' => $metadata_fields['stusvc_image'],
			'primary_action' => $metadata_fields['stusvc_primary_action'],
			'spotlight' => $metadata_fields['stusvc_spotlight'],
			'phone' => $metadata_fields['stusvc_phone'],
			'email' => $metadata_fields['stusvc_email'],
			'url' => $metadata_fields['stusvc_url'],
			'location' => $metadata_fields['stusvc_location'],
			'hours_monday' => $metadata_fields['stusvc_hours_monday'],
			'hours_tuesday' => $metadata_fields['stusvc_hours_tuesday'],
			'hours_wednesday' => $metadata_fields['stusvc_hours_wednesday'],
			'hours_thursday' => $metadata_fields['stusvc_hours_thursday'],
			'hours_friday' => $metadata_fields['stusvc_hours_friday'],
			'hours_saturday' => $metadata_fields['stusvc_hours_saturday'],
			'hours_sunday' => $metadata_fields['stusvc_hours_sunday'],
			'social_facebook' => $metadata_fields['stusvc_social_facebook'],
			'social_twitter' => $metadata_fields['stusvc_social_twitter'],
			'social_youtube' => $metadata_fields['stusvc_social_youtube'],
	 		'events_cal_id' => $metadata_fields['stusvc_events_cal_id'],
			'news_feed' => $metadata_fields['stusvc_news_feed'],
		);
	}

	/**
	 * Return the HTML to show a single student_service post object in a list.
	 */
	public static function toHTML( $post_object ) {
		$metadata_fields = static::get_render_metadata( $post_object );
		$stusvc_context = static::get_render_context( $post_object, $metadata_fields );
		return static::render_to_html( $stusvc_context );
	}

	/**
	 * Render the HTML template for listing a student_service.
	 */
	protected static function render_to_html( $context ) {
		ob_start();
		?>
		<div class="image"><?= $context['image'] ?></div>
		<div class="title">
				<a href="<?= $context['permalink'] ?>">
						<?= $context['title'] ?>
				</a>
		</div>
		<div class="short-description"><?= $context['short_descr'] ?></div>
		<?php
		$html = ob_get_clean();
		return $html;
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
		__NAMESPACE__.'\StudentService',
		__NAMESPACE__.'\Spotlight',
		__NAMESPACE__.'\IconLink',
	));
}
add_action( 'init', __NAMESPACE__.'\register_custom_posttypes' );
