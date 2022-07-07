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