<?php
/**
 *
 * graphviz.gv: "custom-metafields.php" -> { "classes-metabox-metafields.php"; "class-sdes-metaboxes.php"; };
 */

namespace SDES\ServicesTheme\Metafields;
require_once( get_stylesheet_directory() . '/functions/classes-metabox-metafields.php' );
	use SDES\Metafields\MetaField as Metafield;

class SpotlightMetaField extends MetaField {

	function __construct( $attr ) {
		parent::__construct( $attr );
		$this->args = isset( $attr['args'] )
			 ? $attr['args']
			 : array();
	}

	/**
	 * @see https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/functions/custom-fields.php#L122-L154
	 */
	public function input_html() {
		$field = $this;
		?>
		<div class="meta-spotlight-wrapper">
			<select class="meta-spotlight-field" id="<?php echo htmlentities( $field->id ); ?>" name="<?php echo htmlentities( $field->name ); ?>" value="<?php echo $field->value; ?>">
				<option value="">-- Select Spotlight --</option>
				<?php foreach( $this->get_spotlights() as $key=>$spotlight ) : ?>
				<?php $selected = $field->value == $key ? 'selected' : ''; ?>
				<option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $spotlight; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if ( $field->value ) : ?>
				<p></p>
				<a class="button edit-spotlight" href="<?php echo get_admin_url() . '/post.php?action=edit&post=' . $field->value; ?>" target="_blank"><span class="fa fa-pencil"></span> Edit Spotlight Items</a>
				<p>or</p>
				<a class="button" href="<?php echo get_admin_url() . '/post-new.php?post_type=spotlight'; ?>" target="_blank"><span class="fa fa-bars"></span> Create New Spotlight</a>
			<?php else : ?>
				<p>or</p>
				<a class="button" href="<?php echo get_admin_url() . '/post-new.php?post_type=spotlight'; ?>" target="_blank"><span class="fa fa-bars"></span> Create New Spotlight</a>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * @see https://developer.wordpress.org/reference/functions/get_posts/ WP-Ref: get_posts()
	 * @see https://developer.wordpress.org/reference/classes/wp_query/parse_query/ WP-Ref: parse_query()
	 */
	function get_spotlights() {
		$query_args = array (
				'post_type' => 'spotlight',
			);
		$spotlights = get_posts( $query_args );
		$retval = array();
		foreach( $spotlights as $spotlight ) {
			$retval[$spotlight->id] = $spotlight->post_title;
		}
		return $retval;
	}
}


namespace SDES\ServicesTheme;

require_once( get_stylesheet_directory() . '/functions/class-sdes-metaboxes.php' );
	use SDES\SDES_Metaboxes;

require_once( get_stylesheet_directory() . '/functions/classes-metabox-metafields.php' );
	use SDES\Metafields\IMetaField as IMetafield;

use SDES\ServicesTheme\Metafields\SpotlightMetaField;

class ServicesMetaboxes extends SDES_Metaboxes {
	/**
	 * Displays metafields with current or default values.
	 * */
	public static function display_metafield( $post_id, $field ) {
		$field_obj = null;
		$field['value'] = get_post_meta( $post_id, $field['id'], true );
		switch ( $field['type'] ) {
			case 'spotlight':
				$field_obj = new SpotlightMetaField( $field );
				break;
			default:
				parent::display_metafield( $post_id, $field );
				return;
		}
		$markup = '';
		if ( null !== $field_obj && $field_obj instanceof IMetafield ) {
			ob_start();
		?>
			<tr>
				<th><?php echo $field_obj->label_html(); ?></th>
				<td>
					<?php echo $field_obj->description_html(); ?>
					<?php echo $field_obj->input_html(); ?>
				</td>
			</tr>
		<?php
			$markup = ob_get_clean();
		} else {
			$markup = '<tr><th></th><td>Don\'t know how to handle field of type '. $field['type'] .'</td></tr>';
		}
		echo $markup;
	}
}