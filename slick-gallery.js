/*
 Plugin Name: Slick Gallery
 slick-gallery.js
*/
jQuery(function() {

	jQuery(window).load(function() {
		// justifiedGallery
		jQuery( ".slick-gallery" ).justifiedGallery( {
			rowHeight : 180,
		    lastRow : 'justify',
		    captions: false,
    		margins : 2 } ).on('jg.complete', function () {

			// Boxer
			var boxer_mobile = false;
			var boxer_class = jQuery( '.slick-gallery' ).attr( 'class' );
			if(0 <= boxer_class.indexOf( 'mobile' )){
				boxer_mobile = true;
			}

			jQuery('.slick-gallery a').boxer( {
				mobile: boxer_mobile
			} );
		});
	});
});
