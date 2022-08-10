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