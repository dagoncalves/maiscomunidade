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