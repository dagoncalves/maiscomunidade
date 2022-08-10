(function($) {
	'use strict';
	
	var scrollingImage = {};
	eltd.modules.scrollingImage = scrollingImage;
	
	scrollingImage.scrollingImageInit = scrollingImageInit;
	
	
	scrollingImage.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		scrollingImageInit();
	}
	

	var scrollingImageInit = function() {
		var scrollingImageShortcodes = $('.eltd-scrolling-image');

		if (scrollingImageShortcodes.length) {
		    scrollingImageShortcodes.each(function(){
		        var scrollingImageShortcode = $(this),
		            frame = scrollingImageShortcode.find('.eltd-image-frame'),
		            frameHeight,
		            scrollingImage = scrollingImageShortcode.find('.eltd-scrolling-img'),
		            scrollingImageHeight,
		            delta,
		            timing,
		            scroll = false;

		        var scrollAnimation = function() {
		            //scroll animation
		            scrollingImageShortcode.mouseenter(function(){
		                frameHeight = frame.height();
		                scrollingImageHeight = scrollingImage.height();

		                if (scrollingImageHeight > frameHeight) { 
		                    scroll = true;
		                    delta = Math.round(scrollingImageHeight - frameHeight);
		                    timing = Math.round(scrollingImageHeight/frameHeight)*1.5;
		                    scrollingImage.css('transition-duration',timing+'s'); //transition duration set in relation to image height
		                    scrollingImage.css('transform', 'translate3d(0px, -'+delta+'px, 0px)');
		                }
		            });

		            scrollingImageShortcode.mouseleave(function(){
		                if (scroll) {
		                    scrollingImage.css('transition-duration',timing+'s');
		                    scrollingImage.css('transform', 'translate3d(0px, 0px, 0px)');
		                }
		            });
		        };

		        scrollAnimation();
		    });
		};
	};
	
})(jQuery);