(function($) {
	'use strict';

	var masonryGallery = {};
	eltd.modules.masonryGallery = masonryGallery;

	masonryGallery.eltdInitMasonryGallery = eltdInitMasonryGallery;


	masonryGallery.eltdOnDocumentReady = eltdOnDocumentReady;

	$(document).ready(eltdOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitMasonryGallery();
	}

	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function eltdInitMasonryGallery(){
		var galleryHolder = $('.eltd-masonry-gallery-holder'),
			gallery = galleryHolder.children('.eltd-mg-inner'),
			gallerySizer = gallery.children('.eltd-mg-grid-sizer');

		resizeMasonryGallery(gallerySizer.outerWidth(), gallery);

		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.eltd-mg-inner');

				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});

					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltd-mg-item',
						percentPosition: true,
						packery: {
							gutter: '.eltd-mg-grid-gutter',
							columnWidth: '.eltd-mg-grid-sizer'
						}
					});
				});
			});

			$(window).resize(function(){
				resizeMasonryGallery(gallerySizer.outerWidth(), gallery);

				gallery.isotope('reloadItems');
			});
		}
	}

	function resizeMasonryGallery(size, holder){
		var rectangle_portrait = holder.find('.eltd-mg-rectangle-portrait'),
			rectangle_landscape = holder.find('.eltd-mg-rectangle-landscape'),
			square_big = holder.find('.eltd-mg-square-big'),
			square_small = holder.find('.eltd-mg-square-small');

		rectangle_portrait.css('height', 2*size);

		if (window.innerWidth <= 680) {
			rectangle_landscape.css('height', size/2);
		} else {
			rectangle_landscape.css('height', size);
		}

		square_big.css('height', 2*size);

		if (window.innerWidth <= 680) {
			square_big.css('height', square_big.width());
		}

		square_small.css('height', size);
	}

})(jQuery);