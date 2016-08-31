(function( $ ) {
	$(function() {

		// Template Function
		// wp.customize( 'theme_customizer_setting_name', function( value ) {
		// 	value.bind( function( to ) {
		// 		// Bind dynamically using javascript when using Theme Customizer inferace.
		//		// This will match anywhere that you use get_theme_mod() for this setting.
		// 	});
		// });

		wp.customize( 'services_theme-sitetitle_anchor_width', function( value ) {
			value.bind( function( to ) {
				$( '.header-center a' ).css( 'width', to );
			});
		});
		wp.customize( 'services_theme-sitetitle_anchor_maxwidth', function( value ) {
			value.bind( function( to ) {
				$( '.header-center a' ).css( 'max-width', to );
			});
		});
	});
}( jQuery ) );
