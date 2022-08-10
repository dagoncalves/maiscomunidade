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