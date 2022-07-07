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
