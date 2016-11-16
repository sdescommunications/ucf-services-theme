<?php
/**
 * Header area for the theme, as called by get_header().
 *
 * @package SDES\ServicesTheme
 */

require_once( get_stylesheet_directory() . '/header-settings.php' );
	use SDES\ServicesTheme\ThemeCustomizer\Header as Header;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
	use SDES\SDES_Static as SDES_Static;

// TODO: add scripts, styles via Wordpress enqueueing.
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
	// Instead of adding scripts or styles here, call: `add_action('wp_head', 'YOUR_FUNCTION');`
	// See: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_head#Examples .
	do_action( 'wp_head' );

	// Load webfonts if enabled by page.
	// See: https://github.com/UCF/Main-Site-Theme/blob/63d8423fcd53b2051343c582932c1d6ea3a61e98/header.php#L28-L31 .
	// @codingStandardsIgnoreStart Generic.WhiteSpace.ScopeIndent.IncorrectExact
	if ( \is_page() ) {
		Header::page_specific_webfonts( $post->ID );
	}
	// @codingStandardsIgnoreEnd Generic.WhiteSpace.ScopeIndent.IncorrectExact
?>
</head>
<body class="nojs">
	<?php echo SDES_Static::google_tag_manager(); ?>
	<script>
		var bodyEl = document.getElementsByTagName('body');
		bodyEl[0].className = bodyEl[0].className.split('nojs').join(' jsEnabled ');
	</script>
