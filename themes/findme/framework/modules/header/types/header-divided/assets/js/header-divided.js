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