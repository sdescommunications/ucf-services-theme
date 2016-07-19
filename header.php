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
	<link rel="stylesheet" href="<?= get_stylesheet_uri(); ?>" >

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" integrity="sha384-Pn+PczAsODRZ2PiGg0IheRROpP7lXO1NTIjiPo6cca8TliBvaeil42fobhzvZd74" crossorigin="anonymous"></script>
	<script type="text/javascript" id="ucfhb-script" src="//universityheader.ucf.edu/bar/js/university-header.js?use-1200-breakpoint=1"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js" integrity="sha256-8PU3OtIDEB6pG/gmxafvj3zXSIfwa60suSd6UEUDueI=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.13.1/additional-methods.min.js" integrity="sha256-TZwF+mdLcrSLlptjyffYpBb8iUAuLtidBmNiMj7ll1k=" crossorigin="anonymous"></script>

	<!-- Angular scripts -->
	 <!-- Polyfill(s) for older browsers -->
	<script src="https://cdn.jsdelivr.net/core-js/2.4.0/shim.min.js" integrity="sha256-iIdcT94SZY9oCsJj8VTkuvshEfKPXRXaA8nT8lCKG5U=" crossorigin="anonymous"></script>
	<!-- 
	<script src="https://cdn.jsdelivr.net/core-js/2.4.0/core.min.js" integrity="sha256-xTD6B7mfbQdGg9PKKvM3zuwnJ4RQzIYOg5KeFv6f/Ok=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/core-js/2.4.0/library.min.js" integrity="sha256-DrSdiua5FbuG2btQhZlfNnObsET0ZLwlMIn6nE+kVe0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.0/shim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/es5-shim/4.4.1/es5-shim.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.34.1/es6-shim.js"></script>
	<script src="<?= get_stylesheet_directory_uri(); ?>/node_modules/core-js/"></script>
	 -->

	<script src="https://npmcdn.com/zone.js@0.6.12/dist/zone.js"></script>
    <script src="https://npmcdn.com/reflect-metadata@0.1.3/Reflect.js"></script>
    <script src="https://npmcdn.com/systemjs@0.19.31/dist/system.js"></script>

	<!-- 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/zone.js/0.6.12/zone.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/reflect-metadata/0.1.3/Reflect.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/systemjs/0.19.31/system.src.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/2.0.0-beta.17/angular2-polyfills.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/2.0.0-beta.17/Rx.umd.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/2.0.0-beta.17/angular2-all.umd.min.js"></script>
	 -->
	<script>
		// SystemJS.config.js
		(function(global) {
			var ngVer = '@2.0.0-rc.4'; // lock in the angular package version; do not let it float to current!
			var routerVer = ''; // lock router version
			// map tells the System loader where to look for things
			var map = {
				'app':		'',
				// '@angular':	'<?= get_stylesheet_directory_uri() ?>/node_modules/@angular',
				// 'rxjs': 	'<?= get_stylesheet_directory_uri() ?>/node_modules/rxjs'
				'@angular':                   'https://npmcdn.com/@angular', // sufficient if we didn't pin the version
				'@angular/router':            'https://npmcdn.com/@angular/router' + routerVer,
				// 'angular2-in-memory-web-api': 'https://npmcdn.com/angular2-in-memory-web-api', // get latest
				'rxjs':                       'https://npmcdn.com/rxjs@5.0.0-beta.6',
				'ng2-bootstrap':              '<?= get_stylesheet_directory_uri() ?>/node_modules/ng2-bootstrap/',
				// 'moment':                     '<?= get_stylesheet_directory_uri() ?>/node_modules/moment/moment.js',
				// 'ng2-bootstrap':              'https://cdnjs.cloudflare.com/ajax/libs/ng2-bootstrap/1.0.24',
				// 'ng2-bootstrap':              'https://npmcdn.com/ng2-bootstrap@1.0.24/bundles',
				// 'ng2-bootstrap':              'https://cdnjs.cloudflare.com/ajax/libs/ng2-bootstrap/1.0.24/ng2-bootstrap.min.js',
				'moment':                     'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1',
				// 'ts':                         'https://npmcdn.com/plugin-typescript@4.0.10/lib/plugin.js',
				// 'typescript':                 'https://npmcdn.com/typescript@1.9.0-dev.20160409/lib/typescript.js',
			};
			// packages defines our app package
			var packages = {
				'app': {
					main: 'main.js',
					// format: 'register',
					defaultExtension: 'js'
				},
				'rxjs': { defaultExtension: 'js' },
				'ng2-bootstrap': { main: 'ng2-bootstrap.min.js', defaultExtension: 'js' },
				'moment': { main: 'moment.min.js', defaultExtension: 'js' },
			};

			var ngPackageNames = [
				'common',
				'compiler',
				'core',
				'forms',
				'http',
				'platform-browser',
				'platform-browser-dynamic',
				'router',
				'router-deprecated',
				'upgrade',
			];
			// Individual files (~300 requests):
			function packIndex(pkgName) {
				packages['@angular/'+pkgName] = { main: 'index.js', defaultExtension: 'js' };
			}
			// Bundled (~40 requests):
			function packUmd(pkgName) {
				packages['@angular/'+pkgName] = { main: '/bundles/' + pkgName + '.umd.js', defaultExtension: 'js' };
			}
			// Most environments should use UMD; some (Karma) need the individual index files
			var setPackageConfig = System.packageWithIndex ? packIndex : packUmd;
			// Add package entries for angular packages
			ngPackageNames.forEach(setPackageConfig);

			// No umd for router yet
			packages['@angular/router'] = { main: 'index.js', defaultExtension: 'js' };

			var config = {
				baseURL: '<?= get_stylesheet_directory_uri() ?>/src/ts', // set our baseURL reference path
				map: map,
				packages: packages
			};
			System.config( config );
		})(this);
		$(function($) {
			System.import('app').catch(function(err){ console.error(err); });
		});
	</script>
<!--
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/2.0.0-beta.17/angular2.min.js"></script>
-->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/2.0.0-beta.17/http.min.js"></script>

	<script type="text/javascript">
		(function javascript_fallbacks() {
			// See: http://stackoverflow.com/a/5531821
			function document_write_script( src ) {
				document.write( '<script src="' + src + '">\x3C/script>' );
			}
			if ( ! window.jQuery ) { document_write_script( '/js/jquery.min.js' ); }
			var bootstrap_enabled = ( 'function' === typeof $().modal ); // Will be true if bootstrap is loaded, false otherwise
			if ( ! bootstrap_enabled ) { document_write_script( '/js/bootstrap.min.js' ); }
			if ( 'undefined' === typeof $().validate ) { 
				document_write_script( '/js/jquery.validate.min.js' );
				document_write_script( '/js/additional-methods.min.js' );
			}
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
