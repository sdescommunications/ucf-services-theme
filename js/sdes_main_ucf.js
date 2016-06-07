// Theme-wide Javascript.

// Computer Graphics Clamping - https://en.wikipedia.org/wiki/Clamping_(graphics)
Number.prototype.clamp = function(min, max) {
    return Math.min(Math.max(this, min), max);
};

// https://github.com/UCF/Students-Theme/blob/87dca3074cb48bef5d811789cf9a07c9eac55cd1/src/js/script.js#L18-L32
var headerImage = function($) {
    var resize = function() {
        var $image = $('.header-image'),
            width = $image.width(),
            height = (width * 0.375).clamp(300, 750);

        $image.height(height + 'px');
        $image.children('.container').height(height + 'px');
    };
    resize();

    $(window).on('resize', function() {
        resize();
    });
};


$(function($) {
    headerImage($);

    // Open external links and PDF files in new tabs.
    $( 'a.external, a[href$=".pdf"]' ).click( function( e ) {
        window.open( this.href );
        e.preventDefault();
    });

    /* Link to Theme Customizer instead of nav-menus.php if Javascript is enabled.
     * @see https://developer.wordpress.org/themes/advanced-topics/customizer-api/#focusing
     */
    $( '.adminmsg-menu' ).each( function( idx, elem ) {
        var $this = $( this );
        $this.attr( 'href', '../wp-admin/customize.php?autofocus[control]=' + $this.data( 'control-name' ) );
    });
});
