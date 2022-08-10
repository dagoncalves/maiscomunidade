(function ($) {
	'use strict';

	var parallax = {};
	eltd.modules.parallax = parallax;

	parallax.eltdInitParallax = eltdInitParallax;


	parallax.eltdOnWindowLoad = eltdOnWindowLoad;

	$(window).on('load', eltdOnWindowLoad);

	/*
	 ** All functions to be called on $(window).on('load', ) should be in this function
	 */
	function eltdOnWindowLoad() {
		eltdInitParallax();
		if (eltd.body.hasClass('wpb-js-composer')) {
			window.vc_rowBehaviour(); //call vc row behavior on load, this is for parallax on row since it is not loaded after some other shortcodes are loaded
		}
	}

	/*
	 ** Init parallax shortcode
	 */
	function eltdInitParallax() {
		var parallaxHolder = $('.eltd-parallax-holder');

		if (parallaxHolder.length) {
			parallaxHolder.each(function () {
				var parallaxElement = $(this),
					speed = parallaxElement.data('parallax-speed') * 0.4;

				parallaxElement.parallax('50%', speed);
			});
		}
	}

})(jQuery);