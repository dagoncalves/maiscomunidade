(function($) {
	'use strict';

	var listingGallery = {};
	eltd.modules.listingGallery = listingGallery;

	listingGallery.eltdIniListingGallery = eltdIniListingGallery;

	listingGallery.eltdOnDocumentReady = eltdOnDocumentReady;

	$(document).ready(eltdOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdIniListingGallery();
	}

	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function eltdIniListingGallery(){

		var galleryHolder = $('.eltd-ls-category-gallery'),
			gallery = galleryHolder.children('.eltd-ls-gallery-inner'),
			gallerySizer = gallery.children('.eltd-ls-gallery-sizer');

		resizeListingGallery(gallerySizer.outerWidth(), gallery);

		if(galleryHolder.length){
			galleryHolder.each(function(){
				var holder = $(this),
					holderGallery = holder.children('.eltd-ls-gallery-inner'),
					item = holder.children('.eltd-ls-gallery-item');

				holderGallery.waitForImages(function(){
					holderGallery.animate({opacity:1});

					holderGallery.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltd-ls-gallery-item',
						percentPosition: true,
						packery: {
							columnWidth: '.eltd-ls-gallery-sizer'
						}
					});
				});
			});

			$(window).resize(function(){
				resizeListingGallery(gallerySizer.outerWidth(), gallery);
				gallery.isotope('reloadItems');
			});
		}
	}

	function resizeListingGallery(size, holder){

		var rectangle_portrait = holder.find('.eltd-ls-gallery-rec-portrait'),
			rectangle_landscape = holder.find('.eltd-ls-gallery-rec-landscape'),
			square_big = holder.find('.eltd-ls-gallery-square-big'),
			square_small = holder.find('.eltd-ls-gallery-square-small'),
			simpleArticle = holder.find('.eltd-ls-gallery-simple');
		
		rectangle_landscape.css('height', size);
		square_small.css('height', size);

		if (window.innerWidth <= 680) {
            rectangle_portrait.css('height', size);
            square_big.css('height', size);
		} else {
            rectangle_portrait.css('height', 2*size);
            square_big.css('height', 2*size);
		}

		if(window.innerWidth < 1024){
            simpleArticle.addClass('simple-layout-changed');
            simpleArticle.css('height', 'auto');
		}else{
            simpleArticle.removeClass('simple-layout-changed');
		}

	}

})(jQuery);