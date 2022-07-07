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