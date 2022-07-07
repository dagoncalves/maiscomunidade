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