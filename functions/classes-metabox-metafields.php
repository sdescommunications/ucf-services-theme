<?php
/**
 * Add display metafields within a metabox of a custom posttype.
 */

namespace SDES\Metafields;

/**
 * Methods used by SDES_Metaboxes to display a metafield.
 */
interface IMetafield {
	function label_html();
	function input_html();
	function description_html();
	function html();
}

/**
 * Abstracted Metafield class, all form Metafields should inherit from this.
 *
 * @see https://github.com/UCF/Students-Theme/blob/6ca1d02b062b2ee8df62c0602adb60c2c5036867/functions/base.php#L124-L390
 * @package default
 * @author Jared Lang
 * */
abstract class MetaField implements IMetafield {
	protected function check_for_default() {
		if ( ( $this->value === null || $this->value === '' ) && isset( $this->default ) ) {
			$this->value = $this->default;
		}
	}

	function __construct( $attr ) {
		$this->name        = @$attr['name'];
		$this->id          = @$attr['id'];
		$this->value       = @$attr['value'];
		$this->description = ( @$attr['descr'] ) ? @$attr['descr'] : @$attr['description'];
		$this->default     = @$attr['default'];
		$this->check_for_default();
	}

	function label_html() {
		ob_start();
		?>
		<label class="block" for="<?php echo htmlentities( $this->id )?>"><?php echo __( $this->name )?></label>
		<?php
		return ob_get_clean();
	}

	function input_html() {
		return 'Abstract Input MetaField, Override in Descendants';
	}

	function description_html() {
		ob_start();
		?>
		<?php if ( $this->description ) : ?>
		<p class="description"><?php echo __( $this->description ) ?></p>
		<?php endif;
		return ob_get_clean();
	}

	function html() {
		$label       = $this->label_html();
		$input       = $this->input_html();
		$description = $this->description_html();
		return $label.$input.$description;
	}
}

/**
 * Abstracted choices Metafield.  Choices Metafields have an additional attribute named
 * choices which allow a selection of values to be chosen from.
 *
 * @package default
 * @author Jared Lang
 * */
abstract class ChoicesMetaField extends MetaField{
	/**
	 * Ensure 'default' value is added to choices if it isn't already.
	 */
	protected function add_default_to_choices() {
		if ( isset( $this->default ) ) {
			if ( ! is_array( $this->default ) && ! array_key_exists( $this->default, $this->choices ) ) {
				// Exclude arrays of defaults used by CheckboxListMetaField.
				$this->choices = array( $this->default => '' ) + $this->choices;
			} else {
				// Add an array of defaults if they aren't present.
				foreach ( $this->default as $key => $value ) {
					if ( ! array_key_exists( $key, $this->choices ) ) {
						$this->choices = array( $key => $value ) + $this->choices;
					}
				}
			}
		}
	}

	function __construct( $attr ) {
		$this->choices = @$attr['choices'] ?: array();  // Shorthand ternary operator requires PHP 5.3+.
		parent::__construct( $attr );
		$this->add_default_to_choices();
	}
}

/**
 * TextMetaField class represents a simple text input
 *
 * @package default
 * @author Jared Lang
 * */
class TextMetaField extends MetaField{
	protected $type_attr = 'text';
	function input_html() {
		ob_start();
		?>
		<input type="<?php echo $this->type_attr?>" id="<?php echo htmlentities( $this->id )?>" name="<?php echo htmlentities( $this->id )?>" value="<?php echo htmlentities( $this->value )?>">
		<?php
		return ob_get_clean();
	}
}

/** A time selector, as defined by HTML5. */
class TimeMetaField extends TextMetaField{
	protected $type_attr = 'time';
}

/**
 * A color picker (or color-well) control, as defined by HTML5.
 *
 */
class ColorMetaField extends TextMetaField{
	protected $type_attr = 'color';
}

/**
 * DatePickerMetaField class represents a text input for a date value.
 * @todo Extract jQueryUI datepicker dependency or test that it is available and only called once per page.
 * */
class DatePickerMetaField extends MetaField {
	protected $class_attr = 'date';
	function input_html() {
		ob_start();
		?>
		<input type="text" class="<?php echo $this->class_attr?>" id="<?php echo htmlentities( $this->id )?>" name="<?php echo htmlentities( $this->id )?>" value="<?php echo htmlentities( $this->value )?>">
		<?php
		return ob_get_clean();
	}
}

/**
 * PasswordMetaField can be used to accept sensitive information, not encrypted on
 * wordpress' end however.
 *
 * @package default
 * @author Jared Lang
 * */
class PasswordMetaField extends TextMetaField{
	protected $type_attr = 'password';
}

/**
 * TextareaMetaField represents a textarea form element
 *
 * @package default
 * @author Jared Lang
 * */
class TextareaMetaField extends MetaField{
	function input_html() {
		ob_start();
		?>
		<textarea cols="60" rows="4" id="<?php echo htmlentities( $this->id ); ?>" name="<?php echo htmlentities( $this->id ); ?>"><?php echo $this->value; ?></textarea>
		<?php
		return ob_get_clean();
	}
}

/**
 * Select form element
 *
 * @package default
 * @author Jared Lang
 * */
class SelectMetaField extends ChoicesMetaField{
	function input_html() {
		ob_start();
		?>
		<select name="<?php echo htmlentities( $this->id )?>" id="<?php echo htmlentities( $this->id )?>">
			<?php foreach ( $this->choices as $key => $value ) : ?>
			<option<?php if ( $this->value === $value ) : ?> selected="selected"<?php endif;?> value="<?php echo htmlentities( $value )?>"><?php echo htmlentities( $key )?></option>
			<?php endforeach;?>
		</select>
		<?php
		return ob_get_clean();
	}
}

/**
 * Dropdown to select a main category for a post.
 */
class TaxonomyMetaField extends SelectMetaField {
	function __construct( $post_id, $attr ) {
		parent::__construct( $attr );
		$this->post_id = $post_id;
		$this->taxonomy = isset( $attr['taxonomy'] )
			 ? $attr['taxonomy']
			 : 'category';
	 	$this->term_args =isset( $attr['term_args'] )
			 ? $attr['term_args']
			 : array( 'parent' => 0, );
	}

	function input_html() {
		$this->choices = self::get_terms_choices( $this->taxonomy, $this->term_args );
		return parent::input_html();
	}

	/**
	 * Return a choices array for consumption by SelectMetaField in the form:
	 * array( 'Option text' => option_value ).
	 */
	public static function get_terms_choices(
			$taxon = 'category',
			$term_args = array( 'parent' => 0, ),
			$default = '-- Select a category --' ){
		$terms = get_terms( $taxon, $term_args );
		$keys = array_map(
			function( $x ){
				return  $x->name;
			}, $terms );
		$values = array_map(
			function( $x ){
				return (string) $x->term_id;
			}, $terms );
		// Prepend ('-- Select a category --' => -1).
		array_unshift( $keys, $default );
		array_unshift( $values, '-1' );
		return array_combine( $keys, $values );
	}
}

/**
 * Multiselect form element
 *
 * @package default
 * @author Jo Dickson
 * */
class MultiselectMetaField extends ChoicesMetaField{
	function input_html() {
		ob_start();
		?>
		<select multiple name="<?php echo htmlentities( $this->id ); ?>[]" id="<?php echo htmlentities( $this->id ); ?>">
			<?php foreach ( $this->choices as $key => $value ) :  ?>
			<option<?php if ( is_array( $this->value ) && in_array( $value, $this->value ) || $value === $this->value ) : ?> selected="selected"<?php endif; ?> value="<?php echo htmlentities( $value ); ?>"><?php echo htmlentities( $key ); ?></option>
			<?php endforeach;?>
		</select>
		<?php
		return ob_get_clean();
	}
}

/**
 * Radio form element
 *
 * @package default
 * @author Jared Lang
 * */
class RadioMetaField extends ChoicesMetaField{
	function input_html() {
		ob_start();
		?>
		<ul class="radio-list">
			<?php $i = 0;
			foreach ( $this->choices as $key => $value ) :  $id = htmlentities( $this->id ).'_'.$i++;?>
						<li>
							<input<?php if ( $this->value === $value ) : ?> checked="checked"<?php endif;?> type="radio" name="<?php echo htmlentities( $this->id )?>" id="<?php echo $id?>" value="<?php echo htmlentities( $value )?>">
							<label for="<?php echo $id?>"><?php echo htmlentities( $key )?></label>
						</li>
						<?php endforeach;?>
		</ul>
		<?php
		return ob_get_clean();
	}
}

/**
 * Checkbox form element
 */
class CheckboxMetaField extends ChoicesMetaField {
	function input_html() {
		ob_start();
		?>
			<input<?php if ( $this->value ) : ?> checked="checked"<?php endif;?> type="checkbox" name="<?php echo htmlentities( $this->id )?>" id="<?php echo htmlentities( $this->id ) ?>">
			<label for="<?php echo $this->id?>"><?php echo htmlentities( $this->name )?></label>
		<?php
		return ob_get_clean();
	}
}

/**
 * List of checkbox form elements
 *
 * @package default
 * @author Jared Lang
 * */
class CheckboxListMetaField extends ChoicesMetaField {
	function input_html() {
		ob_start();
		?>
		<ul class="checkbox-list">
			<?php $i = 0;
			foreach ( $this->choices as $key => $value ) :  $id = htmlentities( $this->id ).'_'.$i++;?>
						<li>
							<input<?php if ( is_array( $this->value ) and in_array( $value, $this->value ) ) : ?> checked="checked"<?php endif;?> type="checkbox" name="<?php echo htmlentities( $this->id )?>[]" id="<?php echo $id?>" value="<?php echo htmlentities( $value )?>">
							<label for="<?php echo $id?>"><?php echo htmlentities( $key )?></label>
						</li>
						<?php endforeach;?>
		</ul>
		<?php
		return ob_get_clean();
	}
}

/**
 * @see http://themefoundation.com/wordpress-meta-boxes-guide/#xpath:/html/body/div[2]/div[2]/div/div/div/div[2]/h3[6] -- 9.2 Image uploader
 */
class ImageMetaField extends MetaField {

	function input_html() {
		$context = (object) array(
			'id' => htmlentities( $this->id ),
			'value' => htmlentities( $this->value ),
			'image_src' => wp_get_attachment_image_src( htmlentities( $this->value ), 'thumbnail', false )[0],
			'data_param' => '',
		);
		return static::render_html( $context );
	}

	public static function render_html( $context ) {
		ob_start();
		?>
			<a href="<?= $context->value ?>" target="_blank" class="meta-image-preview">
				<img class="meta-image-preview" style="max-width: 400px; max-height: 400px;" src="<?= $context->image_src ?>">
			</a>
			<br>
			<input type="text" class="meta-image-field hide-if-js" name="<?= $context->id ?>" id="<?= $context->id ?>" value="<?= $context->value ?>" style="width: 500px;" data-parameter="<?= $context->data_param ?>" />
			<input type="button" class="meta-image-button button hide-if-no-js" id="button-<?= $context->id ?>" value="<?php _e( 'Choose or Upload an Image', 'prfx-textdomain' )?>" />
		<?php
		return ob_get_clean();
	}

	/**
	 * Script to wire up the meta-image-button to a wp.media frame.
	 */
	public static function get_meta_image_button_script(){
		ob_start();
		?>
		<script>
		/*
		 * Attaches the image uploader to the input field.
		 */
		jQuery(document).ready(function($){
			// Instantiates the variable that holds the media library frame.
			var meta_image_frame;
			// Runs when the image button is clicked.
			$('.meta-image-button').click(function(e){
				// Prevents the default action from occuring.
				e.preventDefault();
				// Sets up the media library frame
				if ( ! meta_image_frame ) {
					meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
						title: 'Choose or Upload an Image',  // meta_image_frame.options.title
						button: { text:  'Use this image' }, // meta_image_frame.options.button.text
						library: { type: 'image' } // meta_image_frame.options.library.type
					});
				}
				// Runs when an image is selected.
				meta_image_frame.on('select', function(){
					// Grabs the attachment selection and creates a JSON representation of the model.
					var media_attachment = meta_image_frame.state().get('selection').first().toJSON(),
						$image_field = $( '#' + e.srcElement.id ).parent().children( '.meta-image-field' ),
						$image_preview = $( '#' + e.srcElement.id ).parent().find( '.meta-image-preview' );
					// Sends the attachment URL to our custom image input field and preview fields.
					$image_field.val( media_attachment.id );
					$image_preview.filter('img').attr( 'src', media_attachment.url );
					$image_preview.filter('a').attr( 'href', media_attachment.url );
				});
				// Opens the media library frame.
				meta_image_frame.open();
			});
		});
		</script>
		<?php
		return ob_get_clean();
	}
}

class FileMetaField extends MetaField {
	function __construct( $attr ) {
		parent::__construct( $attr );
		$this->post_id = isset( $attr['post_id'] ) ? $attr['post_id'] : 0;
		$this->thumbnail = $this->get_attachment_thumbnail_src();
	}

	function get_attachment_thumbnail_src() {
		if ( ! empty( $this->value ) ) {
			$attachment = get_post( $this->value );
			$use_thumb = wp_attachment_is_image( $this->value ) ? false : true;
			if ( $attachment ) {
				$src = wp_get_attachment_image_src( $this->value, 'thumbnail', $use_thumb );
				return $src[0];
			}
		} else {
			return false;
		}
	}

	function input_html() {
		$upload_link = esc_url( get_upload_iframe_src( null, $this->post_id ) );
		ob_start();
		?>
		<div class="meta-file-wrap">
			<div class="meta-file-preview">
				<?php if ( $this->thumbnail ) :  ?>
					<img src="<?php echo $this->thumbnail; ?>" alt="File thumbnail"><br>
					<?php echo basename( wp_get_attachment_url( $this->value ) ); ?>
				<?php else : ?>
					No file selected.
				<?php endif; ?>
			</div>

			<p class="hide-if-no-js">
				<a class="meta-file-upload thickbox <?php if ( ! empty( $this->value ) ) { echo 'hidden'; } ?>" href="<?php echo $upload_link; ?>">
					Add File
				</a>
				<a class="meta-file-delete <?php if ( empty( $this->value ) ) { echo 'hidden'; } ?>" href="#">
					Remove File
				</a>
			</p>

			<input class="meta-file-field" id="<?php echo htmlentities( $this->id ); ?>" name="<?php echo htmlentities( $this->id ); ?>" type="hidden" value="<?php echo htmlentities( $this->value ); ?>">
		</div>
		<?php
		return ob_get_clean();
	}
}

class EditorMetaField extends MetaField {
	function __construct( $attr ) {
		parent::__construct( $attr );
		$this->args = isset( $attr['args'] )
			 ? $attr['args']
			 : array();
	}

	function input_html() {
		wp_editor( $this->value, $this->id, $this->args );
	}
}

// @see: https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions/custom-fields.php#L6-L90
define( 'SDES\Metafields\ICON_JS_URI', get_template_directory_uri().'/js/iconmodal.js' );
define( 'SDES\Metafields\ICON_FA_JSON', get_bloginfo( 'stylesheet_directory' ) . '/static/data/fa-icons.json');
class IconFontAwesomeMetaField extends MetaField {
	private static $isLoaded = false;

	public static function Load() {
		if ( ! self::$isLoaded ) {
			add_action( 'admin_footer', __CLASS__.'::enqueue_iconmodal_script' );
			self::$isLoaded = true;
		}
	}

	public static function enqueue_iconmodal_script() {
		wp_enqueue_script( 'iconmodal-script', ICON_JS_URI );
	}

	function __construct( $attr ) {
		parent::__construct( $attr );
		$this->args = isset( $attr['args'] )
			 ? $attr['args']
			 : array();
		$this->Load();
	}

	/**
	 *
	 * @see https://github.com/UCF/Students-Theme/blob/2bf248dba761f0929823fd790120f74e92a52c2d/functions/custom-fields.php#L34-L53
	 */
	function input_html() {
		$this->Load();
		$field = $this;
		?>
		<?php echo $this->icon_field_modal_html(); ?>
		<div class="meta-icon-wrapper">
			<div class="meta-icon-preview">
				<?php if ( $field->value ) : ?>
					<i class="fa <?php echo $field->value; ?> fa-preview"></i>
				<?php endif; ?>
			</div>
			<p class="hide-if-no-js">
				<a class="meta-icon-toggle thickbox" href="#TB_inline?width=600&height=550&inlineId=meta-icon-modal">
					<?= ( $field->value ) ? "Update" : "Choose" ?> Icon
				</a>
			</p>
			<input class="meta-icon-field hide-if-js" id="<?php echo htmlentities( $field->id ); ?>" name="<?php echo htmlentities( $field->id ); ?>" type='text' value="<?php echo htmlentities( $field->value ); ?>">
		</div>
		<?php
	}

	function icon_field_modal_html( ) {
		ob_start();
		?>
		<div id="meta-icon-modal" style="display: none;">
			<input type="hidden" id="meta-icon-field-id" value>
			<h2>Choose Icon</h2>
			<p>
				<input type="text" placeholder="search" id="meta-icon-search">
			</p>
			<ul class="meta-fa-icons">
			<?php foreach( $this->get_fa_icons() as $icon ) : ?>
				<li class="meta-fa-icon"><i class="fa <?php echo $icon; ?>" data-icon-value="<?php echo $icon; ?>"></i></li> 
			<?php endforeach; ?>
			</ul>
			<div class="meta-icon-modal-footer">
				<button type="button" id="meta-icon-submit">Submit</button>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	/**
	 *
	 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/gulpfile.js#L134-L156
	 */
	function get_fa_icons() {
		$opts = array(
			'http' => array(
				'timeout' => 15
			)
		);
		
		$context = stream_context_create( $opts );
		$contents = file_get_contents( ICON_FA_JSON, false, $context );
		return json_decode( $contents );
	}
}
