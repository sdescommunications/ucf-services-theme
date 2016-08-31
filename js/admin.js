		
jQuery(function() {

	// Javascript to be run on only the admin pages.
	var bodyEl = document.getElementsByTagName('body');
	bodyEl[0].className = bodyEl[0].className.split('nojs').join(' jsEnabled ');

	// Make input fields hidden to update DOM and allow setting their values.
	jQuery('input.hide-if-js').attr('type', 'hidden');

});
