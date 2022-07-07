(function ($) {
    "use strict";

    window.eltd = {};
    eltd.modules = {};

    eltd.scroll = 0;
    eltd.window = $(window);
    eltd.document = $(document);
    eltd.windowWidth = $(window).width();
    eltd.windowHeight = $(window).height();
    eltd.body = $('body');
    eltd.html = $('html, body');
    eltd.htmlEl = $('html');
    eltd.menuDropdownHeightSet = false;
    eltd.defaultHeaderStyle = '';
    eltd.minVideoWidth = 1500;
    eltd.videoWidthOriginal = 1280;
    eltd.videoHeightOriginal = 720;
    eltd.videoRatio = 1.61;

    function eltdTransitionEvent() {
        var el = document.createElement('transitionDetector'),
            transEndEventNames = {
                'WebkitTransition': 'webkitTransitionEnd',// Saf 6, Android Browser
                'MozTransition': 'transitionend',      // only for FF < 15
                'transition': 'transitionend'       // IE10, Opera, Chrome, FF 15+, Saf 7+
            };

        for (var t in transEndEventNames) {
            if (el.style[t] !== undefined) {
                return transEndEventNames[t];
            }
        }
    }

    eltd.transitionEnd = eltdTransitionEvent();

    eltd.eltdOnDocumentReady = eltdOnDocumentReady;
    eltd.eltdOnWindowLoad = eltdOnWindowLoad;
    eltd.eltdOnWindowResize = eltdOnWindowResize;
    eltd.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltd.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if (eltd.body.hasClass('eltd-dark-header')) { eltd.defaultHeaderStyle = 'eltd-dark-header'; }
        if (eltd.body.hasClass('eltd-light-header')) { eltd.defaultHeaderStyle = 'eltd-light-header'; }
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltd.windowWidth = $(window).width();
        eltd.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
        eltd.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch (true) {
        case eltd.body.hasClass('eltd-grid-1300'):
            eltd.boxedLayoutWidth = 1350;
            break;
        case eltd.body.hasClass('eltd-grid-1200'):
            eltd.boxedLayoutWidth = 1250;
            break;
        case eltd.body.hasClass('eltd-grid-1000'):
            eltd.boxedLayoutWidth = 1050;
            break;
        case eltd.body.hasClass('eltd-grid-800'):
            eltd.boxedLayoutWidth = 850;
            break;
        default:
            eltd.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function ($) {
	"use strict";

	var common = {};
	eltd.modules.common = common;

	common.eltdFluidVideo = eltdFluidVideo;
	common.eltdEnableScroll = eltdEnableScroll;
	common.eltdDisableScroll = eltdDisableScroll;
	common.eltdOwlSlider = eltdOwlSlider;
	common.getLoadMoreData = getLoadMoreData;
	common.setLoadMoreAjaxData = setLoadMoreAjaxData;

	common.eltdOnDocumentReady = eltdOnDocumentReady;
	common.eltdOnWindowLoad = eltdOnWindowLoad;
	common.eltdOnWindowResize = eltdOnWindowResize;
	common.eltdOnWindowScroll = eltdOnWindowScroll;

	$(document).ready(eltdOnDocumentReady);
	$(window).on('load', eltdOnWindowLoad);
	$(window).resize(eltdOnWindowResize);
	$(window).scroll(eltdOnWindowScroll);

	/* 
		All functions to be called on $(document).ready() should be in this function
	*/
	function eltdOnDocumentReady() {
		eltdIconWithHover().init();
		eltdIEversion();
		eltdInitAnchor().init();
		eltdInitBackToTop();
		eltdBackButtonShowHide();
		eltdInitSelfHostedVideoPlayer();
		eltdSelfHostedVideoSize();
		eltdFluidVideo();
		eltdOwlSlider();
		eltdPreloadBackgrounds();
		eltdPrettyPhoto();
	}

	/* 
		All functions to be called on $(window).on('load', ) should be in this function
	*/
	function eltdOnWindowLoad() {
		eltdSmoothTransition();
	}

	/* 
		All functions to be called on $(window).resize() should be in this function
	*/
	function eltdOnWindowResize() {
		eltdSelfHostedVideoSize();
	}

	/* 
		All functions to be called on $(window).scroll() should be in this function
	*/
	function eltdOnWindowScroll() {
	}

	/*
	 * IE version
	 */
	function eltdIEversion() {
		var ua = window.navigator.userAgent;
		var msie = ua.indexOf("MSIE ");

		if (msie > 0) {
			var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
			eltd.body.addClass('eltd-ms-ie' + version);
		}
		return false;
	}

	function eltdDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('DOMMouseScroll', eltdWheel, false);
		}

		window.onmousewheel = document.onmousewheel = eltdWheel;
		document.onkeydown = eltdKeydown;
	}

	function eltdEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('DOMMouseScroll', eltdWheel, false);
		}

		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}

	function eltdWheel(e) {
		eltdPreventDefaultValue(e);
	}

	function eltdKeydown(e) {
		var keys = [37, 38, 39, 40];

		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				eltdPreventDefaultValue(e);
				return;
			}
		}
	}

	function eltdPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}

	/*
	 **	Anchor functionality
	 */
	var eltdInitAnchor = function () {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function (anchor) {

			$('.eltd-main-menu .eltd-active-item, .eltd-mobile-nav .eltd-active-item, .eltd-fullscreen-menu .eltd-active-item').removeClass('eltd-active-item');
			anchor.parent().addClass('eltd-active-item');

			$('.eltd-main-menu a, .eltd-mobile-nav a, .eltd-fullscreen-menu a').removeClass('current');
			anchor.addClass('current');
		};

		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function () {

			$('[data-eltd-anchor]').waypoint(function (direction) {
				if (direction === 'down') {
					setActiveState($("a[href='" + window.location.href.split('#')[0] + "#" + $(this.element).data("eltd-anchor") + "']"));
				}
			}, { offset: '50%' });

			$('[data-eltd-anchor]').waypoint(function (direction) {
				if (direction === 'up') {
					setActiveState($("a[href='" + window.location.href.split('#')[0] + "#" + $(this.element).data("eltd-anchor") + "']"));
				}
			}, {
				offset: function () {
					return -($(this.element).outerHeight() - 150);
				}
			});

		};

		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function () {
			var hash = window.location.hash.split('#')[1];

			if (hash !== "" && $('[data-eltd-anchor="' + hash + '"]').length > 0) {
				anchorClickOnLoad(hash);
			}
		};

		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount;
			var anchor = $('a');
			var hash = $this;
			if (hash !== "" && $('[data-eltd-anchor="' + hash + '"]').length > 0) {
				var anchoredElementOffset = $('[data-eltd-anchor="' + hash + '"]').offset().top;
				scrollAmount = $('[data-eltd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - eltdGlobalVars.vars.eltdAddForAdminBar;

				setActiveState(anchor);

				eltd.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) { history.pushState(null, null, '#' + hash); }
				});
				return false;
			}
		};

		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offest
		 */
		var headerHeihtToSubtract = function (anchoredElementOffset) {

			if (eltd.modules.stickyHeader.behaviour === 'eltd-sticky-header-on-scroll-down-up') {
				eltd.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > eltd.modules.header.stickyAppearAmount);
			}

			if (eltd.modules.stickyHeader.behaviour === 'eltd-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > eltd.scroll)) {
					eltd.modules.stickyHeader.isStickyVisible = false;
				}
			}

			var headerHeight = eltd.modules.stickyHeader.isStickyVisible ? eltdGlobalVars.vars.eltdStickyHeaderTransparencyHeight : eltdPerPageVars.vars.eltdHeaderTransparencyHeight;

			if (eltd.windowWidth < 1025) {
				headerHeight = 0;
			}

			return headerHeight;
		};

		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			eltd.document.on("click", ".eltd-main-menu a, .eltd-fullscreen-menu a, .eltd-btn, .eltd-anchor, .eltd-mobile-nav a", function () {
				var scrollAmount;
				var anchor = $(this);
				var hash = anchor.prop("hash").split('#')[1];

				if (hash !== "" && $('[data-eltd-anchor="' + hash + '"]').length > 0) {

					var anchoredElementOffset = $('[data-eltd-anchor="' + hash + '"]').offset().top;
					scrollAmount = $('[data-eltd-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - eltdGlobalVars.vars.eltdAddForAdminBar;

					setActiveState(anchor);

					eltd.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) { history.pushState(null, null, '#' + hash); }
					});
					return false;
				}
			});
		};

		return {
			init: function () {
				if ($('[data-eltd-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();
					$(window).on('load', function () { checkActiveStateOnLoad(); });
				}
			}
		};
	};

	function eltdInitBackToTop() {
		var backToTopButton = $('#eltd-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			eltd.html.animate({ scrollTop: 0 }, eltd.window.scrollTop() / 3, 'easeInOutQuad');
		});
	}

	function eltdBackButtonShowHide() {
		eltd.window.scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { eltdToTopButton('off'); } else { eltdToTopButton('on'); }
		});
	}

	function eltdToTopButton(a) {
		var b = $("#eltd-back-to-top");
		b.removeClass('off on');
		if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
	}

	function eltdInitSelfHostedVideoPlayer() {
		var players = $('.eltd-self-hosted-video');

		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}

	function eltdSelfHostedVideoSize() {
		var selfVideoHolder = $('.eltd-self-hosted-video-holder .eltd-video-wrap');

		if (selfVideoHolder.length) {
			selfVideoHolder.each(function () {
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.eltd-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / eltd.videoRatio;

				if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}

				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);

				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}

	function eltdFluidVideo() {
		fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

	function eltdSmoothTransition() {

		if (eltd.body.hasClass('eltd-smooth-page-transitions')) {

			//check for preload animation
			if (eltd.body.hasClass('eltd-smooth-page-transitions-preloader')) {
				var loader = $('body > .eltd-smooth-transition-loader.eltd-mimic-ajax');
				loader.fadeOut(500);
				$(window).on('bind', "pageshow", function (event) {
					if (event.originalEvent.persisted) {
						loader.fadeOut(500);
					}
				});
			}

			// if back button is pressed, than reload page to avoid state where content is on display:none

			window.addEventListener("pageshow", function (event) {
				var historyPath = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
				if (historyPath) {
					window.location.reload();
				}
			});


			//check for fade out animation
			if (eltd.body.hasClass('eltd-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');

				if ((linkItem.parents('.eltd-shopping-cart-dropdown').length || linkItem.parent('.product-remove').length) && linkItem.hasClass('remove')) {
					return false;
				}

				linkItem.on('click', function (e) {
					var a = $(this);

					if (
						e.which == 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.eltd-wrapper-inner').fadeOut(1000, function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}

	/*
	 *	Preload background images for elements that have 'eltd-preload-background' class
	 */
	function eltdPreloadBackgrounds() {
		var preloadBackHolder = $('.eltd-preload-background');

		if (preloadBackHolder.length) {
			preloadBackHolder.each(function () {
				var preloadBackground = $(this);

				if (preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") != "none") {
					var bgUrl = preloadBackground.attr('style');

					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";

					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).load(function () {
							preloadBackground.removeClass('eltd-preload-background');
						});
					}
				} else {
					$(window).on('load', function () { preloadBackground.removeClass('eltd-preload-background'); }); //make sure that eltd-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}

	function eltdPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}

	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container) {
		var dataList = container.data(),
			returnValue = {};

		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}

		return returnValue;
	}

	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};

		for (var property in container) {
			if (container.hasOwnProperty(property)) {

				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}

		return returnValue;
	}

	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdIconWithHover = function () {
		//get all icons on page
		var icons = $('.eltd-icon-has-hover');

		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function (icon) {
			if (typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function (event) {
					event.data.icon.css('color', event.data.color);
				};

				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');

				if (hoverColor !== '') {
					icon.on('mouseenter', { icon: icon, color: hoverColor }, changeIconColor);
					icon.on('mouseleave', { icon: icon, color: originalColor }, changeIconColor);
				}
			}
		};

		return {
			init: function () {
				if (icons.length) {
					icons.each(function () {
						iconHoverColor($(this));
					});
				}
			}
		};
	};

	/**
	 * Init Owl Carousel
	 */
	function eltdOwlSlider() {
		var sliders = $('.eltd-owl-slider');

		if (sliders.length) {
			sliders.each(function () {
				var slider = $(this),
					slideItemsNumber = slider.children().length,
					numberOfItems = 1,
					loop = true,
					autoplay = true,
					autoplayHoverPause = false,
					sliderSpeed = 5000,
					sliderSpeedAnimation = 600,
					margin = 0,
					center = false,
					autoWidth = false,
					animateInClass = false, // keyframe css animation
					animateOut = false, // keyframe css animation
					navigation = true,
					pagination = false,
					sliderIsPortfolio = !!slider.hasClass('eltd-pl-is-slider'),
					sliderDataHolder = sliderIsPortfolio ? slider.parent() : slider;  // this is condition for portfolio slider


				if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && !sliderIsPortfolio) {
					numberOfItems = slider.data('number-of-items');
				}
				if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsPortfolio) {
					numberOfItems = sliderDataHolder.data('number-of-columns');
				}
				if (sliderDataHolder.data('enable-loop') === 'no') {
					loop = false;
				}
				if (sliderDataHolder.data('enable-autoplay') === 'no') {
					autoplay = false;
				}
				if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
					sliderSpeed = sliderDataHolder.data('slider-speed');
				}
				if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
					sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
				}
				if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
					margin = sliderDataHolder.data('slider-margin');
				}
				if (slider.parent().hasClass('eltd-normal-space')) {
					margin = 40;
				} else if (slider.parent().hasClass('eltd-small-space')) {
					margin = 20;
				} else if (slider.parent().hasClass('eltd-tiny-space')) {
					margin = 10;
				}

				if (sliderDataHolder.data('enable-center') === 'yes') {
					center = true;
				}
				if (sliderDataHolder.data('enable-auto-width') === 'yes') {
					autoWidth = true;
				}
				if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
					animateInClass = sliderDataHolder.data('slider-animate-in');
				}
				if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
					animateOut = sliderDataHolder.data('slider-animate-out');
				}
				if (sliderDataHolder.data('enable-navigation') === 'no') {
					navigation = false;
				}
				if (sliderDataHolder.data('enable-pagination') === 'yes') {
					pagination = true;
				}

				if (navigation && pagination) {
					slider.addClass('eltd-slider-has-both-nav');
				}

				if (slideItemsNumber <= 1) {
					loop = false;
					autoplay = false;
					navigation = false;
					pagination = false;
				}

				var responsiveNumberOfItems1 = 1,
					responsiveNumberOfItems2 = 2,
					responsiveNumberOfItems3 = 3;

				if (numberOfItems < 3) {
					responsiveNumberOfItems2 = numberOfItems;
					responsiveNumberOfItems3 = numberOfItems;
				}


				slider.waitForImages(function () {
					slider.owlCarousel({
						items: numberOfItems,
						loop: loop,
						autoplay: autoplay,
						autoplayHoverPause: autoplayHoverPause,
						autoplayTimeout: sliderSpeed,
						autoplaySpeed: sliderSpeedAnimation,
						smartSpeed: sliderSpeedAnimation,
						margin: margin,
						center: center,
						autoWidth: autoWidth,
						animateInClass: animateInClass,
						animateOut: animateOut,
						dots: pagination,
						nav: navigation,
						navText: [
							'<span class="eltd-prev-icon"><span class="eltd-icon-arrow icon-arrows-left"></span></span>',
							'<span class="eltd-next-icon"><span class="eltd-icon-arrow icon-arrows-right"></span></span>'
						],
						responsive: {
							0: {
								items: responsiveNumberOfItems1,
								margin: 0,
								center: false,
								autoWidth: false
							},
							680: {
								items: responsiveNumberOfItems2
							},
							768: {
								items: responsiveNumberOfItems2
							},
							1024: {
								items: responsiveNumberOfItems3
							},
							1280: {
								items: numberOfItems
							}
						},
						onInitialize: function () {
							slider.css('visibility', 'visible');
							eltd.modules.parallax.eltdInitParallax();
						}
					});
				});

			});
		}
	}

})(jQuery);
(function ($) {
	"use strict";

	var blog = {};
	eltd.modules.blog = blog;

	blog.eltdOnDocumentReady = eltdOnDocumentReady;
	blog.eltdOnWindowLoad = eltdOnWindowLoad;
	blog.eltdOnWindowResize = eltdOnWindowResize;
	blog.eltdOnWindowScroll = eltdOnWindowScroll;

	$(document).ready(eltdOnDocumentReady);
	$(window).on('load', eltdOnWindowLoad);
	$(window).resize(eltdOnWindowResize);
	$(window).scroll(eltdOnWindowScroll);

	/* 
		All functions to be called on $(document).ready() should be in this function
	*/
	function eltdOnDocumentReady() {
		eltdInitAudioPlayer();
		eltdInitBlogMasonry();
		eltdInitBlogListMasonry();
		eltdInitBlogMasonryGallery();
	}

	/* 
		All functions to be called on $(window).on('load', ) should be in this function
	*/
	function eltdOnWindowLoad() {
		eltdInitBlogPagination().init();
		eltdInitBlogListShortcodePagination().init();
		eltdInitBlogChequered();
		eltdInitBlogMasonryGalleryAppear();
		eltdInitBlogNarrowAppear();
	}

	/* 
		All functions to be called on $(window).resize() should be in this function
	*/
	function eltdOnWindowResize() {
		eltdInitBlogMasonry();
		eltdInitBlogMasonryGallery();
	}

	/* 
		All functions to be called on $(window).scroll() should be in this function
	*/
	function eltdOnWindowScroll() {
		eltdInitBlogPagination().scroll();
		eltdInitBlogListShortcodePagination().scroll();
	}

	/**
	* Init audio player for Blog list and single pages
	*/
	function eltdInitAudioPlayer() {
		var players = $('audio.eltd-blog-audio');

		players.mediaelementplayer({
			audioWidth: '100%'
		});
	}

	/**
	 * Init Resize Blog Items
	 */
	function eltdResizeBlogItems(size, container) {

		if (container.hasClass('eltd-masonry-images-fixed')) {
			var padding = parseInt(container.find('article').css('padding-left')),
				defaultMasonryItem = container.find('.eltd-post-size-default'),
				largeWidthMasonryItem = container.find('.eltd-post-size-large-width'),
				largeHeightMasonryItem = container.find('.eltd-post-size-large-height'),
				largeWidthHeightMasonryItem = container.find('.eltd-post-size-large-width-height');

			if (eltd.windowWidth > 680) {
				defaultMasonryItem.css('height', size - 2 * padding);
				largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
				largeWidthMasonryItem.css('height', size - 2 * padding);
			} else {
				defaultMasonryItem.css('height', size);
				largeHeightMasonryItem.css('height', size);
				largeWidthHeightMasonryItem.css('height', size);
				largeWidthMasonryItem.css('height', Math.round(size / 2));
			}
		}
	}

	/**
	* Init Blog Masonry Layout
	*/
	function eltdInitBlogMasonry() {
		var holder = $('.eltd-blog-holder.eltd-blog-type-masonry');

		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.children('.eltd-blog-holder-inner'),
					size = thisHolder.find('.eltd-blog-masonry-grid-sizer').width();

				eltdResizeBlogItems(size, thisHolder);

				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: 'article',
						percentPosition: true,
						packery: {
							gutter: '.eltd-blog-masonry-grid-gutter',
							columnWidth: '.eltd-blog-masonry-grid-sizer'
						}
					});
					masonry.css('opacity', '1');
				});
			});
		}
	}

	/**
	 *  Init Blog Chequered
	 */
	function eltdInitBlogChequered() {
		var container = $('.eltd-blog-holder.eltd-blog-chequered');
		var masonry = container.children('.eltd-blog-holder-inner');
		var newSize;

		if (container.length) {
			newSize = masonry.find('.eltd-blog-masonry-grid-sizer').outerWidth();
			masonry.children('article').css({ 'height': (newSize) + 'px' });
			masonry.isotope('layout', function () {
				masonry.css('opacity', '1');
			});
		}
	}


	/**
	 *  Init Blog Masonry Gallery
	 *
	 *  Function that sets equal height of articles on blog masonry gallery list
	 */
	function eltdInitBlogMasonryGallery() {
		var blogList = $('.eltd-blog-holder.eltd-blog-masonry-gallery');
		if (blogList.length) {
			blogList.each(function () {

				var container = $(this),
					masonry = container.children('.eltd-blog-holder-inner'),
					article = masonry.find('article'),
					size = masonry.find('.eltd-blog-masonry-grid-sizer').width() * 1.25;

				article.css({ 'height': (size) + 'px' });

				masonry.isotope('layout', function () { });
				eltdInitBlogMasonryGalleryAppear();
			});
		}
	}

	/**
	 *  Animate blog masonry gallery type
	 */
	function eltdInitBlogMasonryGalleryAppear() {
		var blogList = $('.eltd-blog-holder.eltd-blog-masonry-gallery');
		if (blogList.length) {
			blogList.each(function () {
				var thisBlogList = $(this),
					article = thisBlogList.find('article'),
					pagination = thisBlogList.find('.eltd-blog-pagination-holder'),
					animateCycle = 7, // rewind delay
					animateCycleCounter = 0;

				article.each(function () {
					var thisArticle = $(this);
					setTimeout(function () {
						thisArticle.appear(function () {
							animateCycleCounter++;
							if (animateCycleCounter == animateCycle) {
								animateCycleCounter = 0;
							}
							setTimeout(function () {
								thisArticle.addClass('eltd-appeared');
							}, animateCycleCounter * 200);
						}, { accX: 0, accY: 0 });
					}, 150);
				});

				pagination.appear(function () {
					pagination.addClass('eltd-appeared');
				}, { accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount });

			});
		}
	}

	/**
	 *  Animate blog narrow articles on appear
	 */
	function eltdInitBlogNarrowAppear() {
		var blogList = $('.eltd-blog-holder.eltd-blog-narrow');
		if (blogList.length) {
			blogList.each(function () {
				var thisBlogList = $(this),
					article = thisBlogList.find('article'),
					pagination = thisBlogList.find('.eltd-blog-pagination-holder');

				article.each(function () {
					var thisArticle = $(this);
					thisArticle.appear(function () {
						thisArticle.addClass('eltd-appeared');
					}, { accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount });
				});

				pagination.appear(function () {
					pagination.addClass('eltd-appeared');
				}, { accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount });

			});
		}
	}


	/**
	 * Initializes blog pagination functions
	 */
	function eltdInitBlogPagination() {
		var holder = $('.eltd-blog-holder');

		var initLoadMorePagination = function (thisHolder) {
			var loadMoreButton = thisHolder.find('.eltd-blog-pag-load-more a');

			loadMoreButton.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				initMainPagFunctionality(thisHolder);
			});
		};

		var initInifiteScrollPagination = function (thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdGlobalVars.vars.eltdAddForAdminBar;

			if (!thisHolder.hasClass('eltd-blog-pagination-infinite-scroll-started') && eltd.scroll + eltd.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};

		var initMainPagFunctionality = function (thisHolder) {
			var thisHolderInner = thisHolder.children('.eltd-blog-holder-inner'),
				nextPage,
				maxNumPages;

			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}

			if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('eltd-blog-pagination-infinite-scroll-started');
			}

			var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltd-blog-pag-loading');

			nextPage = loadMoreDatta.nextPage;

			if (nextPage <= maxNumPages) {
				loadingItem.addClass('eltd-showing');

				var ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'findme_elated_blog_load_more');

				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdGlobalVars.vars.eltdAjaxUrl,
					success: function (data) {
						nextPage++;

						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml = response.html;

						thisHolder.waitForImages(function () {
							if (thisHolder.hasClass('eltd-blog-type-masonry')) {
								eltdInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								eltdResizeBlogItems(thisHolderInner.find('.eltd-blog-masonry-grid-sizer').width(), thisHolder);
							} else {
								eltdInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}

							setTimeout(function () {
								eltdInitAudioPlayer();
								eltd.modules.common.eltdOwlSlider();
								eltd.modules.common.eltdFluidVideo();
								eltdInitBlogNarrowAppear();
								eltdInitBlogMasonryGalleryAppear();
								eltdInitBlogChequered();
							}, 400);
						});

						if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('eltd-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}

			if (nextPage === maxNumPages) {
				thisHolder.find('.eltd-blog-pag-load-more').hide();
			}
		};

		var eltdInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
			loadingItem.removeClass('eltd-showing');

			setTimeout(function () {
				thisHolderInner.isotope('layout');
			}, 400);
		};

		var eltdInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltd-showing');
			thisHolderInner.append(responseHtml);
		};

		return {
			init: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}

						if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

	/**
	 * Init blog list shortcode masonry layout
	 */
	function eltdInitBlogListMasonry() {
		var holder = $('.eltd-blog-list-holder.eltd-bl-masonry');

		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.find('.eltd-blog-list');

				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltd-bl-item',
						percentPosition: true,
						packery: {
							gutter: '.eltd-bl-grid-gutter',
							columnWidth: '.eltd-bl-grid-sizer'
						}
					});

					masonry.css('opacity', '1');
				});
			});
		}
	}

	/**
	 * Init blog list shortcode pagination functions
	 */
	function eltdInitBlogListShortcodePagination() {
		var holder = $('.eltd-blog-list-holder');

		var initStandardPagination = function (thisHolder) {
			var standardLink = thisHolder.find('.eltd-bl-standard-pagination li');

			if (standardLink.length) {
				standardLink.each(function () {
					var thisLink = $(this).children('a'),
						pagedLink = 1;

					thisLink.on('click', function (e) {
						e.preventDefault();
						e.stopPropagation();

						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}

						initMainPagFunctionality(thisHolder, pagedLink);
					});
				});
			}
		};

		var initLoadMorePagination = function (thisHolder) {
			var loadMoreButton = thisHolder.find('.eltd-blog-pag-load-more a');

			loadMoreButton.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				initMainPagFunctionality(thisHolder);
			});
		};

		var initInifiteScrollPagination = function (thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - eltdGlobalVars.vars.eltdAddForAdminBar;

			if (!thisHolder.hasClass('eltd-bl-pag-infinite-scroll-started') && eltd.scroll + eltd.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};

		var initMainPagFunctionality = function (thisHolder, pagedLink) {
			var thisHolderInner = thisHolder.find('.eltd-blog-list'),
				nextPage,
				maxNumPages;

			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}

			if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
				thisHolder.data('next-page', pagedLink);
			}

			if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll')) {
				thisHolder.addClass('eltd-bl-pag-infinite-scroll-started');
			}

			var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.eltd-blog-pag-loading');

			nextPage = loadMoreDatta.nextPage;

			if (nextPage <= maxNumPages) {
				if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
					loadingItem.addClass('eltd-showing eltd-standard-pag-trigger');
					thisHolder.addClass('eltd-bl-pag-standard-blog-list-animate');
				} else {
					loadingItem.addClass('eltd-showing');
				}

				var ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'findme_elated_blog_shortcode_load_more');

				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: eltdGlobalVars.vars.eltdAjaxUrl,
					success: function (data) {
						if (!thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
							nextPage++;
						}

						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml = response.html;

						if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
							eltdInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

							thisHolder.waitForImages(function () {
								if (thisHolder.hasClass('eltd-bl-masonry')) {
									eltdInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								} else {
									eltdInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisHolder.waitForImages(function () {
								if (thisHolder.hasClass('eltd-bl-masonry')) {
									eltdInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								} else {
									eltdInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
								}
							});
						}

						if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll-started')) {
							thisHolder.removeClass('eltd-bl-pag-infinite-scroll-started');
						}
					}
				});
			}

			if (nextPage === maxNumPages) {
				thisHolder.find('.eltd-blog-pag-load-more').hide();
			}
		};

		var eltdInitStandardPaginationLinkChanges = function (thisHolder, maxNumPages, nextPage) {
			var standardPagHolder = thisHolder.find('.eltd-bl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.eltd-bl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.eltd-bl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.eltd-bl-pag-next a');

			standardPagNumericItem.removeClass('eltd-bl-pag-active');
			standardPagNumericItem.eq(nextPage - 1).addClass('eltd-bl-pag-active');

			standardPagPrevItem.data('paged', nextPage - 1);
			standardPagNextItem.data('paged', nextPage + 1);

			if (nextPage > 1) {
				standardPagPrevItem.css({ 'opacity': '1' });
			} else {
				standardPagPrevItem.css({ 'opacity': '0' });
			}

			if (nextPage === maxNumPages) {
				standardPagNextItem.css({ 'opacity': '0' });
			} else {
				standardPagNextItem.css({ 'opacity': '1' });
			}
		};

		var eltdInitHtmlIsotopeNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
			loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
			thisHolder.removeClass('eltd-bl-pag-standard-blog-list-animate');

			setTimeout(function () {
				thisHolderInner.isotope('layout');
			}, 400);
		};

		var eltdInitHtmlGalleryNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
			thisHolder.removeClass('eltd-bl-pag-standard-blog-list-animate');
			thisHolderInner.html(responseHtml);
		};

		var eltdInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
			loadingItem.removeClass('eltd-showing');

			setTimeout(function () {
				thisHolderInner.isotope('layout');
			}, 400);
		};

		var eltdInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('eltd-showing');
			thisHolderInner.append(responseHtml);
		};

		return {
			init: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-bl-pag-standard-blog-list')) {
							initStandardPagination(thisHolder);
						}

						if (thisHolder.hasClass('eltd-bl-pag-load-more')) {
							initLoadMorePagination(thisHolder);
						}

						if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this);

						if (thisHolder.hasClass('eltd-bl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function ($) {
	"use strict";

	var header = {};
	eltd.modules.header = header;

	header.eltdOnDocumentReady = eltdOnDocumentReady;
	header.eltdOnWindowLoad = eltdOnWindowLoad;
	header.eltdOnWindowResize = eltdOnWindowResize;
	header.eltdOnWindowScroll = eltdOnWindowScroll;

	$(document).ready(eltdOnDocumentReady);
	$(window).on('load', eltdOnWindowLoad);
	$(window).resize(eltdOnWindowResize);
	$(window).scroll(eltdOnWindowScroll);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdSetDropDownMenuPosition();
		eltdDropDownMenu();
		eltdSearch();
		eltdSideArea();
		eltdSideAreaScroll();
	}

	/*
	 All functions to be called on $(window).on('load', ) should be in this function
	 */
	function eltdOnWindowLoad() {
	}

	/*
	 All functions to be called on $(window).resize() should be in this function
	 */
	function eltdOnWindowResize() {
	}

	/*
	 All functions to be called on $(window).scroll() should be in this function
	 */
	function eltdOnWindowScroll() {
	}

	/**
	 * Set dropdown position
	 */
	function eltdSetDropDownMenuPosition() {
		var menuItems = $(".eltd-drop-down > ul > li.narrow");

		if (menuItems.length) {
			menuItems.each(function (i) {
				var browserWidth = eltd.windowWidth - 16,
					menuItemPosition = $(this).offset().left,
					dropdownMenuWidth = $(this).find('.second .inner ul').width(),
					menuItemFromLeft = 0; // 16 is width of scroll bar

				if (eltd.body.hasClass('eltd-boxed')) {
					menuItemFromLeft = eltd.boxedLayoutWidth - (menuItemPosition - (browserWidth - eltd.boxedLayoutWidth) / 2);
				} else {
					menuItemFromLeft = browserWidth - menuItemPosition;
				}

				var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

				if ($(this).find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}

				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					$(this).find('.second').addClass('right');
					$(this).find('.second .inner ul').addClass('right');
				}
			});
		}
	}

	function eltdDropDownMenu() {
		var menu_items = $('.eltd-drop-down > ul > li');

		menu_items.each(function (i) {
			if ($(menu_items[i]).find('.second').length > 0) {
				var dropDownSecondDiv = $(menu_items[i]).find('.second');

				if ($(menu_items[i]).hasClass('wide')) {

					if (!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
						dropDownSecondDiv.css('left', 0);
					}

					//set columns to be same height - start
					var tallest = 0;
					$(this).find('.second > .inner > ul > li').each(function () {
						var thisHeight = $(this).height();
						if (thisHeight > tallest) {
							tallest = thisHeight;
						}
					});

					$(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
					$(this).find('.second > .inner > ul > li').height(tallest);
					//set columns to be same height - end

					var left_position;

					if (!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
						left_position = dropDownSecondDiv.offset().left;

						dropDownSecondDiv.css('left', -left_position);
						dropDownSecondDiv.css('width', eltd.windowWidth);
					}
				}

				if (!eltd.menuDropdownHeightSet) {
					$(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
					dropDownSecondDiv.height(0);
				}

				if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					$(menu_items[i]).on("touchstart mouseenter", function () {
						dropDownSecondDiv.css({
							'height': $(menu_items[i]).data('original_height'),
							'overflow': 'visible',
							'visibility': 'visible',
							'opacity': '1'
						});
					}).on("mouseleave", function () {
						dropDownSecondDiv.css({
							'height': '0px',
							'overflow': 'hidden',
							'visibility': 'hidden',
							'opacity': '0'
						});
					});
				}
				else {
					if (eltd.body.hasClass('eltd-dropdown-animate-height')) {
						var config = {
							interval: 0,
							over: function () {
								dropDownSecondDiv.addClass('eltd-drop-down-start');
								dropDownSecondDiv.css({
									'visibility': 'visible',
									'height': '0px',
								});
								dropDownSecondDiv.css('opacity', '1');
								dropDownSecondDiv.stop().animate({
									'height': $(menu_items[i]).data('original_height')
								}, 300, 'easeInOutCirc', function () {
									dropDownSecondDiv.css('overflow', 'visible');
								});
							},
							out: function () {
								dropDownSecondDiv.stop().animate({
									'height': '0px',
									'opacity': 0,
								}, 0, function () {
									dropDownSecondDiv.css({
										'overflow': 'hidden',
										'visibility': 'hidden'
									});
								});
								dropDownSecondDiv.removeClass('eltd-drop-down-start');
							}
						};
						$(menu_items[i]).hoverIntent(config);
					} else {
						var config = {
							interval: 0,
							over: function () {
								setTimeout(function () {
									dropDownSecondDiv.addClass('eltd-drop-down-start');
									dropDownSecondDiv.stop().css({ 'height': $(menu_items[i]).data('original_height') });
								}, 150);
							},
							timeout: 150,
							out: function () {
								dropDownSecondDiv.stop().css({ 'height': '0px' });
								dropDownSecondDiv.removeClass('eltd-drop-down-start');
							}
						};
						$(menu_items[i]).hoverIntent(config);
					}
				}
			}
		});

		$('.eltd-drop-down ul li.wide ul li a').on('click', function (e) {
			if (e.which == 1) {
				var $this = $(this);
				setTimeout(function () {
					$this.mouseleave();
				}, 500);
			}
		});

		eltd.menuDropdownHeightSet = true;
	}

	/**
	 * Init Search Types
	 */
	function eltdSearch() {
		var searchOpener = $('a.eltd-search-opener'),
			searchForm,
			searchClose;

		if (searchOpener.length > 0) {
			//Check for type of search
			if (eltd.body.hasClass('eltd-fullscreen-search')) {
				searchClose = $('.eltd-fullscreen-search-close');
				eltdFullscreenSearch();

			} else if (eltd.body.hasClass('eltd-slide-from-header-bottom')) {
				eltdSearchSlideFromHeaderBottom();

			} else if (eltd.body.hasClass('eltd-search-covers-header')) {
				eltdSearchCoversHeader();

			} else if (eltd.body.hasClass('eltd-search-slides-from-window-top')) {
				searchForm = $('.eltd-search-slide-window-top');
				searchClose = $('.eltd-swt-search-close');
				eltdSearchWindowTop();
			}
		}

		/**
		 * Fullscreen search fade
		 */
		function eltdFullscreenSearch() {
			var searchHolder = $('.eltd-fullscreen-search-holder');

			searchOpener.on('click', function (e) {
				e.preventDefault();

				if (searchHolder.hasClass('eltd-animate')) {
					eltd.body.removeClass('eltd-fullscreen-search-opened eltd-search-fade-out');
					eltd.body.removeClass('eltd-search-fade-in');
					searchHolder.removeClass('eltd-animate');

					setTimeout(function () {
						searchHolder.find('.eltd-search-field').val('');
						searchHolder.find('.eltd-search-field').blur();
					}, 300);

					eltd.modules.common.eltdEnableScroll();
				} else {
					eltd.body.addClass('eltd-fullscreen-search-opened eltd-search-fade-in');
					eltd.body.removeClass('eltd-search-fade-out');
					searchHolder.addClass('eltd-animate');

					setTimeout(function () {
						searchHolder.find('.eltd-search-field').focus();
					}, 900);

					eltd.modules.common.eltdDisableScroll();
				}

				searchClose.on('click', function (e) {
					e.preventDefault();
					eltd.body.removeClass('eltd-fullscreen-search-opened eltd-search-fade-in');
					eltd.body.addClass('eltd-search-fade-out');
					searchHolder.removeClass('eltd-animate');

					setTimeout(function () {
						searchHolder.find('.eltd-search-field').val('');
						searchHolder.find('.eltd-search-field').blur();
					}, 300);

					eltd.modules.common.eltdEnableScroll();
				});

				//Close on click away
				$(document).mouseup(function (e) {
					var container = $(".eltd-form-holder-inner");

					if (!container.is(e.target) && container.has(e.target).length === 0) {
						e.preventDefault();
						eltd.body.removeClass('eltd-fullscreen-search-opened eltd-search-fade-in');
						eltd.body.addClass('eltd-search-fade-out');
						searchHolder.removeClass('eltd-animate');

						setTimeout(function () {
							searchHolder.find('.eltd-search-field').val('');
							searchHolder.find('.eltd-search-field').blur();
						}, 300);

						eltd.modules.common.eltdEnableScroll();
					}
				});

				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode == 27) { //KeyCode for ESC button is 27
						eltd.body.removeClass('eltd-fullscreen-search-opened eltd-search-fade-in');
						eltd.body.addClass('eltd-search-fade-out');
						searchHolder.removeClass('eltd-animate');

						setTimeout(function () {
							searchHolder.find('.eltd-search-field').val('');
							searchHolder.find('.eltd-search-field').blur();
						}, 300);

						eltd.modules.common.eltdEnableScroll();
					}
				});
			});

			//Text input focus change
			var inputSearchField = $('.eltd-fullscreen-search-holder .eltd-search-field'),
				inputSearchLine = $('.eltd-fullscreen-search-holder .eltd-field-holder .eltd-line');

			inputSearchField.focus(function () {
				inputSearchLine.css('width', '100%');
			});

			inputSearchField.blur(function () {
				inputSearchLine.css('width', '0');
			});
		}

		/**
		 * Search covers header type of search
		 */
		function eltdSearchCoversHeader() {
			searchOpener.on('click', function (e) {
				e.preventDefault();

				var thisSearchOpener = $(this),
					searchFormHeight,
					searchFormHeaderHolder = $('.eltd-page-header'),
					searchFormTopHeaderHolder = $('.eltd-top-bar'),
					searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.eltd-fixed-wrapper.fixed'),
					searchFormMobileHeaderHolder = $('.eltd-mobile-header'),
					searchForm = $('.eltd-search-cover'),
					searchFormIsInTopHeader = !!thisSearchOpener.parents('.eltd-top-bar').length,
					searchFormIsInFixedHeader = !!thisSearchOpener.parents('.eltd-fixed-wrapper.fixed').length,
					searchFormIsInStickyHeader = !!thisSearchOpener.parents('.eltd-sticky-header').length,
					searchFormIsInMobileHeader = !!thisSearchOpener.parents('.eltd-mobile-header').length;

				searchForm.removeClass('eltd-is-active');

				//Find search form position in header and height
				if (searchFormIsInTopHeader) {
					searchFormHeight = eltdGlobalVars.vars.eltdTopBarHeight;
					searchFormTopHeaderHolder.find('.eltd-search-cover').addClass('eltd-is-active');

				} else if (searchFormIsInFixedHeader) {
					searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
					searchFormHeaderHolder.children('.eltd-search-cover').addClass('eltd-is-active');

				} else if (searchFormIsInStickyHeader) {
					searchFormHeight = eltdGlobalVars.vars.eltdStickyHeaderHeight;
					searchFormHeaderHolder.children('.eltd-search-cover').addClass('eltd-is-active');

				} else if (searchFormIsInMobileHeader) {
					if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
						searchFormHeight = searchFormMobileHeaderHolder.children('.eltd-mobile-header-inner').outerHeight();
					} else {
						searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
					}

					searchFormMobileHeaderHolder.find('.eltd-search-cover').addClass('eltd-is-active');

				} else {
					searchFormHeight = searchFormHeaderHolder.outerHeight();
					searchFormHeaderHolder.children('.eltd-search-cover').addClass('eltd-is-active');
				}

				if (searchForm.hasClass('eltd-is-active')) {
					searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
				}

				searchForm.find('.eltd-search-close').on('click', function (e) {
					e.preventDefault();
					searchForm.stop(true).fadeOut(450);
				});

				searchForm.blur(function () {
					searchForm.stop(true).fadeOut(450);
				});

				$(window).scroll(function () {
					searchForm.stop(true).fadeOut(450);
				});
			});
		}

		/**
		 * Search slides from window top type of search
		 */
		function eltdSearchWindowTop() {
			searchOpener.on('click', function (e) {
				e.preventDefault();

				if (searchForm.height() == "0") {
					$('.eltd-search-slide-window-top input[type="text"]').focus();
					//Push header bottom
					eltd.body.addClass('eltd-search-open');
				} else {
					eltd.body.removeClass('eltd-search-open');
				}

				$(window).scroll(function () {
					if (searchForm.height() != '0' && eltd.scroll > 50) {
						eltd.body.removeClass('eltd-search-open');
					}
				});

				searchClose.on('click', function (e) {
					e.preventDefault();
					eltd.body.removeClass('eltd-search-open');
				});
			});
		}

		/**
		 * Search slide from header bottom type of search
		 */
		function eltdSearchSlideFromHeaderBottom() {
			searchOpener.on('click', function (e) {
				e.preventDefault();

				var thisSearchOpener = $(this),
					searchIconPosition = parseInt(eltd.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());

				if (eltd.body.hasClass('eltd-boxed') && eltd.windowWidth > 1024) {
					searchIconPosition -= parseInt((eltd.windowWidth - $('.eltd-boxed .eltd-wrapper .eltd-wrapper-inner').outerWidth()) / 2);
				}

				var searchFormHeaderHolder = $('.eltd-page-header'),
					searchFormTopOffset = '100%',
					searchFormTopHeaderHolder = $('.eltd-top-bar'),
					searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.eltd-fixed-wrapper.fixed'),
					searchFormMobileHeaderHolder = $('.eltd-mobile-header'),
					searchForm = $('.eltd-slide-from-header-bottom-holder'),
					searchFormIsInTopHeader = !!thisSearchOpener.parents('.eltd-top-bar').length,
					searchFormIsInFixedHeader = !!thisSearchOpener.parents('.eltd-fixed-wrapper.fixed').length,
					searchFormIsInStickyHeader = !!thisSearchOpener.parents('.eltd-sticky-header').length,
					searchFormIsInMobileHeader = !!thisSearchOpener.parents('.eltd-mobile-header').length;

				searchForm.removeClass('eltd-is-active');

				//Find search form position in header and height
				if (searchFormIsInTopHeader) {
					searchFormTopHeaderHolder.find('.eltd-slide-from-header-bottom-holder').addClass('eltd-is-active');

				} else if (searchFormIsInFixedHeader) {
					searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + eltdGlobalVars.vars.eltdAddForAdminBar;;
					searchFormHeaderHolder.children('.eltd-slide-from-header-bottom-holder').addClass('eltd-is-active');

				} else if (searchFormIsInStickyHeader) {
					searchFormTopOffset = eltdGlobalVars.vars.eltdStickyHeaderHeight + eltdGlobalVars.vars.eltdAddForAdminBar;;
					searchFormHeaderHolder.children('.eltd-slide-from-header-bottom-holder').addClass('eltd-is-active');

				} else if (searchFormIsInMobileHeader) {
					if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
						searchFormTopOffset = searchFormMobileHeaderHolder.children('.eltd-mobile-header-inner').outerHeight() + eltdGlobalVars.vars.eltdAddForAdminBar;
					}
					searchFormMobileHeaderHolder.find('.eltd-slide-from-header-bottom-holder').addClass('eltd-is-active');

				} else {
					searchFormHeaderHolder.children('.eltd-slide-from-header-bottom-holder').addClass('eltd-is-active');
				}

				if (searchForm.hasClass('eltd-is-active')) {
					searchForm.css({ 'right': searchIconPosition, 'top': searchFormTopOffset }).stop(true).slideToggle(300, 'easeOutBack');
				}

				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode == 27) { //KeyCode for ESC button is 27
						searchForm.stop(true).fadeOut(0);
					}
				});

				$(window).scroll(function () {
					searchForm.stop(true).fadeOut(0);
				});
			});
		}
	}

	/**
	 * Show/hide side area
	 */
	function eltdSideArea() {

		var wrapper = $('.eltd-wrapper'),
			sideMenuButtonOpen = $('a.eltd-side-menu-button-opener'),
			cssClass = 'eltd-right-side-menu-opened';

		wrapper.prepend('<div class="eltd-cover"/>');

		$('a.eltd-side-menu-button-opener, a.eltd-close-side-menu').on('click', function (e) {
			e.preventDefault();

			if (!sideMenuButtonOpen.hasClass('opened')) {

				sideMenuButtonOpen.addClass('opened');
				eltd.body.addClass(cssClass);

				$('.eltd-wrapper .eltd-cover').on('click', function () {
					eltd.body.removeClass('eltd-right-side-menu-opened');
					sideMenuButtonOpen.removeClass('opened');
				});

				var currentScroll = $(window).scrollTop();
				$(window).scroll(function () {
					if (Math.abs(eltd.scroll - currentScroll) > 400) {
						eltd.body.removeClass(cssClass);
						sideMenuButtonOpen.removeClass('opened');
					}
				});
			} else {
				sideMenuButtonOpen.removeClass('opened');
				eltd.body.removeClass(cssClass);
			}
		});
	}

	/*
	 **  Smooth scroll functionality for Side Area
	 */
	function eltdSideAreaScroll() {
		var sideMenu = $('.eltd-side-menu');

		if (sideMenu.length) {
			sideMenu.niceScroll({
				scrollspeed: 60,
				mousescrollstep: 40,
				cursorwidth: 0,
				cursorborder: 0,
				cursorborderradius: 0,
				cursorcolor: "transparent",
				autohidemode: false,
				horizrailenabled: false
			});
		}
	}

})(jQuery);
(function ($) {
    "use strict";

    var headerDivided = {};
    eltd.modules.headerDivided = headerDivided;

    headerDivided.eltdOnDocumentReady = eltdOnDocumentReady;
    headerDivided.eltdOnWindowLoad = eltdOnWindowLoad;
    headerDivided.eltdOnWindowResize = eltdOnWindowResize;
    headerDivided.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
        eltdInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }

    /**
     * Init Divided Header Menu
     */
    function eltdInitDividedHeaderMenu() {
        if (eltd.body.hasClass('eltd-header-divided')) {
            //get left side menu width
            var menuArea = $('.eltd-menu-area'),
                menuAreaWidth = menuArea.width(),
                menuAreaItem = $('.eltd-main-menu > ul > li > a'),
                menuItemPadding = 0,
                logoArea = menuArea.find('.eltd-logo-wrapper .eltd-normal-logo'),
                logoAreaWidth = 0;

            if (menuArea.children('.eltd-grid').length) {
                menuAreaWidth = menuArea.children('.eltd-grid').outerWidth();
            }

            if (menuAreaItem.length) {
                menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
            }

            if (logoArea.length) {
                logoAreaWidth = logoArea.width() / 2;
            }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth / 2 - menuItemPadding - logoAreaWidth);

            $('.eltd-menu-area .eltd-position-left').width(menuAreaLeftRightSideWidth);
            $('.eltd-menu-area .eltd-position-right').width(menuAreaLeftRightSideWidth);

            menuArea.css('opacity', 1);

            if (typeof eltd.modules.header.eltdDropDownMenu === "function") {
                eltd.modules.header.eltdDropDownMenu();
            }
            if (typeof eltd.modules.header.eltdSetDropDownMenuPosition === "function") {
                eltd.modules.header.eltdSetDropDownMenuPosition();
            }
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var headerMinimal = {};
    eltd.modules.headerMinimal = headerMinimal;

    headerMinimal.eltdOnDocumentReady = eltdOnDocumentReady;
    headerMinimal.eltdOnWindowLoad = eltdOnWindowLoad;
    headerMinimal.eltdOnWindowResize = eltdOnWindowResize;
    headerMinimal.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdFullscreenMenu();
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }

    /**
     * Init Fullscreen Menu
     */
    function eltdFullscreenMenu() {
        var popupMenuOpener = $('a.eltd-fullscreen-menu-opener');

        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".eltd-fullscreen-menu-holder-outer"),
                cssClass,
                //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
                //Widgets
                widgetAboveNav = $('.eltd-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.eltd-fullscreen-below-menu-widget-holder'),
                //Menu
                menuItems = $('.eltd-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild = $('.eltd-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.eltd-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(eltd.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function () {
                popupMenuHolderOuter.height(eltd.windowHeight);
            });

            if (eltd.body.hasClass('eltd-fade-push-text-right')) {
                cssClass = 'eltd-push-nav-right';
                fadeRight = true;
            } else if (eltd.body.hasClass('eltd-fade-push-text-top')) {
                cssClass = 'eltd-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay': 0 + 'ms',
                        '-moz-animation-delay': 0 + 'ms',
                        'animation-delay': 0 + 'ms'
                    });
                }
                menuItems.each(function (i) {
                    $(this).css({
                        '-webkit-animation-delay': (i + 1) * 70 + 'ms',
                        '-moz-animation-delay': (i + 1) * 70 + 'ms',
                        'animation-delay': (i + 1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay': (menuItems.length + 1) * 70 + 'ms',
                        '-moz-animation-delay': (menuItems.length + 1) * 70 + 'ms',
                        'animation-delay': (menuItems.length + 1) * 70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click', function (e) {
                e.preventDefault();

                if (!popupMenuOpener.hasClass('eltd-fm-opened')) {
                    popupMenuOpener.addClass('eltd-fm-opened');
                    eltd.body.addClass('eltd-fullscreen-menu-opened');
                    eltd.body.removeClass('eltd-fullscreen-fade-out').addClass('eltd-fullscreen-fade-in');
                    eltd.body.removeClass(cssClass);
                    if (!eltd.body.hasClass('page-template-full_screen-php')) {
                        eltd.modules.common.eltdDisableScroll();
                    }
                    $(document).keyup(function (e) {
                        if (e.keyCode == 27) {
                            popupMenuOpener.removeClass('eltd-fm-opened');
                            eltd.body.removeClass('eltd-fullscreen-menu-opened');
                            eltd.body.removeClass('eltd-fullscreen-fade-in').addClass('eltd-fullscreen-fade-out');
                            eltd.body.addClass(cssClass);
                            if (!eltd.body.hasClass('page-template-full_screen-php')) {
                                eltd.modules.common.eltdEnableScroll();
                            }
                            $("nav.eltd-fullscreen-menu ul.sub_menu").slideUp(200, function () {
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('eltd-fm-opened');
                    eltd.body.removeClass('eltd-fullscreen-menu-opened');
                    eltd.body.removeClass('eltd-fullscreen-fade-in').addClass('eltd-fullscreen-fade-out');
                    eltd.body.addClass(cssClass);
                    if (!eltd.body.hasClass('page-template-full_screen-php')) {
                        eltd.modules.common.eltdEnableScroll();
                    }
                    $("nav.eltd-fullscreen-menu ul.sub_menu").slideUp(200, function () {
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function (e) {
                e.preventDefault();

                var thisItem = $(this),
                    thisItemParent = thisItem.parent();

                if (thisItemParent.hasClass('has_sub')) {

                    var submenu = thisItemParent.find('> ul.sub_menu');

                    if (submenu.is(':visible')) {
                        submenu.slideUp(450, 'easeInOutQuint', function () {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                        thisItemParent.removeClass('open_sub');
                    } else {
                        thisItemParent.addClass('open_sub');
                        if (thisItemParent.siblings().hasClass('open_sub')) {
                            thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
                                popupMenuHolderOuter.getNiceScroll().resize();
                                submenu.slideDown(400, 'easeInOutQuint', function () {
                                    popupMenuHolderOuter.getNiceScroll().resize();
                                });
                            });
                        } else {
                            submenu.slideDown(400, 'easeInOutQuint', function () {
                                popupMenuHolderOuter.getNiceScroll().resize();
                            });
                        }
                    }
                }

                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {
                if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {
                    if (e.which == 1) {
                        popupMenuOpener.removeClass('eltd-fm-opened');
                        eltd.body.removeClass('eltd-fullscreen-menu-opened');
                        eltd.body.removeClass('eltd-fullscreen-fade-in').addClass('eltd-fullscreen-fade-out');
                        eltd.body.addClass(cssClass);
                        $("nav.eltd-fullscreen-menu ul.sub_menu").slideUp(200, function () {
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        eltd.modules.common.eltdEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var headerTabbed = {};
    eltd.modules.headerTabbed = headerTabbed;

    headerTabbed.eltdInitTabbedHeaderMenu = eltdInitTabbedHeaderMenu;

    headerTabbed.eltdOnDocumentReady = eltdOnDocumentReady;
    headerTabbed.eltdOnWindowLoad = eltdOnWindowLoad;
    headerTabbed.eltdOnWindowResize = eltdOnWindowResize;
    headerTabbed.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitTabbedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdInitTabbedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }

    /**
     * Init Tabbed Header Menu
     */
    function eltdInitTabbedHeaderMenu() {
        if (eltd.body.hasClass('eltd-header-tabbed')) {
            var centerHeaderArea = $('.eltd-position-center'),
                leftHeaderAreaWidth = $('.eltd-position-left').width(),
                rightHeaderAreaWidth = $('.eltd-position-right').width(),
                headerAreaPadding = 40; //20px on both side of header

            centerHeaderArea.width(eltd.windowWidth - leftHeaderAreaWidth - rightHeaderAreaWidth - headerAreaPadding);
            centerHeaderArea.css('opacity', 1);
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var headerVertical = {};
    eltd.modules.headerVertical = headerVertical;

    headerVertical.eltdOnDocumentReady = eltdOnDocumentReady;
    headerVertical.eltdOnWindowLoad = eltdOnWindowLoad;
    headerVertical.eltdOnWindowResize = eltdOnWindowResize;
    headerVertical.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdVerticalMenu().init();
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var eltdVerticalMenu = function () {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.eltd-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        var resizeVerticalArea = function () {
            if (verticalAreaScrollable()) {
                verticalMenuObject.getNiceScroll().resize();
            }
        };

        /**
         * Checks if vertical area is scrollable (if it has eltd-with-scroll class)
         *
         * @returns {bool}
         */
        var verticalAreaScrollable = function () {
            return verticalMenuObject.hasClass('.eltd-with-scroll');
        };

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function () {
            var verticalNavObject = verticalMenuObject.find('.eltd-vertical-menu');

            dropdownClickToggle();

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            function dropdownClickToggle() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');

                menuItems.each(function () {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;
                    var dropdownOpener = $(this).find('> a');
                    var slideUpSpeed = 'fast';
                    var slideDownSpeed = 'slow';

                    dropdownOpener.on('click tap', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (elementToExpand.is(':visible')) {
                            $(menuItem).removeClass('open');
                            elementToExpand.slideUp(slideUpSpeed, function () {
                                resizeVerticalArea();
                            });
                        } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('eltd-vertical-menu')) {
                            $(this).parent().parent().children().removeClass('open');
                            $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);

                            $(menuItem).addClass('open');
                            elementToExpand.slideDown(slideDownSpeed, function () {
                                resizeVerticalArea();
                            });
                        } else {

                            if (!$(this).parents('li').hasClass('open')) {
                                menuItems.removeClass('open');
                                menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
                            }

                            if ($(this).parent().parent().children().hasClass('open')) {
                                $(this).parent().parent().children().removeClass('open');
                                $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
                            }

                            $(menuItem).addClass('open');
                            elementToExpand.slideDown(slideDownSpeed, function () {
                                resizeVerticalArea();
                            });
                        }
                    });
                });
            }
        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function () {
            if (verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 40,
                    cursorwidth: 0,
                    cursorborder: 0,
                    cursorborderradius: 0,
                    cursorcolor: "transparent",
                    autohidemode: false,
                    horizrailenabled: false
                });
            }
        };

        var initHiddenVerticalArea = function () {
            var verticalLogo = $('.eltd-vertical-area-bottom-logo');
            var verticalMenuOpener = verticalMenuObject.find('.eltd-vertical-area-opener');
            var scrollPosition = 0;

            verticalMenuOpener.on('click tap', function () {
                if (isVerticalAreaOpen()) {
                    closeVerticalArea();
                } else {
                    openVerticalArea();
                }
            });

            $(window).scroll(function () {
                if (Math.abs($(window).scrollTop() - scrollPosition) > 400) {
                    closeVerticalArea();
                }
            });

            /**
             * Closes vertical menu area by removing 'active' class on that element
             */
            function closeVerticalArea() {
                verticalMenuObject.removeClass('active');

                if (verticalLogo.length) {
                    verticalLogo.removeClass('active');
                }
            }

            /**
             * Opens vertical menu area by adding 'active' class on that element
             */
            function openVerticalArea() {
                verticalMenuObject.addClass('active');

                if (verticalLogo.length) {
                    verticalLogo.addClass('active');
                }
                scrollPosition = $(window).scrollTop();
            }

            function isVerticalAreaOpen() {
                return verticalMenuObject.hasClass('active');
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function () {
                if (verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();

                    if (eltd.body.hasClass('eltd-header-vertical-closed')) {
                        initHiddenVerticalArea();
                    }
                }
            }
        };
    };

})(jQuery);
(function ($) {
    "use strict";

    var stickyHeader = {};
    eltd.modules.stickyHeader = stickyHeader;

    stickyHeader.isStickyVisible = false;
    stickyHeader.stickyAppearAmount = 0;
    stickyHeader.behaviour = '';

    stickyHeader.eltdOnDocumentReady = eltdOnDocumentReady;
    stickyHeader.eltdOnWindowLoad = eltdOnWindowLoad;
    stickyHeader.eltdOnWindowResize = eltdOnWindowResize;
    stickyHeader.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        if (eltd.windowWidth > 1024) {
            eltdHeaderBehaviour();
        }
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function eltdHeaderBehaviour() {
        var header = $('.eltd-page-header'),
            stickyHeader = $('.eltd-sticky-header'),
            fixedHeaderWrapper = $('.eltd-fixed-wrapper'),
            sliderHolder = $('.eltd-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
            stickyAppearAmount,
            headerAppear;

        var headerMenuAreaOffset = $('.eltd-page-header').find('.eltd-fixed-wrapper').length ? $('.eltd-page-header').find('.eltd-fixed-wrapper').offset().top - eltdGlobalVars.vars.eltdAddForAdminBar : 0;

        switch (true) {
            // sticky header that will be shown when user scrolls up
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-up'):
                eltd.modules.stickyHeader.behaviour = 'eltd-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = eltdGlobalVars.vars.eltdTopBarHeight + eltdGlobalVars.vars.eltdLogoAreaHeight + eltdGlobalVars.vars.eltdMenuAreaHeight + eltdGlobalVars.vars.eltdStickyHeaderHeight;

                headerAppear = function () {
                    var docYScroll2 = $(document).scrollTop();

                    if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        eltd.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                        eltd.body.removeClass('eltd-sticky-header-appear');
                    } else {
                        eltd.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                        eltd.body.addClass('eltd-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case eltd.body.hasClass('eltd-sticky-header-on-scroll-down-up'):
                eltd.modules.stickyHeader.behaviour = 'eltd-sticky-header-on-scroll-down-up';

                if (eltdPerPageVars.vars.eltdStickyScrollAmount !== 0) {
                    eltd.modules.stickyHeader.stickyAppearAmount = parseInt(eltdPerPageVars.vars.eltdStickyScrollAmount);
                } else {
                    eltd.modules.stickyHeader.stickyAppearAmount = parseInt(eltdGlobalVars.vars.eltdTopBarHeight) + parseInt(eltdGlobalVars.vars.eltdLogoAreaHeight) + parseInt(eltdGlobalVars.vars.eltdMenuAreaHeight) + parseInt(revSliderHeight);
                }


                headerAppear = function () {
                    if (eltd.scroll < eltd.modules.stickyHeader.stickyAppearAmount) {
                        eltd.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.eltd-main-menu .second').removeClass('eltd-drop-down-start');
                        eltd.body.removeClass('eltd-sticky-header-appear');
                    } else {
                        eltd.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                        eltd.body.addClass('eltd-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case eltd.body.hasClass('eltd-fixed-on-scroll'):
                eltd.modules.stickyHeader.behaviour = 'eltd-fixed-on-scroll';
                var headerFixed = function () {

                    if (eltd.scroll <= headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        eltd.body.removeClass('eltd-fixed-header-appear');
                        header.css('margin-bottom', '0');
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        eltd.body.addClass('eltd-fixed-header-appear');
                        header.css('margin-bottom', fixedHeaderWrapper.outerHeight());
                    }
                };

                headerFixed();

                $(window).scroll(function () {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var mobileHeader = {};
    eltd.modules.mobileHeader = mobileHeader;

    mobileHeader.eltdOnDocumentReady = eltdOnDocumentReady;
    mobileHeader.eltdOnWindowLoad = eltdOnWindowLoad;
    mobileHeader.eltdOnWindowResize = eltdOnWindowResize;
    mobileHeader.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitMobileNavigation();
        eltdMobileHeaderBehavior();
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {
    }

    function eltdInitMobileNavigation() {
        var navigationOpener = $('.eltd-mobile-header .eltd-mobile-menu-opener');
        var navigationHolder = $('.eltd-mobile-header .eltd-mobile-nav');
        var dropdownOpener = $('.eltd-mobile-nav .mobile_arrow, .eltd-mobile-nav h6, .eltd-mobile-nav a.eltd-mobile-no-link');
        var animationSpeed = 200;


        //whole mobile menu opening / closing
        if (navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function (e) {

                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if (dropdownOpener.length) {
            dropdownOpener.each(function () {
                $(this).on('tap click', function (e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if (dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if (dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('eltd-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('eltd-opened');
                        }
                    }
                });
            });
        }

        $('.eltd-mobile-nav a, .eltd-mobile-logo-wrapper a').on('click tap', function (e) {
            if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function eltdMobileHeaderBehavior() {
        if (eltd.body.hasClass('eltd-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                mobileHeader = $('.eltd-mobile-header'),
                mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
                adminBar = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + eltdGlobalVars.vars.eltdAddForAdminBar;

            $(window).scroll(function () {
                var docYScroll2 = $(document).scrollTop();

                if (docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('eltd-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('eltd-animate-mobile-header');
                }

                if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if (adminBar.length) {
                        mobileHeader.find('.eltd-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

})(jQuery);
(function ($) {
    "use strict";

    var title = {};
    eltd.modules.title = title;

    title.eltdOnDocumentReady = eltdOnDocumentReady;
    title.eltdOnWindowLoad = eltdOnWindowLoad;
    title.eltdOnWindowResize = eltdOnWindowResize;
    title.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        initTitleFullHeight();
        eltdParallaxTitle();
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        initTitleFullHeight();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {

    }

    /*
     **	Title image with parallax effect
     */
    function eltdParallaxTitle() {
        var parallaxBackground = $('.eltd-title.eltd-has-parallax-background');

        if (parallaxBackground.length > 0 && $('.touch').length === 0) {
            var parallaxBackgroundWithZoomOut = $('.eltd-title.eltd-has-parallax-background.eltd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(eltd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({ 'background-position': 'center ' + (titleYPos + eltdGlobalVars.vars.eltdAddForAdminBar) + 'px' });
            parallaxBackground.css({ 'background-size': backgroundSizeWidth - eltd.scroll + 'px auto' });

            //set position of background on window scroll
            $(window).scroll(function () {
                titleYPos = -(eltd.scroll * titleRate);
                parallaxBackground.css({ 'background-position': 'center ' + (titleYPos + eltdGlobalVars.vars.eltdAddForAdminBar) + 'px' });
                parallaxBackground.css({ 'background-size': backgroundSizeWidth - eltd.scroll + 'px auto' });
            });
        }
    }

    function initTitleFullHeight() {
        var title = $('.eltd-title');

        if (title.length > 0 && title.hasClass('eltd-title-full-height')) {
            var titleHolder = title.find('.eltd-title-holder');
            var titleMargin = parseInt($('.eltd-content').css('margin-top'));
            var titleHolderPadding = parseInt(titleHolder.css('padding-top'));
            if (eltd.windowWidth > 1024) {
                if (titleMargin < 0) {
                    title.css("height", eltd.windowHeight);
                    title.attr("data-height", eltd.windowHeight);
                    titleHolder.css("height", eltd.windowHeight);
                    if (titleHolderPadding > 0) {
                        titleHolder.css("height", eltd.windowHeight - eltdGlobalVars.vars.eltdMenuAreaHeight);
                    }
                } else {
                    title.css("height", eltd.windowHeight - eltdGlobalVars.vars.eltdMenuAreaHeight);
                    title.attr("data-height", eltd.windowHeight - eltdGlobalVars.vars.eltdMenuAreaHeight);
                    titleHolder.css("height", eltd.windowHeight - eltdGlobalVars.vars.eltdMenuAreaHeight);
                }
            } else {
                title.css("height", eltd.windowHeight - eltdGlobalVars.vars.eltdMobileHeaderHeight);
                title.attr("data-height", eltd.windowHeight - eltdGlobalVars.vars.eltdMobileHeaderHeight);
                titleHolder.css("height", eltd.windowHeight - eltdGlobalVars.vars.eltdMobileHeaderHeight);
            }
        }
    }

})(jQuery);

(function($) {
    'use strict';

    var like = {};
    
    like.eltdOnDocumentReady = eltdOnDocumentReady;

    $(document).ready(eltdOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function eltdOnDocumentReady() {
        eltdLikes();
    }

    function eltdLikes() {
        $(document).on('click','.eltd-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                type;

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }

            var dataToPass = {
                action: 'findme_elated_like',
                likes_id: id,
                type: type
            };

            var like = $.post(eltdGlobalVars.vars.eltdAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	eltd.modules.accordions = accordions;
	
	accordions.eltdInitAccordions = eltdInitAccordions;
	
	
	accordions.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function eltdInitAccordions(){
		var accordion = $('.eltd-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('eltd-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('eltd-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.eltd-title-holder'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('mouseenter mouseleave',function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	eltd.modules.animationHolder = animationHolder;
	
	animationHolder.eltdInitAnimationHolder = eltdInitAnimationHolder;
	
	
	animationHolder.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function eltdInitAnimationHolder(){
		var elements = $('.eltd-grow-in, .eltd-fade-in-down, .eltd-element-from-fade, .eltd-element-from-left, .eltd-element-from-right, .eltd-element-from-top, .eltd-element-from-bottom, .eltd-flip-in, .eltd-x-rotate, .eltd-z-rotate, .eltd-y-translate, .eltd-fade-in, .eltd-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	eltd.modules.button = button;
	
	button.eltdButton = eltdButton;
	
	
	button.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var eltdButton = function() {
		//all buttons on the page
		var buttons = $('.eltd-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};

                var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');

				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};

        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonIconHoverBgColor = function(button) {
            if(typeof button.data('icon-bck-hover-color') !== 'undefined') {
                var changeButtonIconBg = function(event) {
                    event.data.button.find('.eltd-btn-icon-html').css('background-color', event.data.color);
                };

                var originalBgColor = button.find('.eltd-btn-icon-html').css('background-color');
                var hoverBgColor = button.data('icon-bck-hover-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonIconBg);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonIconBg);
            }
        };

        /**
         * Initializes button icon hover  color
         * @param button current button
         */
        var buttonIconHoverColor = function(button) {
            if(typeof button.data('icon-hover-color') !== 'undefined') {
                var changeButtonIcon = function(event) {
                    event.data.button.find('.eltd-btn-icon-html').css('color', event.data.color);
                };

                var originalBgColor = button.find('.eltd-btn-icon-html').css('color');
                var hoverBgColor = button.data('icon-hover-color');

                button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonIcon);
                button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonIcon);
            }
        };

		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
                        buttonIconHoverBgColor($(this));
                        buttonIconHoverColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	eltd.modules.countdown = countdown;
	
	countdown.eltdInitCountdown = eltdInitCountdown;
	
	
	countdown.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function eltdInitCountdown() {
		var countdowns = $('.eltd-countdown'),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month - 1, day, hour, minute, 44),
					labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	eltd.modules.counter = counter;
	
	counter.eltdInitCounter = eltdInitCounter;
	
	
	counter.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function eltdInitCounter() {
		var counterHolder = $('.eltd-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.eltd-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('eltd-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var customFont = {};
	eltd.modules.customFont = customFont;
	
	customFont.eltdCustomFontResize = eltdCustomFontResize;
	
	
	customFont.eltdOnDocumentReady = eltdOnDocumentReady;
	customFont.eltdOnWindowResize = eltdOnWindowResize;
	
	$(document).ready(eltdOnDocumentReady);
	$(window).resize(eltdOnWindowResize);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdCustomFontResize();
	}
	
	/* 
	 All functions to be called on $(window).resize() should be in this function
	 */
	function eltdOnWindowResize() {
		eltdCustomFontResize();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function eltdCustomFontResize(){
		var holder = $('.eltd-custom-font-holder');
		
		if(holder.length){
			holder.each(function() {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
					
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1280') !== 'undefined' && thisItem.data('font-size-1280') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1280') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1280') !== 'undefined' && thisItem.data('line-height-1280') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1280') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if(smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if(smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1280px) {.eltd-custom-font-holder."+itemClass+" { " + smallLaptopStyle + " } }";
					}
					if(ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.eltd-custom-font-holder."+itemClass+" { " + ipadLandscapeStyle + " } }";
					}
					if(ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.eltd-custom-font-holder."+itemClass+" { " + ipadPortraitStyle + " } }";
					}
					if(mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.eltd-custom-font-holder."+itemClass+" { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	eltd.modules.elementsHolder = elementsHolder;
	
	elementsHolder.eltdInitElementsHolderResponsiveStyle = eltdInitElementsHolderResponsiveStyle;
	
	
	elementsHolder.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitElementsHolderResponsiveStyle();
	}
	
	/*
	 **	Elements Holder responsive style
	 */
	function eltdInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.eltd-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.eltd-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';
					
					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
						ipadPortrait = thisItem.data('600-768');
					}
					if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
						mobileLandscape = thisItem.data('480-600');
					}
					if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
						mobilePortrait = thisItem.data('480');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1600px) {.eltd-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.eltd-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.eltd-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.eltd-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.eltd-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
						if(mobilePortrait.length) {
							responsiveStyle += "@media only screen and (max-width: 480px) {.eltd-eh-item-content."+itemClass+" { padding: "+mobilePortrait+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css" data-type="findme_elated_shortcodes_custom_css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var fullscreenObjects = {};
    eltd.modules.fullscreenObjects = fullscreenObjects;


    fullscreenObjects.eltdOnDocumentReady = eltdOnDocumentReady;

    $(document).ready(eltdOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdOnDocumentReady() {
        fullscreenObjectsSlider();
    }

    /*
     **	Fullscreen Objects slider
     */
    function fullscreenObjectsSlider() {
        var swipers = $('.swiper-container.eltd-fullscreen-objects');

        if (swipers.length) {
            swipers.each(function () {
                var swiper = $(this);

                var mouseWheelControl = swiper.data('mouse-wheel-control') == 'yes' ? true : false;
                var activeSlide = swiper.find('.eltd-swiper-active-slide');
                var allSlides = swiper.find('.eltd-swiper-all-slides');

                var swiperSlider = new Swiper(swiper, {
                    loop: true,
                    parallax: true,
                    speed: 1000,
                    autoplay: 3000,
                    mousewheelControl: mouseWheelControl,
                    nextButton: '.eltd-swiper-button-next',
                    prevButton: '.eltd-swiper-button-prev',
                    onSlideChangeEnd: function (mySwiper) {
                        var activeIndex = mySwiper.realIndex + 1;

                        activeSlide.html(activeIndex < 10 ? '0' + activeIndex : activeIndex);
                    }
                });
            });
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	eltd.modules.googleMap = googleMap;
	
	googleMap.eltdShowGoogleMap = eltdShowGoogleMap;
	
	
	googleMap.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function eltdShowGoogleMap(){
		var googleMap = $('.eltd-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);

                var predefinedStyle = false;
                if(typeof element.data('predefined-style') !== 'undefined' && element.data('predefined-style') === 'yes') {
                    predefinedStyle = true;
                }
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "eltd-map-"+ uniqueId;
				
				eltdInitializeGoogleMap(predefinedStyle, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function eltdInitializeGoogleMap(predefinedStyle, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

        var mapStyles = [];
        if(predefinedStyle) {
            mapStyles = [
                    {
                        "featureType": "landscape.natural",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "on"
                            },
                            {
                                "color": "#e0efef"
                            }
                        ]
                    },
                        {
                            "featureType": "poi",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "hue": "#1900ff"
                                },
                                {
                                    "color": "#c0e8e8"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "lightness": 100
                                },
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "lightness": 700
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#7dcdcd"
                                }
                            ]
                        }
            ];
        } else {
            mapStyles = [
                {
                    stylers: [
                        {hue: color },
                        {saturation: saturation},
                        {lightness: lightness},
                        {gamma: 1}
                    ]
                }
            ];
        }
		
		var googleMapStyleId;

        if(predefinedStyle || customMapStyle === 'yes'){
            googleMapStyleId = 'eltd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }
		
		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Elated Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'eltd-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		if (typeof google === 'object') {
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('eltd-style', qoogleMapType);
		}
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			eltdInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function eltdInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	eltd.modules.icon = icon;
	
	icon.eltdIcon = eltdIcon;
	
	
	icon.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdIcon = function() {
		var icons = $('.eltd-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('eltd-icon-animation')) {
				icon.appear(function() {
					icon.parent('.eltd-icon-animation-holder').addClass('eltd-icon-animation-show');
				}, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.eltd-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('border-color');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	eltd.modules.iconListItem = iconListItem;
	
	iconListItem.eltdInitIconList = eltdInitIconList;
	
	
	iconListItem.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var eltdInitIconList = function() {
		var iconList = $('.eltd-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('eltd-appeared');
				},{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var itemShowcase = {};
	eltd.modules.itemShowcase = itemShowcase;
	
	itemShowcase.eltdInitItemShowcase = eltdInitItemShowcase;
	
	
	itemShowcase.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitItemShowcase();
	}
	
	/**
	 * Init item showcase shortcode
	 */
	function eltdInitItemShowcase() {
		var itemShowcase = $('.eltd-item-showcase-holder');
		
		if (itemShowcase.length) {
			itemShowcase.each(function(){
				var thisItemShowcase = $(this),
					leftItems = thisItemShowcase.find('.eltd-is-left'),
					rightItems = thisItemShowcase.find('.eltd-is-right'),
					itemImage = thisItemShowcase.find('.eltd-is-image');
				
				//logic
				leftItems.wrapAll( "<div class='eltd-is-item-holder eltd-is-left-holder' />");
				rightItems.wrapAll( "<div class='eltd-is-item-holder eltd-is-right-holder' />");
				thisItemShowcase.animate({opacity:1},200);
				
				setTimeout(function(){
					thisItemShowcase.appear(function(){
						itemImage.addClass('eltd-appeared');
						thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
							function(e) {
								if(eltd.windowWidth > 1200) {
									itemAppear('.eltd-is-left-holder .eltd-is-item');
									itemAppear('.eltd-is-right-holder .eltd-is-item');
								} else {
									itemAppear('.eltd-is-item');
								}
							});
					},{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
				},100);
				
				//appear animation trigger
				function itemAppear(itemCSSClass) {
					thisItemShowcase.find(itemCSSClass).each(function(i){
						var thisListItem = $(this);
						setTimeout(function(){
							thisListItem.addClass('eltd-appeared');
						}, i*150);
					});
				}
			});
		}
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var pieChart = {};
	eltd.modules.pieChart = pieChart;
	
	pieChart.eltdInitPieChart = eltdInitPieChart;
	
	
	pieChart.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function eltdInitPieChart() {
		var pieChartHolder = $('.eltd-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.eltd-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.eltd-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	eltd.modules.progressBar = progressBar;
	
	progressBar.eltdInitProgressBars = eltdInitProgressBars;
	
	
	progressBar.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function eltdInitProgressBars(){
		var progressBar = $('.eltd-progress-bar');
		
		if(progressBar.length){
			progressBar.each(function() {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.eltd-pb-content'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function() {
					eltdInitToCounterProgressBar(thisBar, percentage);
					
					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function eltdInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.eltd-pb-percent');
		
		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
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
(function($) {
    'use strict';

    var stackedImages = {};
    eltd.modules.stackedImages = stackedImages;

    stackedImages.eltdInitStackedImages = eltdInitStackedImages;


    stackedImages.eltdOnDocumentReady = eltdOnDocumentReady;

    $(document).ready(eltdOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
    function eltdOnDocumentReady() {
        eltdInitStackedImages();
    }

    /**
     * Init Stacked Images shortcode
     */
    function eltdInitStackedImages() {
        var stackedImages = $('.eltd-stacked-images-holder');

        if (stackedImages.length) {
            stackedImages.each(function(){
                var stackedImagesShortcode = $(this),
                    switchImagesHolder = stackedImagesShortcode.find('.eltd-si-switch-images'),
                    images = switchImagesHolder.find('img');

                stackedImagesShortcode.appear(function(){
                    stackedImagesShortcode.waitForImages(function(){
                        stackedImagesShortcode.addClass('eltd-appeared');       
                        setTimeout(function(){
                            stackedImagesShortcode.addClass('eltd-animated');
                        }, 850);
                    });

                    images.each(function(){
                        var image = $(this);

                        //ready for animating
                        image.one(eltd.transitionEnd, function() {
                            image.addClass('eltd-idle');
                        });

                        image.on('click',function(){
                            image.addClass('eltd-removing');
                            image.one(eltd.transitionEnd, function() {
                                //remove and reposition
                                image.detach();
                                image.siblings().addClass('eltd-repositioning');
                                //attach
                                image.appendTo(switchImagesHolder);
                                //reset
                                setTimeout(function(){
                                    image.siblings().removeClass('eltd-repositioning');
                                    image.removeClass('eltd-removing').addClass('eltd-adding');
                                    image.one(eltd.transitionEnd, function() {
                                        image.removeClass('eltd-adding');
                                    });
                                }, 100);
                            });
                        });
                    });
                }, {accX: 0, accY: eltdGlobalVars.vars.eltdElementAppearAmount});
            });
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	eltd.modules.tabs = tabs;
	
	tabs.eltdInitTabs = eltdInitTabs;
	
	
	tabs.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function eltdInitTabs(){
		var tabs = $('.eltd-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.eltd-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.eltd-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var verticalSplitSlider = {};
	eltd.modules.verticalSplitSlider = verticalSplitSlider;
	
	verticalSplitSlider.eltdInitVerticalSplitSlider = eltdInitVerticalSplitSlider;
	
	
	verticalSplitSlider.eltdOnDocumentReady = eltdOnDocumentReady;
	
	$(document).ready(eltdOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitVerticalSplitSlider();
	}
	
	/*
	 **	Vertical Split Slider
	 */
	function eltdInitVerticalSplitSlider() {
		var slider = $('.eltd-vertical-split-slider');
		
		if (slider.length) {
			if (eltd.body.hasClass('eltd-vss-initialized')) {
				eltd.body.removeClass('eltd-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(eltd.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (eltd.body.hasClass('eltd-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (eltd.body.hasClass('eltd-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.eltd-vss-ms-section',
				leftSelector: '.eltd-vss-ms-left',
				rightSelector: '.eltd-vss-ms-right',
				afterRender: function () {
					eltdCheckVerticalSplitSectionsForHeaderStyle($('.eltd-vss-ms-left .eltd-vss-ms-section:last-child').data('header-style'), defaultHeaderStyle);
					eltd.body.addClass('eltd-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
                        if(contactForm7.length) {

                          contactForm7.each(function(){
                           var thisForm = $(this);

                           thisForm.find('.wpcf7-submit').off().on('click', function(e){
                            e.preventDefault();
                            wpcf7.submit(thisForm);
                           });
                          });
                    } // this function need to be initialized after initVerticalSplitSlide
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="eltd-vss-responsive"></div>'),
						leftSide = slider.find('.eltd-vss-ms-left > div'),
						rightSide = slider.find('.eltd-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.eltd-vss-responsive .eltd-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'eltd-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof eltd.modules.button.eltdButton === "function") {
						eltd.modules.button.eltdButton().init();
					}
					
					if (typeof eltd.modules.elementsHolder.eltdInitElementsHolderResponsiveStyle === "function") {
						eltd.modules.elementsHolder.eltdInitElementsHolderResponsiveStyle();
					}
					
					if (typeof eltd.modules.googleMap.eltdShowGoogleMap === "function") {
						eltd.modules.googleMap.eltdShowGoogleMap();
					}
					
					if (typeof eltd.modules.icon.eltdIcon === "function") {
						eltd.modules.icon.eltdIcon().init();
					}
					
					if (typeof eltd.modules.progressBar.eltdInitProgressBars === "function") {
						eltd.modules.progressBar.eltdInitProgressBars();
					}
				},
				onLeave: function (index, nextIndex, direction) {
					eltdCheckVerticalSplitSectionsForHeaderStyle($($('.eltd-vss-ms-left .eltd-vss-ms-section')[$(".eltd-vss-ms-left .eltd-vss-ms-section").length - nextIndex]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (eltd.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (eltd.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function eltdCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			eltd.body.removeClass('eltd-light-header eltd-dark-header').addClass('eltd-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			eltd.body.removeClass('eltd-light-header eltd-dark-header').addClass('eltd-' + default_header_style + '-header');
		} else {
			eltd.body.removeClass('eltd-light-header eltd-dark-header');
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var portfolio = {};
    eltd.modules.portfolio = portfolio;

    portfolio.eltdOnDocumentReady = eltdOnDocumentReady;
    portfolio.eltdOnWindowLoad = eltdOnWindowLoad;
    portfolio.eltdOnWindowResize = eltdOnWindowResize;
    portfolio.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdOnDocumentReady() {
    }

    /*
     All functions to be called on $(window).on('load', ) should be in this function
     */
    function eltdOnWindowLoad() {
        eltdInitPortfolioMasonry();
        eltdInitPortfolioFilter();
        initPortfolioSingleMasonry();
        eltdInitPortfolioListAnimation();
        eltdInitPortfolioPagination().init();
        eltdPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function eltdOnWindowResize() {
        eltdInitPortfolioMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function eltdOnWindowScroll() {
        eltdInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function eltdInitPortfolioListAnimation() {
        var portList = $('.eltd-portfolio-list-holder.eltd-pl-has-animation');

        if (portList.length) {
            portList.each(function () {
                var thisPortList = $(this).children('.eltd-pl-inner');

                thisPortList.children('article').each(function (l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function () {
                        thisArticle.addClass('eltd-item-show');

                        setTimeout(function () {
                            thisArticle.addClass('eltd-item-shown');
                        }, 1000);
                    }, { accX: 0, accY: 0 });
                });
            });
        }
    }

    /**
     * Initializes portfolio list
     */
    function eltdInitPortfolioMasonry() {
        var portList = $('.eltd-portfolio-list-holder.eltd-pl-masonry');

        if (portList.length) {
            portList.each(function () {
                var thisPortList = $(this),
                    masonry = thisPortList.children('.eltd-pl-inner'),
                    size = thisPortList.find('.eltd-pl-grid-sizer').width();

                eltdResizePortfolioItems(size, thisPortList);

                masonry.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    percentPosition: true,
                    packery: {
                        gutter: '.eltd-pl-grid-gutter',
                        columnWidth: '.eltd-pl-grid-sizer'
                    }
                });

                setTimeout(function () {
                    eltd.modules.parallax.eltdInitParallax();
                });

                masonry.css('opacity', '1');
            });
        }
    }

    /**
     * Init Resize Blog Items
     */
    function eltdResizePortfolioItems(size, container) {
        if (container.hasClass('eltd-pl-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.eltd-pl-masonry-default'),
                largeWidthMasonryItem = container.find('.eltd-pl-masonry-large-width'),
                largeHeightMasonryItem = container.find('.eltd-pl-masonry-large-height'),
                largeWidthHeightMasonryItem = container.find('.eltd-pl-masonry-large-width-height');

            if (eltd.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function eltdInitPortfolioFilter() {
        var filterHolder = $('.eltd-portfolio-list-holder .eltd-pl-filter-holder');

        if (filterHolder.length) {
            filterHolder.each(function () {
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.eltd-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.eltd-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('eltd-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.eltd-pl-filter:first').addClass('eltd-pl-current');

                if (thisPortListHolder.hasClass('eltd-pl-gallery')) {
                    thisPortListInner.isotope();
                }

                thisFilterHolder.find('.eltd-pl-filter').on('click', function () {
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.eltd-pl-filter').removeClass('eltd-pl-current');
                    thisFilter.addClass('eltd-pl-current');

                    if (portListHasLoadMore && !portListHasArtciles) {
                        eltdInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.eltd-pl-inner').isotope({ filter: filterValue });
                        eltd.modules.parallax.eltdInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function eltdInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.eltd-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
            ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'eltd_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.eltd-pl-loading');

        if (nextPage <= maxNumPages) {
            loadingItem.addClass('eltd-showing eltd-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: eltdGlobalVars.vars.eltdAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
                        var portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                        if (portListHasArtciles) {
                            setTimeout(function () {
                                eltdResizePortfolioItems(thisPortListInner.find('.eltd-pl-grid-sizer').width(), thisPortList);
                                thisPortListInner.isotope('layout').isotope({ filter: filterValue });
                                loadingItem.removeClass('eltd-showing eltd-filter-trigger');

                                setTimeout(function () {
                                    thisPortListInner.css('opacity', '1');
                                    eltd.modules.parallax.eltdInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('eltd-showing eltd-filter-trigger');
                            eltdInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }

    /**
     * Initializes portfolio pagination functions
     */
    function eltdInitPortfolioPagination() {
        var portList = $('.eltd-portfolio-list-holder');

        var initStandardPagination = function (thisPortList) {
            var standardLink = thisPortList.find('.eltd-pl-standard-pagination li');

            if (standardLink.length) {
                standardLink.each(function () {
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisPortList, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function (thisPortList) {
            var loadMoreButton = thisPortList.find('.eltd-pl-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisPortList);
            });
        };

        var initInifiteScrollPagination = function (thisPortList) {
            var portListHeight = thisPortList.outerHeight(),
                portListTopOffest = thisPortList.offset().top,
                portListPosition = portListHeight + portListTopOffest - eltdGlobalVars.vars.eltdAddForAdminBar;

            if (!thisPortList.hasClass('eltd-pl-infinite-scroll-started') && eltd.scroll + eltd.windowHeight > portListPosition) {
                initMainPagFunctionality(thisPortList);
            }
        };

        var initMainPagFunctionality = function (thisPortList, pagedLink) {
            var thisPortListInner = thisPortList.find('.eltd-pl-inner'),
                nextPage,
                maxNumPages;

            if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
                maxNumPages = thisPortList.data('max-num-pages');
            }

            if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                thisPortList.data('next-page', pagedLink);
            }

            if (thisPortList.hasClass('eltd-pl-pag-infinite-scroll')) {
                thisPortList.addClass('eltd-pl-infinite-scroll-started');
            }

            var loadMoreDatta = eltd.modules.common.getLoadMoreData(thisPortList),
                loadingItem = thisPortList.find('.eltd-pl-loading');

            nextPage = loadMoreDatta.nextPage;

            if (nextPage <= maxNumPages) {
                if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                    loadingItem.addClass('eltd-showing eltd-standard-pag-trigger');
                    thisPortList.addClass('eltd-pl-pag-standard-animate');
                } else {
                    loadingItem.addClass('eltd-showing');
                }

                var ajaxData = eltd.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'eltd_core_portfolio_ajax_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: eltdGlobalVars.vars.eltdAjaxUrl,
                    success: function (data) {
                        if (!thisPortList.hasClass('eltd-pl-pag-standard')) {
                            nextPage++;
                        }

                        thisPortList.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                            eltdInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);

                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('eltd-pl-masonry')) {
                                    eltdResizePortfolioItems(thisPortListInner.find('.eltd-blog-masonry-grid-sizer').width(), thisPortList);
                                    eltdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                } else if (thisPortList.hasClass('eltd-pl-gallery') && thisPortList.hasClass('eltd-pl-has-filter')) {
                                    eltdInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                } else {
                                    eltdInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                }
                            });
                        } else {
                            thisPortList.waitForImages(function () {
                                if (thisPortList.hasClass('eltd-pl-masonry')) {
                                    eltdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
                                } else if (thisPortList.hasClass('eltd-pl-gallery') && thisPortList.hasClass('eltd-pl-has-filter')) {
                                    eltdInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
                                } else {
                                    eltdInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                }
                            });
                        }

                        if (thisPortList.hasClass('eltd-pl-infinite-scroll-started')) {
                            thisPortList.removeClass('eltd-pl-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisPortList.find('.eltd-pl-load-more-holder').hide();
            }
        };

        var eltdInitStandardPaginationLinkChanges = function (thisPortList, maxNumPages, nextPage) {
            var standardPagHolder = thisPortList.find('.eltd-pl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.eltd-pl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.eltd-pl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.eltd-pl-pag-next a');

            standardPagNumericItem.removeClass('eltd-pl-pag-active');
            standardPagNumericItem.eq(nextPage - 1).addClass('eltd-pl-pag-active');

            standardPagPrevItem.data('paged', nextPage - 1);
            standardPagNextItem.data('paged', nextPage + 1);

            if (nextPage > 1) {
                standardPagPrevItem.css({ 'opacity': '1' });
            } else {
                standardPagPrevItem.css({ 'opacity': '0' });
            }

            if (nextPage === maxNumPages) {
                standardPagNextItem.css({ 'opacity': '0' });
            } else {
                standardPagNextItem.css({ 'opacity': '1' });
            }
        };

        var eltdInitHtmlIsotopeNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.html(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
            loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
            thisPortList.removeClass('eltd-pl-pag-standard-animate');

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                eltdInitPortfolioListAnimation();
                eltd.modules.parallax.eltdInitParallax();
            }, 400);
        };

        var eltdInitHtmlGalleryNewContent = function (thisPortList, thisPortListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltd-showing eltd-standard-pag-trigger');
            thisPortList.removeClass('eltd-pl-pag-standard-animate');
            thisPortListInner.html(responseHtml);
            eltdInitPortfolioListAnimation();
            eltd.modules.parallax.eltdInitParallax();
        };

        var eltdInitAppendIsotopeNewContent = function (thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({ sortBy: 'original-order' });
            loadingItem.removeClass('eltd-showing');

            setTimeout(function () {
                thisPortListInner.isotope('layout');
                eltdInitPortfolioListAnimation();
                eltd.modules.parallax.eltdInitParallax();
            }, 400);
        };

        var eltdInitAppendGalleryNewContent = function (thisPortListInner, loadingItem, responseHtml) {
            loadingItem.removeClass('eltd-showing');
            thisPortListInner.append(responseHtml);
            eltdInitPortfolioListAnimation();
            eltd.modules.parallax.eltdInitParallax();
        };

        return {
            init: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('eltd-pl-pag-standard')) {
                            initStandardPagination(thisPortList);
                        }

                        if (thisPortList.hasClass('eltd-pl-pag-load-more')) {
                            initLoadMorePagination(thisPortList);
                        }

                        if (thisPortList.hasClass('eltd-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            },
            scroll: function () {
                if (portList.length) {
                    portList.each(function () {
                        var thisPortList = $(this);

                        if (thisPortList.hasClass('eltd-pl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisPortList);
                        }
                    });
                }
            }
        };
    }

    var eltdPortfolioSingleFollow = function () {

        var info = $('.eltd-follow-portfolio-info .eltd-portfolio-single-holder .eltd-ps-info-sticky-holder');

        if (info.length) {
            var infoHolderOffset = info.offset().top,
                infoHolderHeight = info.height(),
                mediaHolder = $('.eltd-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .eltd-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function () {

            if (info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if (eltd.scroll > infoHolderOffset) {
                        var marginTop = eltd.scroll + headerHeight + eltdGlobalVars.vars.eltdAddForAdminBar - infoHolderOffset;
                        // if scroll is initially positioned below mediaHolderHeight
                        if (marginTop + infoHolderHeight > mediaHolderHeight) {
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function () {

            if (info.length) {
                if (mediaHolderHeight > infoHolderHeight) {
                    if (eltd.scroll > infoHolderOffset) {

                        if (eltd.scroll + headerHeight + infoHolderHeight < mediaHolderHeight) {
                            //Calculate header height if header appears
                            if ($('.header-appear, .eltd-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .eltd-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (eltd.scroll + headerHeight + eltdGlobalVars.vars.eltdAddForAdminBar - infoHolderOffset)
                            });
                            //Reset header height
                            headerHeight = 0;
                        } else {
                            info.stop().animate({
                                marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {
            init: function () {
                infoHolderPosition();
                $(window).scroll(function () {
                    recalculateInfoHolderPosition();
                });
            }
        };
    };

    function initPortfolioSingleMasonry() {
        var masonryHolder = $('.eltd-portfolio-single-holder .eltd-ps-masonry-images'),
            masonry = masonryHolder.children();

        if (masonry.length) {
            masonry.isotope({
                layoutMode: 'packery',
                itemSelector: '.eltd-ps-image',
                percentPosition: true,
                packery: {
                    gutter: '.eltd-ps-grid-gutter',
                    columnWidth: '.eltd-ps-grid-sizer'
                }
            });

            masonry.css('opacity', '1');
        }
    }

})(jQuery);
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
(function ($) {
    'use strict';

    var woocommerce = {};
    eltd.modules.woocommerce = woocommerce;

    woocommerce.eltdOnDocumentReady = eltdOnDocumentReady;
    woocommerce.eltdOnWindowLoad = eltdOnWindowLoad;
    woocommerce.eltdOnWindowResize = eltdOnWindowResize;

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdInitQuantityButtons();
        eltdInitSelect2();
    }

    /* 
        All functions to be called on $(window).on('load', ) should be in this function
    */
    function eltdOnWindowLoad() {
        eltdInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {
        eltdInitProductListMasonryShortcode();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() { }

    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
    function eltdInitQuantityButtons() {

        $(document).on('click', '.eltd-quantity-minus, .eltd-quantity-plus', function (e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.eltd-quantity-input'),
                step = parseFloat(inputField.data('step')),
                max = parseFloat(inputField.data('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('eltd-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if (max === undefined) {
                    inputField.val(newInputValue);
                } else {
                    if (newInputValue >= max) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger('change');
        });
    }

    /*
    ** Init select2 script for select html dropdowns
    */
    function eltdInitSelect2() {
        var orderByDropDown = $('.woocommerce-ordering .orderby');
        if (orderByDropDown.length) {
            orderByDropDown.select2({
                minimumResultsForSearch: Infinity
            });
        }

        var shippingCountryCalc = $('#calc_shipping_country');
        if (shippingCountryCalc.length) {
            shippingCountryCalc.select2();
        }

        var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
        if (shippingStateCalc.length) {
            shippingStateCalc.select2();
        }
    }

    /*
     ** Init Product List Masonry Shortcode Layout
     */
    function eltdInitProductListMasonryShortcode() {
        var container = $('.eltd-pl-holder.eltd-masonry-layout .eltd-pl-outer');

        if (container.length) {
            container.each(function () {
                var thisContainer = $(this);

                thisContainer.waitForImages(function () {
                    thisContainer.isotope({
                        itemSelector: '.eltd-pli',
                        resizable: false,
                        masonry: {
                            columnWidth: '.eltd-pl-sizer',
                            gutter: '.eltd-pl-gutter'
                        }
                    });

                    thisContainer.isotope('layout');

                    thisContainer.css('opacity', 1);
                });
            });
        }
    }

})(jQuery);