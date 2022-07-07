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