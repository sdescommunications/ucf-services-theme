<?php
/**
 *  Add and configure custom posttypes for this theme.
 * graphviz.gv: "custom-posttypes.php" -> {
 *  "class-custom-posttype.php"; "class-sdes-metaboxes.php"; "class-feedmanager.php"; "autoload.php"; 
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

require_once( get_stylesheet_directory() . '/functions/class-feedmanager.php' );
	use FeedManager;
	use UcfEventModel;
	use UcfAcademicCalendarModel;

require_once( get_stylesheet_directory() . '/vendor/autoload.php' );
use Underscore\Types\Arrays;

abstract class CustomPostType_ServicesTheme extends CustomPostType {
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
}

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
class Page extends CustomPostType_ServicesTheme {
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
				'name'  => 'Campaig - Primary',
				'descr' => 'Select a primary campaign.',
				'id'    => $prefix.'campaign_primary',
				'type'  => 'campaign',
			),

			array(
				'name'  => 'Campaign - Sidebar',
				'descr' => 'Select a sidebar campaign.',
				'id'    => $prefix.'campaign_sidebar',
				'type'  => 'campaign',
			),
			array(
				'name'  => 'Icon Link 1',
				'descr' => 'Select an icon link.',
				'id'    => $prefix.'icon_link-1',
				'type'  => 'icon_link',
			),
			array(
				'name'  => 'Icon Link 2',
				'descr' => 'Select an icon link.',
				'id'    => $prefix.'icon_link-2',
				'type'  => 'icon_link',
			),
			array(
				'name'  => 'Icon Link 3',
				'descr' => 'Select an icon link.',
				'id'    => $prefix.'icon_link-3',
				'type'  => 'icon_link',
			),
		);
	}
}


/**
 * Campaign - a box with text and a background image or a solid background color.
 *
 * @see https://github.com/UCF/Students-Theme/blob/master/custom-post-types.php#L617-L710
 */
class Campaign extends CustomPostType {
	const NAME = 'campaign';
	public
		$name           = 'campaign',
		$plural_name    = 'Campaigns',
		$singular_name  = 'Campaign',
		$add_new_item   = 'Add New Campaign',
		$edit_item      = 'Edit Campaign',
		$new_item       = 'New Campaign',
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
				'name'        => 'URL',
				'description' => 'The url of the call to action',
				'id'          => $prefix.'url',
				'type'        => 'text'
			),
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
				'name'        => 'Campaign - Long Text',
				'description' => 'Body text for use in a large/rectangle campaign.',
				'id'          => $prefix.'long',
				'type'        => 'text'
			),
			array(
				'name'        => 'Campaign - Short Text',
				'description' => 'Body text for use in a small/square campaign.',
				'id'          => $prefix.'short',
				'type'        => 'text'
			),
		);
	}

	public static function get_render_context ( $campaign, $metadata_fields = null ) {
		$image_url = has_post_thumbnail( $campaign->ID ) ?
			wp_get_attachment_image_src( get_post_thumbnail_id( $campaign->ID ), 'campaign' ) :
			null;
		if ( $image_url ) {
			$image_url = $image_url[0];
		}
		$url = get_post_meta( $campaign->ID, 'campaign_url', true );
		$title_color = get_post_meta( $campaign->ID, 'campaign_text_color', true );
		$btn_background = get_post_meta( $campaign->ID, 'campaign_btn_background', true );
		$btn_foreground = get_post_meta( $campaign->ID, 'campaign_btn_foreground', true );
		$btn_text = get_post_meta( $campaign->ID, 'campaign_btn_text', true );
		$btn_styles = array();
		if ( $btn_background ) : $btn_styles[] = 'background: '.$btn_background; endif;
		if ( $btn_foreground ) : $btn_styles[] = 'color: '.$btn_foreground; endif;
		$btn_styles = ( !empty( $btn_styles) ) ? implode( ' ', $btn_styles ) : '';
		ob_start();
		return array(
			'url' => $url,
			'image_id' => null,
			'image_url' => $image_url,
			'image_alt' => $campaign->post_title,
			'title' => $campaign->post_title,
			'long' => get_post_meta( $campaign->ID, 'campaign_long', true ),
			'short' => get_post_meta( $campaign->ID, 'campaign_short', true ),
			'title_color' => $title_color,
			'btn_text' => $btn_text,
			'btn_styles' => $btn_styles,
		);
	}

	// TODO: show when $image_url or $url is not set.
	public static function toHTML( $object ) {
		$object = get_post( $object );
		if ( SDES_Static::is_null_or_whitespace( $object ) 
			|| self::NAME !== $object->post_type ) {return sprintf("<!-- No %s provided. -->", self::NAME); }
		$context = static::get_render_context( $object, $metadata_fields );
		return static::render_to_html( $context );
	}

	/**
	 * Render the HTML template for listing a campaign.
	 * Expected properties:
	 * $context - url, image_url, image_alt, title, title_color, btn_text, btn_styles.
	 */
	public static function render_to_html( $context ) {
		$context->style = ( $context->title_color )
			? 'color: ' . $context->title_color . ';'
			: '';
		ob_start();
		?>
			<a class="campaign-spotlight" href="<?= $context->url ?>" target="_blank">
				<img src="<?= $context->image_url ?>" alt="<?= $context->image_alt ?>">
			  <?php if ( $context->title ) : ?>
				<h2 style="<?= $context->style ?>">
					<?= $context->title; ?>
				</h2>
			  <?php endif;
			  if ( $context->btn_text ) : ?>
				<div class="btn-wrapper">
					<span class="btn btn-lg btn-ucf" style="<?= $context->btn_styles ?>">
						<?= $context->btn_text ?>
					</span>
				</div>
			  <?php endif; ?>
			</a>
		<?php
		$html = ob_get_clean();
		return $html;
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
	const NAME = 'icon_link';
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

	public static function get_render_context( $iconlink, $metadata_fields = null ) {
		$iconlink = get_post( $iconlink );
		return (object) array(
			'url'  => get_post_meta( $iconlink->ID, 'icon_link_url', true ),
			'icon' => get_post_meta( $iconlink->ID, 'icon_link_icon', true ),
			'title' => $iconlink->post_title,
			'text' => $iconlink->post_content,
		);
	}

	public static function toHTML( $iconlink ) {
		$iconlink = get_post( $iconlink );
		if ( SDES_Static::is_null_or_whitespace( $iconlink ) 
			 || self::NAME !== $iconlink->post_type ) {return sprintf("<!-- No %s provided. -->", self::NAME); }
		$context = static::get_render_context( $iconlink );
		return static::render_html( $context );
	}

	public static function render_html( $context ) {
		$context->css_classes = property_exists( $context, 'css_classes') ? $context->css_classes
			: 'col-md-4 icon-link';
		ob_start();
	?>
		<div class="<?= $context->css_classes; ?>">
			<a href="<?= $context->url; ?>" target="_blank">
				<div class="icon-wrapper">
					<span class="fa <?= $context->icon; ?>"></span>
				</div>
				<h3><?= $context->title; ?></h3>
				<p><?= $context->text; ?></p>
			</a>
		</div>
	<?php
		return ob_get_clean();
	}
}



class StudentService extends CustomPostType_ServicesTheme {
	const NAME = 'student_service';
	const ADDITIONAL_FIELDS_COUNT = 5;

	public
		$name           = 'student_service',
		$plural_name    = 'Student Services',
		$singular_name  = 'Student Service',
		$add_new_item   = 'Add New Student Service',
		$edit_item      = 'Edit Student Service',
		$new_item       = 'New Student Service',
		$public         = true,
		$use_title      = true,
		$use_editor     = true,
		$use_revisions  = true,
		$use_thumbnails = true,
		$use_order      = false,
		$use_metabox    = true,
		$use_shortcode  = true,
		$taxonomies     = array( 'post_tag', 'category', 'curation_groups', 'service_cost', 'service_type', ),
		$menu_icon      = null,
		$rewrite        = array( 'slug' => 's', 'with_front' => true ),
		$built_in       = false,
		// Optional default ordering for generic shortcode if not specified by user.
		$default_orderby = null,
		$default_order   = null,
		// Interface Columns/Fields.
		$calculated_columns = array( 
			array( 'heading' => 'Thumbnail', 'column_name' => '_thumbnail_id', 'order' => 100, 'sortable' => false ),
		), // Calculate values within custom_column_echo_data.
		$sc_interface_fields = null; // Fields for shortcodebase interface (false hides from list, null shows only the default fields).

	// TODO: create additional_#-* fields programmatically using self::ADDITIONAL_FIELDS_COUNT.
	// TODO: separate open and close times - create programmatically from an array of days of the week.
	// TODO: implement by calling a static `get_fields` method (to also be called from get_render_metadata).
	public function fields() {
		$prefix = $this->options( 'name' ).'_';
		/*
		 * student_service_main_category_id
		 * student_service_heading_text
		 * student_service_short_description
		 * student_service_events_cal_feed
		 * student_service_map_id
		 * student_service_gallery_url-flickr
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
		 * student_service_additional_5-title
		 * student_service_additional_5-url
		 * student_service_additional_5-description
		 * student_service_image
		 * student_service_primary_action
		 * student_service_primary_url
		 * student_service_phone
		 * student_service_email
		 * student_service_url
		 * student_service_url_text
		 * student_service_location
		 * student_service_hours_monday_open
		 * student_service_hours_monday_close
		 * student_service_hours_tuesday_open
		 * student_service_hours_tuesday_close
		 * student_service_hours_wednesday_open
		 * student_service_hours_wednesday_close
		 * student_service_hours_thursday_open
		 * student_service_hours_thursday_close
		 * student_service_hours_friday_open
		 * student_service_hours_friday_close
		 * student_service_hours_saturday_open
		 * student_service_hours_saturday_close
		 * student_service_hours_sunday_open
		 * student_service_hours_sunday_close
		 * student_service_social_facebook
		 * student_service_social_twitter
		 * student_service_social_youtube
		 * student_service_social_googleplus
		 * student_service_social_linkedin
		 * student_service_social_instagram
		 * student_service_social_pinterest
		 * student_service_social_tumblr
		 * student_service_social_flickr
		 */
		return array(
			array(
				'name'  => 'Main Category',
				'descr' => 'The main category for this service, to be used by breadcrumbs navigation.',
				'id'    => $prefix.'main_category_id',
				'type'  => 'taxonomy',
			),
			array(
				'name'  => 'Heading Text',
				'descr' => 'Text shown over the featured (header) image.',
				'id'    => $prefix.'heading_text',
				'type'  => 'text',
			),
			array(
				'name'  => 'Short Description',
				'descr' => 'A short description of the service.',
				'id'    => $prefix.'short_description',
				'type'  => 'textarea',
			),
			array(
				'name'  => 'UCF Events Calendar Feed',
				'descr' => 'The address of the UCF Events calendar feed from events.ucf.edu.',
				'id'    => $prefix.'events_cal_feed',
				'type'  => 'text',
			),
			array(
				'name'  => 'UCF Map ID',
				'descr' => 'The UCF Map ID from map.ucf.edu.',
				'id'    => $prefix.'map_id',
				'type'  => 'text',
			),
			array(
				'name'  => 'Gallery URL - Flickr',
				'descr' => 'A link to a flickr gallery.',
				'id'    => $prefix.'gallery_url-flickr',
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
				'name'  => 'Additional Services 5 - Title',
				'descr' => '',
				'id'    => $prefix.'additional_5-title',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 5 - URL',
				'descr' => '',
				'id'    => $prefix.'additional_5-url',
				'type'  => 'text',
			),
			array(
				'name'  => 'Additional Services 5 - Description',
				'descr' => '',
				'id'    => $prefix.'additional_5-description',
				'type'  => 'textarea',
			),
			array(
				'name'  => 'Image',
				'descr' => 'Select an image.',
				'id'    => $prefix.'image',
				'type'  => 'image',
			),
			array(
				'name'  => 'Primary Action',
				'descr' => '',
				'id'    => $prefix.'primary_action',
				'type'  => 'text',
			),
			array(
				'name'  => 'Primary Action URL',
				'descr' => 'Link to a website, a phone number, or an email.',
				'id'    => $prefix.'primary_action_url',
				'type'  => 'text',
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
				'name'  => 'URL Text',
				'descr' => '',
				'id'    => $prefix.'url_text',
				'type'  => 'text',
			),
			array(
				'name'  => 'Location',
				'descr' => '',
				'id'    => $prefix.'location',
				'type'  => 'text',
			),
			array(
				'name'  => 'Hours - Monday Open',
				'descr' => '',
				'id'    => $prefix.'hours_monday_open',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Monday Close',
				'descr' => '',
				'id'    => $prefix.'hours_monday_close',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Tuesday Open',
				'descr' => '',
				'id'    => $prefix.'hours_tuesday_open',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Tuesday Close',
				'descr' => '',
				'id'    => $prefix.'hours_tuesday_close',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Wednesday Open',
				'descr' => '',
				'id'    => $prefix.'hours_wednesday_open',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Wednesday Close',
				'descr' => '',
				'id'    => $prefix.'hours_wednesday_close',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Thursday Open',
				'descr' => '',
				'id'    => $prefix.'hours_thursday_open',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Thursday Close',
				'descr' => '',
				'id'    => $prefix.'hours_thursday_close',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Friday Open',
				'descr' => '',
				'id'    => $prefix.'hours_friday_open',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Friday Close',
				'descr' => '',
				'id'    => $prefix.'hours_friday_close',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Saturday Open',
				'descr' => '',
				'id'    => $prefix.'hours_saturday_open',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Saturday Close',
				'descr' => '',
				'id'    => $prefix.'hours_saturday_close',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Sunday Open',
				'descr' => '',
				'id'    => $prefix.'hours_sunday_open',
				'type'  => 'time',
			),
			array(
				'name'  => 'Hours - Sunday Close',
				'descr' => '',
				'id'    => $prefix.'hours_sunday_close',
				'type'  => 'time',
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
			array(
				'name'  => 'Social - Google Plus',
				'descr' => '',
				'id'    => $prefix.'social_googleplus',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - LinkedIn',
				'descr' => '',
				'id'    => $prefix.'social_linkedin',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - Instagram',
				'descr' => '',
				'id'    => $prefix.'social_instagram',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - Pinterest',
				'descr' => '',
				'id'    => $prefix.'social_pinterest',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - Tumblr',
				'descr' => '',
				'id'    => $prefix.'social_tumblr',
				'type'  => 'text',
			),
			array(
				'name'  => 'Social - Flickr',
				'descr' => '',
				'id'    => $prefix.'social_flickr',
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

	// TODO: generate get_render_metadata using a self::get_fields method, return as `(object)array()`.
	/**
	 * Return an array of only the metadata fields used to create a render context.
	 * @param WP_Post $stusvc The stusvc whose metadata should be retrieved.
	 * @return Array The fields to pass into get_render_context.
	 */
	private static function get_render_metadata( $stusvc ) {
		$metadata_fields = array();
		$metadata_fields['stusvc_main_category_id'] = get_post_meta( $stusvc->ID, 'student_service_main_category_id', true ) ?: -1;
		$metadata_fields['stusvc_heading_text'] = get_post_meta( $stusvc->ID, 'student_service_heading_text', true );
		$metadata_fields['stusvc_short_descr'] = get_post_meta( $stusvc->ID, 'student_service_short_description', true );
		$metadata_fields['stusvc_gallery'] = array(
			'flickr' => get_post_meta( $stusvc->ID, 'student_service_gallery_url-flickr', true )
		);
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

		$metadata_fields['stusvc_image']				= get_post_meta( $stusvc->ID, 'student_service_image', true );
		$metadata_fields['stusvc_image_alt']			= get_post_meta( $metadata_fields['stusvc_image'], '_wp_attachment_image_alt', true );
		$metadata_fields['stusvc_image_thumbnail_src']  = wp_get_attachment_image_src( $metadata_fields['stusvc_image'], 'thumb', false )[0];

		$metadata_fields['stusvc_primary_action']  = get_post_meta( $stusvc->ID, 'student_service_primary_action', true );
		$metadata_fields['stusvc_primary_action_url']  = get_post_meta( $stusvc->ID, 'student_service_primary_action_url', true );
		$metadata_fields['stusvc_phone']           = get_post_meta( $stusvc->ID, 'student_service_phone', true );
		$metadata_fields['stusvc_email']           = get_post_meta( $stusvc->ID, 'student_service_email', true );
		$metadata_fields['stusvc_url']             = get_post_meta( $stusvc->ID, 'student_service_url', true );
		$metadata_fields['stusvc_url_text']             = get_post_meta( $stusvc->ID, 'student_service_url_text', true );
		$metadata_fields['stusvc_location']        = get_post_meta( $stusvc->ID, 'student_service_location', true );
		$metadata_fields['stusvc_hours_monday_open']    = get_post_meta( $stusvc->ID, 'student_service_hours_monday_open', true );
		$metadata_fields['stusvc_hours_monday_close']    = get_post_meta( $stusvc->ID, 'student_service_hours_monday_close', true );
		$metadata_fields['stusvc_hours_tuesday_open']   = get_post_meta( $stusvc->ID, 'student_service_hours_tuesday_open', true );
		$metadata_fields['stusvc_hours_tuesday_close']   = get_post_meta( $stusvc->ID, 'student_service_hours_tuesday_close', true );
		$metadata_fields['stusvc_hours_wednesday_open'] = get_post_meta( $stusvc->ID, 'student_service_hours_wednesday_open', true );
		$metadata_fields['stusvc_hours_wednesday_close'] = get_post_meta( $stusvc->ID, 'student_service_hours_wednesday_close', true );
		$metadata_fields['stusvc_hours_thursday_open']  = get_post_meta( $stusvc->ID, 'student_service_hours_thursday_open', true );
		$metadata_fields['stusvc_hours_thursday_close']  = get_post_meta( $stusvc->ID, 'student_service_hours_thursday_close', true );
		$metadata_fields['stusvc_hours_friday_open']    = get_post_meta( $stusvc->ID, 'student_service_hours_friday_open', true );
		$metadata_fields['stusvc_hours_friday_close']    = get_post_meta( $stusvc->ID, 'student_service_hours_friday_close', true );
		$metadata_fields['stusvc_hours_saturday_open']  = get_post_meta( $stusvc->ID, 'student_service_hours_saturday_open', true );
		$metadata_fields['stusvc_hours_saturday_close']  = get_post_meta( $stusvc->ID, 'student_service_hours_saturday_close', true );
		$metadata_fields['stusvc_hours_sunday_open']    = get_post_meta( $stusvc->ID, 'student_service_hours_sunday_open', true );
		$metadata_fields['stusvc_hours_sunday_close']    = get_post_meta( $stusvc->ID, 'student_service_hours_sunday_close', true );
		$metadata_fields['stusvc_social_facebook'] = get_post_meta( $stusvc->ID, 'student_service_social_facebook', true );
		$metadata_fields['stusvc_social_twitter']  = get_post_meta( $stusvc->ID, 'student_service_social_twitter', true );
		$metadata_fields['stusvc_social_youtube']  = get_post_meta( $stusvc->ID, 'student_service_social_youtube', true );
		$metadata_fields['stusvc_social_googleplus'] = get_post_meta( $stusvc->ID, 'student_service_social_googleplus', true );
		$metadata_fields['stusvc_social_linkedin']  = get_post_meta( $stusvc->ID, 'student_service_social_linkedin', true );
		$metadata_fields['stusvc_social_instagram']  = get_post_meta( $stusvc->ID, 'student_service_social_instagram', true );
		$metadata_fields['stusvc_social_pinterest'] = get_post_meta( $stusvc->ID, 'student_service_social_pinterest', true );
		$metadata_fields['stusvc_social_tumblr']  = get_post_meta( $stusvc->ID, 'student_service_social_tumblr', true );
		$metadata_fields['stusvc_social_flickr']  = get_post_meta( $stusvc->ID, 'student_service_social_flickr', true );
		$metadata_fields['stusvc_events_cal_feed']   = get_post_meta( $stusvc->ID, 'student_service_events_cal_feed', true );
		$metadata_fields['stusvc_map_id']           = get_post_meta( $stusvc->ID, 'student_service_map_id', true );
		return $metadata_fields;
	}


	/**
	 *
	 */
	public static function get_summary_context( $stusvc, $metadata_fields ) {
		$category = get_category( $metadata_fields['stusvc_main_category_id'] );
		$category_name =
			( null !== $category && property_exists( $category, 'name' ) ) 
			? $category->name 
			: null;
		$permalink = get_permalink( $stusvc );
		$permalink_encoded = urlencode( $permalink );
		$title_encoded = urlencode( $stusvc->post_title );
		return array(
			'permalink' => $permalink,
			'title' => $stusvc->post_title,
			'main_category_name' => $category_name,
			'main_category_link' => get_category_link( $category ),
			'short_descr' => $metadata_fields['stusvc_short_descr'],
			'image' => $metadata_fields['stusvc_image'],
			'image_alt' => $metadata_fields['stusvc_image_alt'],
			'image_thumbnail_src' => $metadata_fields['stusvc_image_thumbnail_src'],
						'share_facebook' => "https://www.facebook.com/sharer.php?u={$permalink_encoded}",
			'share_twitter' => "https://twitter.com/intent/tweet?text={$title_encoded}&url={$permalink_encoded}&via=" . ($metadata_fields['stusvc_social_twitter'] ?: 'UCF'),
		);
	}

	// TODO: cast output to `(object) array()` to save on typing and code noise. i.e, $context->title instead of $context['title'].
	// TODO: group hours into a single container, e.g., $context->hours->monday->open.
	// TODO: create a get_render_context_summary for a ~/wp-json/rest/v1/services/summary route returning: image_thumbnail_src, image_alt, share_facebook, share_twitter, permalink, title, main_category_link, main_category_name, short_descr
	/**
	 * Generate a render context for a student_service, given its WP_Post object and an array of its metadata fields.
	 * Expected fields:
	 * $stusvc - post_content, post_title
	 * $metadata_fields - stusvc_short_descr
	 * @param WP_Post $stusvc The post object to be displayed.
	 * @param Array   $metadata_fields The metadata fields associated with this stusvc.
	 */
	public static function get_render_context( $stusvc, $metadata_fields ) {
		$category = get_category( $metadata_fields['stusvc_main_category_id'] );
		$category_name =
			( null !== $category && property_exists( $category, 'name' ) ) 
			? $category->name 
			: null;
		$taxonomies = wp_get_object_terms( $stusvc->ID,
				array( 'curation_groups', 'service_cost', 'service_type', ),
				array( 'orderby' => 'name', )
			);
		$permalink = get_permalink( $stusvc );
		$permalink_encoded = urlencode( $permalink );
		$title_encoded = urlencode( $stusvc->post_title );
		$primary_action_url = SDES_Static::href_prepend_protocols_filter( $metadata_fields['stusvc_primary_action_url'] );
		$hours_closed =
			static::HoursAreClosed( $metadata_fields['stusvc_hours_monday_open'], $metadata_fields['stusvc_hours_monday_close'] )
			&& static::HoursAreClosed( $metadata_fields['stusvc_hours_tuesday_open'], $metadata_fields['stusvc_hours_tuesday_close'] )
			&& static::HoursAreClosed( $metadata_fields['stusvc_hours_wednesday_open'], $metadata_fields['stusvc_hours_wednesday_close'] )
			&& static::HoursAreClosed( $metadata_fields['stusvc_hours_thursday_open'], $metadata_fields['stusvc_hours_thursday_close'] )
			&& static::HoursAreClosed( $metadata_fields['stusvc_hours_friday_open'], $metadata_fields['stusvc_hours_friday_close'] )
			&& static::HoursAreClosed( $metadata_fields['stusvc_hours_saturday_open'], $metadata_fields['stusvc_hours_saturday_close'] )
			&& static::HoursAreClosed( $metadata_fields['stusvc_hours_sunday_open'], $metadata_fields['stusvc_hours_sunday_close'] );
		return array(
			'permalink' => $permalink,
			'heading' => $metadata_fields['stusvc_heading_text'],
			'title' => $stusvc->post_title,
			'main_category' => $category,
			'main_category_name' => $category_name,
			'main_category_link' => get_category_link( $category ),
			'short_descr' => $metadata_fields['stusvc_short_descr'],
			'long_descr' => wpautop( apply_filters( 'the_content', $stusvc->post_content ) ),
			'gallery' => $metadata_fields['stusvc_gallery'],
			'additional' => $metadata_fields['stusvc_additional'],
			'image' => $metadata_fields['stusvc_image'],
			'image_alt' => $metadata_fields['stusvc_image_alt'],
			'image_thumbnail_src' => $metadata_fields['stusvc_image_thumbnail_src'],
			'primary_action' => $metadata_fields['stusvc_primary_action'],
			'primary_action_url' => $primary_action_url,
			'phone' => $metadata_fields['stusvc_phone'],
			'email' => $metadata_fields['stusvc_email'],
			'url' => $metadata_fields['stusvc_url'],
			'url_text' => $metadata_fields['stusvc_url_text'],
			'location' => $metadata_fields['stusvc_location'],
			'hours_closed' => $hours_closed,
			'hours_monday_open' => $metadata_fields['stusvc_hours_monday_open'],
			'hours_monday_close' => $metadata_fields['stusvc_hours_monday_close'],
			'hours_tuesday_open' => $metadata_fields['stusvc_hours_tuesday_open'],
			'hours_tuesday_close' => $metadata_fields['stusvc_hours_tuesday_close'],
			'hours_wednesday_open' => $metadata_fields['stusvc_hours_wednesday_open'],
			'hours_wednesday_close' => $metadata_fields['stusvc_hours_wednesday_close'],
			'hours_thursday_open' => $metadata_fields['stusvc_hours_thursday_open'],
			'hours_thursday_close' => $metadata_fields['stusvc_hours_thursday_close'],
			'hours_friday_open' => $metadata_fields['stusvc_hours_friday_open'],
			'hours_friday_close' => $metadata_fields['stusvc_hours_friday_close'],
			'hours_saturday_open' => $metadata_fields['stusvc_hours_saturday_open'],
			'hours_saturday_close' => $metadata_fields['stusvc_hours_saturday_close'],
			'hours_sunday_open' => $metadata_fields['stusvc_hours_sunday_open'],
			'hours_sunday_close' => $metadata_fields['stusvc_hours_sunday_close'],
			'social_facebook' => $metadata_fields['stusvc_social_facebook'],
			'social_twitter' => $metadata_fields['stusvc_social_twitter'],
			'social_youtube' => $metadata_fields['stusvc_social_youtube'],
			'social_googleplus' => $metadata_fields['stusvc_social_googleplus'],
			'social_linkedin' => $metadata_fields['stusvc_social_linkedin'],
			'social_instagram' => $metadata_fields['stusvc_social_instagram'],
			'social_pinterest' => $metadata_fields['stusvc_social_pinterest'],
			'social_tumblr' => $metadata_fields['stusvc_social_tumblr'],
			'social_flickr' => $metadata_fields['stusvc_social_flickr'],
	 		'events_cal_feed' => $metadata_fields['stusvc_events_cal_feed'],
	 		'map_id' => $metadata_fields['stusvc_map_id'],
			'tag_cloud' => $taxonomies,
			'share_facebook' => "https://www.facebook.com/sharer.php?u={$permalink_encoded}",
			'share_twitter' => "https://twitter.com/intent/tweet?text={$title_encoded}&url={$permalink_encoded}&via=" . ($metadata_fields['stusvc_social_twitter'] ?: 'UCF'),
		);
	}

	/**
	 * Render HTML for a collection of objects.
	 * @param Array $context An array of sanitized variables to display with this view.
	 * @uses toHTML() toHTML()
	 * @usedby render_objects_to_html()
	 */
	protected static function render_objects_to_html( $context ) {
		ob_start();
		?>
			<span class="<?= $context['css_classes'] ?>">
			<?php foreach ( $context['objects'] as $o ) : ?>
				<?= static::toHTML( $o ) ?>
			<?php endforeach;?>
			</span>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function get_metadata_fields_from_post( $post_object ) {
		$post_object = get_post( $post_object );
		if ( SDES_Static::is_null_or_whitespace( $post_object ) 
			 || self::NAME !== $post_object->post_type ) {return sprintf("<!-- No %s provided. -->", self::NAME); }
		$metadata_fields = static::get_render_metadata( $post_object );
		return $metadata_fields;
	}

	public static function get_summary_context_from_post( $post_object ) {
		$metadata_fields = static::get_metadata_fields_from_post( $post_object );
		$stusvc_context = static::get_summary_context( $post_object, $metadata_fields );
		return $stusvc_context;
	}

	/**
	 * Return single student_service post object's context, for consumption by either internal templates or REST routes.
	 */
	public static function get_render_context_from_post( $post_object ) {
		$metadata_fields = static::get_metadata_fields_from_post( $post_object );
		$stusvc_context = static::get_render_context( $post_object, $metadata_fields );
		return $stusvc_context;
	}

	/**
	 * Return the HTML to show a single student_service post object in a list.
	 */
	public static function toHTML( $post_object ) {
		$stusvc_context = static::get_render_context_from_post( $post_object );
		return static::render_to_html( $stusvc_context );
	}

	/**
	 * Render the HTML template for listing a student_service.
	 */
	protected static function render_to_html( $context ) {
		ob_start();
		?>
		<div class="row service">
			<div class="col-sm-4">
				<img class="service-image" src="<?= $context['image_thumbnail_src'] ?>" alt="<?= $context['image_alt'] ?>">
			</div>
			<div class="col-sm-8">
				<?= self::render_like_tweet_share( $context ) ?>

				<div class="service-details">
					<div class="service-title">
						<a href="<?= $context['permalink'] ?>">
								<?= $context['title'] ?>
						</a>
					</div>
					<div class="service-category">
					  <?php if ( '' !== $context['main_category_link'] ) : ?>
						<?= $context['main_category_name'] ?>
					  <?php else: ?>
					  	<?= $context['main_category_name'] ?>
					  <?php endif; ?>
					</div>
					<p>
						<?= $context['short_descr'] ?>
					</p>
				</div>
			</div>
		</div> <!-- /.service -->
		<?php
		$html = ob_get_clean();
		return $html;
	}

	/**
	 * Return the HTML for the details page of a single student_service.
	 */
	public static function toPageHTML( $post_object ) {
		$stusvc_context = static::get_render_context_from_post( $post_object );
		return static::render_single_page( $stusvc_context );
	}

	/**
	 * Render the HTML template for a single-student_service (details) page.
	 */
	protected static function render_single_page( $context ) {
		ob_start();
		?>
			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-8 col-xs-12">
					<h1><?= $context['title'] ?></h1>
				</div>
				<div class="col-md-4 col-xs-12">
					<?= self::render_like_tweet_share( $context ) ?>
				</div>
			  </div>
			</div>
			<!-- / Title and Social -->

			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-4 col-md-push-8 side-bar">
					<div class="row">
						<div class="col-xs-12" style="margin-bottom: 30px;">
							<?= self::render_campaign( $context ) ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<?= self::render_contact_table( $context ) ?>
							<?= self::render_hours_table( $context ) ?>
							<?= self::render_social_buttons( $context ) ?>
							<?php
							if( $context['events_cal_feed'] ) {
								$max_events = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-events_max_items', 4 );
								$context['events']  = array_reverse( FeedManager::get_items( $context['events_cal_feed'] ) );
								$context['events']  = array_slice( $context['events'], 0, $max_events );
								$context['academic_cal'] = false;
								$context['more_events'] = UcfEventModel::more_link();
								$context['events_cal_title'] = 'Events Calendar';
								echo self::render_events_calendar( $context ); 
							} else { echo '<div class="calendar-events" style="display: none;"></div>'; }
							?>
							<?= '<!-- Map -->' //self::render_map( $context ); ?>
							<?= self::render_tag_cloud( $context ) ?>
						</div>
					</div>
				</div> <!-- /.side-bar -->
				<div class="col-sm-12 col-md-7 col-lg-7 col-md-pull-4">
					<p class="lead"><?= $context['short_descr'] ?></p>
					<?= $context['long_descr'] ?>

					<h2>Additional Services</h2>
					<?php foreach ( $context['additional'] as $idx => $link ) :
					if ( '' != $link['title'] ) :
					?>
						<div class="additional-<?= $idx ?>">
							<h3 class="external-link"><a href="<?= $link['url'] ?>">
								<?= $link['title'] ?>
							</a></h3>
							<p><?= $link['descr'] ?></p>
						</div>
					<?php endif;
					endforeach; ?>

					<div class="gallery"><?= $context['gallery']['flickr'] ?></div>
				</div>
			  </div> <!-- /.row -->
			</div> <!-- /.container-fluid -->
		<?php
		$html = ob_get_clean();
		return $html;
	}

	/**
	 * Renders social buttons to Like, Tweet, and Share a page.
	 * @see https://developers.facebook.com/docs/plugins/faqs#faq_805887612880073 Facebook Sharer
	 * @see https://dev.twitter.com/web/tweet-button/web-intent Twitter Web Intent URLs
	 */
	public static function render_like_tweet_share( $context ){
		ob_start();
		?>
			<div class="service-social pull-md-right">
				<a target="_blank" href="<?= $context['share_facebook'] ?>"><span class="fa fa-thumbs-o-up"></span></a>
				<a target="_blank" href="<?= $context['share_twitter'] ?>"><span class="fa fa-twitter"></span></a>
			</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function render_campaign( $context ){
		$btn_text = $context['primary_action'];
		$btn_icon = '';
		$primaryActionIsMailTo = preg_match( '/^mailto:/', $context['primary_action_url'] );
		$primaryActionIsTel = preg_match( '/^tel:/', $context['primary_action_url'] );
		if ( $primaryActionIsMailTo ) { $btn_icon = 'fa-envelope-o'; }
		if ( $primaryActionIsTel ) 	  { $btn_icon = 'fa-phone'; }
		$btn_text = 
			( $primaryActionIsMailTo || $primaryActionIsTel )
				? "<span class='fa {$btn_icon}'></span> " . $btn_text
				: $btn_text;

		$service_campaign_context = (object) array(
			'url' => $context['primary_action_url'],
			'image_url' => $context['image_thumbnail_src'],
			'image_alt' => $context['image_alt'],
			'title' => '',
			'title_color' => '',
			'btn_text' => $btn_text,
			'btn_styles' => '',
		);
		ob_start();
		?>
			<?= Campaign::render_to_html( $service_campaign_context ); ?>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function render_contact_table( $context, $MAP_URL = "http://map.ucf.edu/?show=" ){
		ob_start();
		?>
			<div class="table-responsive contact">
				<table class="table table-bordered">
					<tbody>
					  <?php if ( ! SDES_Static::is_null_or_whitespace( $context['email'] ) ) : ?>
						<tr>
							<td><span class="fa fa-envelope-o"></span></td>
							<td><a class="email" title="Email" href="mailto:<?= $context['email'] ?>">
									<?= $context['email'] ?></a></td>
						</tr>
					  <?php endif;
					    if ( ! SDES_Static::is_null_or_whitespace( $context['phone'] ) ) : ?>
						<tr>
							<td><span class="fa fa-phone"></span></td>
							<td><a class="phone" title="Phone" href="tel:<?= $context['phone'] ?>">
									<?= $context['phone'] ?></a></td>
						</tr>
					  <?php endif;
					    if ( ! SDES_Static::is_null_or_whitespace( $context['url'] ) ) : ?>
						<tr>
							<td><span class="fa fa-chain"></span></td>
							<td><a class="url" title="URL" href="<?= SDES_Static::url_ensure_prefix( $context['url'] ) ?>">
									<?= $context['url_text'] ?: $context['url'] ?></a></td>
						</tr>
					  <?php endif;
					    if ( ! SDES_Static::is_null_or_whitespace( $context['location'] ) ) : ?>
						<tr>
							<td><span class="fa fa-map-marker"></span></td>
							<td><span class="location">
							  <?php if ( $context['map_id'] ) : ?>
								<a href="<?= $MAP_URL . $context['map_id'] ?>">
									<?= $context['location'] ?>
								</a>
							  <?php else: ?>
								<?= $context['location'] ?>
							  <?php endif; ?>
							</span></td>
						</tr>
					  <?php endif; ?>
					</tbody>
				</table>
			</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function HoursAreClosed( $open, $close ) {
		return SDES_Static::is_null_or_whitespace( $open ) || SDES_Static::is_null_or_whitespace( $close );
	}

	public static function render_hours_cell( $open, $close ) {
		if ( static::HoursAreClosed( $open, $close ) ) {
			return "CLOSED";
		}
		ob_start();
		?>
			<time class="open" datetime="<?= $open ?>"><?= date( 'h:i A', strtotime( $open ) ) ?></time> -
			<time class="closing" datetime="<?= $close ?>"><?= date( 'h:i A', strtotime( $close ) ) ?></time>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function render_hours_table( $context ){
		if( $context['hours_closed'] ) { return '<div class="table-responsive hours"><!-- Closed --></div>'; }
		ob_start();
		?>
			<div class="table-responsive hours">
				<table class="table table-bordered">
					<thead>
						<tr><th colspan="2"><span class="fa fa-clock-o"></span> TYPICAL HOURS</th></tr>
					</thead>
					<tbody>
						<tr>
							<td><div class="day">M</div></td>
							<td>
								<?= static::render_hours_cell( $context['hours_monday_open'], $context['hours_monday_close'] ); ?>
							</td>
						</tr>
						<tr>
							<td><div class="day">T</div></td>
							<td>
								<?= static::render_hours_cell( $context['hours_tuesday_open'], $context['hours_tuesday_close'] ); ?>
							</td>
						</tr>
						<tr>
							<td><div class="day">W</div></td>
							<td>
								<?= static::render_hours_cell( $context['hours_wednesday_open'], $context['hours_wednesday_close'] ); ?>
							</td>
						</tr>
						<tr>
							<td><div class="day">TH</div></td>
							<td>
								<?= static::render_hours_cell( $context['hours_thursday_open'], $context['hours_thursday_close'] ); ?>
							</td>
						</tr>
						<tr>
							<td><div class="day">F</div></td>
							<td>
								<?= static::render_hours_cell( $context['hours_friday_open'], $context['hours_friday_close'] ); ?>
							</td>
						</tr>
						<tr>
							<td><div class="day">SA</div></td>
							<td>
								<?= static::render_hours_cell( $context['hours_saturday_open'], $context['hours_saturday_close'] ); ?>
							</td>
						</tr>
						<tr>
							<td><div class="day">SU</div></td>
							<td>
								<?= static::render_hours_cell( $context['hours_sunday_open'], $context['hours_sunday_close'] ); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js" integrity="sha256-De/cgZoAkgvqoxL9yJpJzPHyozUETFnSv7EQGfQWQ4o=" crossorigin="anonymous"></script>
			<script>
				(function () {
					var CLOSING_SOON_MINUTES = <?= SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-closing_soon_minutes', 60 ); ?>;
					var NOW = new Date();
					var dayOfWeek = NOW.getDay();
					dayOfWeek = ( 0 === dayOfWeek ) ? 6 : dayOfWeek - 1; // Shift so week starts with Monday as 0.
					var $today_tds = jQuery('.table-responsive.hours tbody tr').eq(dayOfWeek).children('td');
					var $closing_time = $today_tds.find('time.closing');
					try {
						var closing_moment  = moment( $closing_time[0].getAttribute('datetime'), 'HH:mm' );
						var to_closing_ms   = moment( NOW ).diff( closing_moment );
						var to_closing_mins = moment.duration( to_closing_ms ).asMinutes();
						var isClosed       = to_closing_ms > 0;
						var isClosingSoon  = !isClosed && ( to_closing_mins > ( -1*CLOSING_SOON_MINUTES ) );
						$today_tds.addClass('active');
						if( isClosed )      { $today_tds.addClass('closed'); }
						if( isClosingSoon ) { $today_tds.addClass('closing-soon'); }
					} catch(e) {
						// If no TIME element, mark as closed.
						if ( 0 === $closing_time.length ) { $today_tds.addClass('closed'); }
						// If moment.js did not load, ensure no misleading styling.
						if ( 'undefined' === typeof( moment ) ) { $today_tds.removeClass('active'); }
					}
				}());
			</script>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function render_social_buttons( $context ){
		$network_map = array(
			'facebook' => 'facebook-square',
			'twitter' => 'twitter-square',
			'youtube' => 'youtube-square',
			'googleplus' => 'google-plus-square',
			'linkedin' => 'linkedin-square',
			'instagram' => 'instagram',
			'pinterest' => 'pinterest-square',
			'tumblr' => 'tumblr-square ',
			'flickr' => 'flickr' );
		$networks = array();
		foreach ( $network_map as $name => $fa_icon ) {
			array_push( $networks,
				(object) array( 'name' => $name, 'url' => $context[ "social_{$name}" ], 'faicon' => "fa-{$fa_icon}" )
			);
		}
		ob_start();
		?>
			<div class="social">
				<h2>Get social with <?= $context['title'] ?></h2>
			  <?php foreach ( $networks as $network ) :
			  if ( ! SDES_Static::is_null_or_whitespace( $network ) ) : ?>
				<a href="<?= $network->url ?>" title="<?= ucfirst($network->name) ?>">
					<span class="fa <?= $network->faicon ?> social-icon"></span>
				</a>
			  <?php endif;
			  endforeach; ?>
			</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function render_events_calendar( $context ){
		ob_start();
		?>
			<div class="calendar-events collapsed" type="button"
				 data-toggle="collapse" data-target="#calendar-expand"
				 aria-expanded="true" aria-controls="collapseExample">
				<span class="calendar-events-title">
					<span class="fa fa-calendar-o calendar-icon"></span>
					<?= $context['events_cal_title']  ?>
					<span class="fa fa-chevron-down calendar-chevron"></span>
				</span>
				<div class="collapse" id="calendar-expand">
				  <?php 
				  if ( 0 === sizeof( $context['events'] ) ) { echo 'No events found.'; }
				  foreach ( $context['events'] as $event ) : 
				  	$event = ( $context['academic_cal'] ) ? new UcfAcademicCalendarModel( $event ) : new UcfEventModel( $event ); ?>
					<div class="event">
						<div class="title"><a href="<?= $event->link() ?>"><?= $event->title() ?></a></div>
						<div class="date"><?= $event->month_day() ?></div>
					</div>
				  <?php endforeach; ?>
					<div>
						<a class="all-link external" href="<?= $context['more_events'] ?>">More Events ›</a>
					</div>
				</div>
			</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function render_map( $context ){
		ob_start();
		?>
				<div class="map_id"><?= $context['map_id'] ?></div>
				<hr>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	public static function render_tag_cloud( $context ){
		ob_start();
		?>
				<div class="tag-cloud">
				  <?php if( null != $context['tag_cloud']) :
				  foreach( $context['tag_cloud'] as $tag ) : ?>
					<a href="<?= get_site_url() . '/?q=' . $tag->name ?>">
						<span class="label label-default"><?= $tag->name ?></span>
					</a>
				  <?php endforeach;
				  else: ?>
				  	<span class="no-tags"><!-- No tags for this service. --></span>
				  <?php endif; ?>
				</div>
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
		__NAMESPACE__.'\Campaign',
		__NAMESPACE__.'\IconLink',
	));
}
add_action( 'init', __NAMESPACE__.'\register_custom_posttypes' );
