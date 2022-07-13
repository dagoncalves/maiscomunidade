(function($) {
	'use strict';

	var listingSearch = {};
	eltd.modules.listingSearch = listingSearch;

	listingSearch.eltdListingSearchPriceSlider = eltdListingSearchPriceSlider;

	listingSearch.eltdOnDocumentReady = eltdOnDocumentReady;

	$(document).ready(eltdOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdListingSearchPriceSlider();
	}
    
	function eltdListingSearchPriceSlider(){
        var holder = $('.eltd-ls-main-search-holder-part.type2'),
            slider = holder.find('.eltd-price-slider'),
            maxValue = slider.attr('max'),
            response = holder.find('.eltd-price-slider-response'),
            hiddenValue = holder.find('.eltd-price-slider-value');
    
        // Basic rangeslider initialization
		slider.rangeslider({
			polyfill: false,
			onInit: function(position, value) {
				eltdSetListingSearchPricePosition(maxValue, value);
			},
			onSlide: function(position, value) {
                eltdSetListingSearchPriceAmount(value);
                eltdSetListingSearchPricePosition(maxValue, value);
			}
		});

		function eltdSetListingSearchPriceAmount(value){
			response.text("$"+value);
            hiddenValue.val(value);
		}
		
		function eltdSetListingSearchPricePosition(maxValue, currentValue) {

			if(eltd.modules.listings.eltdIsValidObject(maxValue) && eltd.modules.listings.eltdIsValidObject(currentValue) ){
                var percent = (currentValue/maxValue) * 100;
                response.css('left', percent+'%');
			}

        }
        
	}
})(jQuery);