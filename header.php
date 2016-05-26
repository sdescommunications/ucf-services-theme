<?php
/**
 * Header area for the theme, as called by get_header().
 */

use SDES\SDES_Static as SDES_Static;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= wp_title( '&raquo;', true, 'right' ); bloginfo( 'name' ); ?> &raquo; UCF</title>

	<link rel="shortcut icon" href="<?= get_stylesheet_directory_uri(); ?>/images/favicon_black.png" >
	<link rel="apple-touch-icon" href="<?= get_stylesheet_directory_uri(); ?>/images/apple-touch-icon.png" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/nivoslider/3.2/nivo-slider.css" integrity="sha256-ozCgGW2jByABzzSU1X46571+0m23IUok6fdIjS5+nVQ=" crossorigin="anonymous" >
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/nivoslider/3.2/themes/default/default.css" integrity="sha256-O1/X/SEJPvJ8T2QC3NQvoARgaeAk1iGHstf0wUjuNkA=" crossorigin="anonymous" >
	<link rel="stylesheet" href="<?= get_stylesheet_uri(); ?>" >

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" integrity="sha384-Pn+PczAsODRZ2PiGg0IheRROpP7lXO1NTIjiPo6cca8TliBvaeil42fobhzvZd74" crossorigin="anonymous"></script>
	<script type="text/javascript" id="ucfhb-script" src="//universityheader.ucf.edu/bar/js/university-header.js?use-1200-breakpoint=1"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A=="crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/nivoslider/3.2/jquery.nivo.slider.pack.js" integrity="sha256-4WhPxM5Oma2+XZ8KTrGc4sVBFtqLD5IkzclNM5iKo4c=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js" integrity="sha256-8PU3OtIDEB6pG/gmxafvj3zXSIfwa60suSd6UEUDueI=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.13.1/additional-methods.min.js" integrity="sha256-TZwF+mdLcrSLlptjyffYpBb8iUAuLtidBmNiMj7ll1k=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		(function javascript_fallbacks() {
			// See: http://stackoverflow.com/a/5531821
			function document_write_script( src ) {
				document.write( '<script src="' + src + '">\x3C/script>' );
			}
			if ( ! window.jQuery ) { document_write_script( '/js/jquery.min.js' ); }
			var bootstrap_enabled = ( 'function' === typeof $().modal ); // Will be true if bootstrap is loaded, false otherwise
			if ( ! bootstrap_enabled ) { document_write_script( '/js/bootstrap.min.js' ); }
			if ( 'undefined' === typeof $().nivoSlider ) { document_write_script( '/js/jquery.nivo.slider.pack.min.js' ); }
			if ( 'undefined' === typeof $().validate ) { 
				document_write_script( '/js/jquery.validate.min.js' );
				document_write_script( '/js/additional-methods.min.js' );
			}
		})();
		(function css_fallbacks() {
			// TODO: handle font fallbacks with font-family?
		})();
	</script>
	<script type="text/javascript" src="<?= get_stylesheet_directory_uri(); ?>/js/sdes_main_ucf.js"></script>

<?php wp_head(); ?>
</head>
<body class="nojs">
	<script>
		var bodyEl = document.getElementsByTagName('body');
		bodyEl[0].className = bodyEl[0].className.split('nojs').join(' jsEnabled ');
	</script>
