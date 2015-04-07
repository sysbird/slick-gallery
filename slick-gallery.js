/*
 Plugin Name: Slick Gallery
 slick-gallery.js
*/
jQuery(function() {

	jQuery(window).load(function() {
		jQuery(".slick-gallery").justifiedGallery({
			rowHeight : 180,
		    lastRow : 'justify',
		    captions: false,
    		margins : 2}).on('jg.complete', function () {

			// Zoom-gallery
			jQuery('.slick-gallery').magnificPopup( {
				delegate: 'a',
				type: 'image',
				closeOnContentClick: false,
				mainClass: 'mfp-with-zoom mfp-img-mobile',
				image: {
					verticalFit: true,
					titleSrc: function( item ) {
						return item.el.find( 'img' ).attr( 'alt' ) + '';
					}
				},
				gallery: {
					enabled: true
				},
				zoom: {
					enabled: true,
					duration: 300, // don't foget to change the duration also in CSS
					opener: function(element) {
						return element.find('img');
					}
				}
			} );

		});
	});
});
