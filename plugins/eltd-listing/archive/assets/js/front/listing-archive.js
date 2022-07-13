(function($) {
	'use strict';

	var listingArchive = {};
	eltd.modules.listingArchive = listingArchive;

	listingArchive.eltdOnDocumentReady = eltdOnDocumentReady;

	$(document).ready(eltdOnDocumentReady);
	
	listingArchive.eltdInitArchiveSearch = eltdInitArchiveSearch;
	listingArchive.eltdRenderAmenities = eltdRenderAmenities;
	listingArchive.eltdGetArchiveSearchResponse = eltdGetArchiveSearchResponse;
	listingArchive.eltdUpdateListingsNumber = eltdUpdateListingsNumber;


	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitArchiveSearch();
		eltdFindUserLocation();
		eltdInitRangeSlider();
	}	
	
	function eltdInitArchiveSearch(){
		var container = $('.eltd-ls-archive-holder');

		if(container.length){
			container.each(function(){

				var thisContainer = $(this),
					keywordSearch = thisContainer.find('.eltd-archive-keyword-search'),
					typeSearch = thisContainer.find('.eltd-archive-type-search'),
					typeSearchVal = typeSearch.val(),
					addressSearch = document.getElementById('eltd-archive-places-search'),
					amenitiesHolder = thisContainer.find('.eltd-listing-type-amenities-holder'),
					submitButton = thisContainer.find('.eltd-archive-submit-button'),
					loadMoreButton = thisContainer.find('.eltd-listing-archive-load-more'),
					availableListings = eltdListingTitles.titles,
					currentVar = eltdListingArchiveVar.searchParams;

				eltdUpdateListingsNumber(thisContainer, currentVar['foundPosts']);

				keywordSearch.autocomplete({
					source: availableListings
				});

				//check if type is set on page load
				if(typeof typeSearchVal !== '' && typeSearchVal !== false && typeSearchVal !== null){
					eltdRenderAmenities(amenitiesHolder, typeSearchVal);
				}
				typeSearch.on('change', function(){
					var typeValue = $(this).val();
					eltdRenderAmenities(amenitiesHolder, typeValue);
				});

				//get address and distance on address change
				eltdGetAddressFieldParams(addressSearch);


				submitButton.on('click', function(){
					eltdGetArchiveSearchResponse(thisContainer, false);
				});
				if( typeof loadMoreButton !== 'undefined' && loadMoreButton !== null){
					loadMoreButton.on('click', function(){
						eltdGetArchiveSearchResponse(thisContainer, true);
					});
				}

				eltd.modules.listings.eltdShowHideButton(loadMoreButton, currentVar['nextPage'], currentVar['maxPage']);

			});
		}
	}
	
	function eltdUpdateListingsNumber(container, currentNumber){

		var holder = container.find('.eltd-ls-archive-items-number span.eltd-count');
		holder.html(currentNumber);

	}

	function eltdRenderAmenities(holder, typeId){
		holder.fadeOut(300);
		holder.removeClass('eltd-opened');
		if(typeof typeId !== 'undefined' && typeId !== false && typeId !== ''){
			var ajaxData = {
				typeId: typeId,
				action: 'eltd_listing_get_listing_type_amenities_html'
			}
			$.ajax({
				type: "POST",
				url: ElatedListingAjaxUrl,
				data: ajaxData,
				success: function (data) {
					if (data === 'error') {
						//error handler
					}else{
						var response = $.parseJSON(data);
						var responseHtml = response.html;
						if(responseHtml !== ''){
							holder.fadeIn(300, function(){
								holder.addClass('eltd-opened');
								holder.html(responseHtml);
							});
						}
					}
				}
			});
		}
	}

	function eltdGetArchiveSearchResponse(container, loadMoreFlag){

		var	keywordSearch = container.find('.eltd-archive-keyword-search'),
			locationSearch = container.find('.eltd-archive-region-search'),
			typeSearch = container.find('.eltd-archive-type-search'),
			catSearch = container.find('.eltd-archive-cat-search'),
			amenitiesArray = container.find('.eltd-amenity-field'),
			loadMoreButton = container.find('.eltd-listing-archive-load-more'),
			addressInput = container.find('.eltd-archive-places-search'),
			itemHolder = container.find('.eltd-ls-archive-items-inner'),
			sortParam = container.find('.eltd-ls-archive-sort'),
			distance = container.find('.eltd-rangle-slider-response'),
			dist = 5, //set default distance value
			currentVar = eltdListingArchiveVar.searchParams;


		currentVar['keyword'] = keywordSearch.val();
        currentVar['location'] = locationSearch.select2('val');
        currentVar['type'] = typeSearch.select2('val');
        currentVar['cat'] = catSearch.select2('val');
		currentVar['amenities'] = {};

		if(amenitiesArray.length){
			amenitiesArray.each(function(){

				var thisField = $(this);
				var fieldVal;
				var fieldNameAttr = thisField.attr('name');

				fieldVal = thisField.is(':checked');
				currentVar['amenities'][fieldNameAttr] = fieldVal;
			});
		}

		if(loadMoreFlag){
			currentVar['enableLoadMore'] = true;
		}else{
			currentVar['enableLoadMore'] = false;
			currentVar['nextPage'] = '2';
		}


		//take distance. Note that lat and long address params are set in eltdGetAddressFieldParams function

		if(eltd.modules.listings.eltdIsValidObject(distance)){
			var distanceValue = distance.text();
			if(distanceValue !== ''){
				dist = distanceValue;
			}
		}

		currentVar['locationDist'] = dist;

		//reset locationObject if address input field is empty
		if(addressInput.val() === ''){
			if(currentVar['locationObject'] !== null && typeof currentVar['locationObject'] !== 'undefined'){
				currentVar['locationObject'] = {};
			}
		}

        currentVar['sortParam']  = sortParam.val();

		var ajaxData = {
			action: 'eltd_listing_get_archive_search_response',
			searchParams: currentVar
		};

		$.ajax({
			type: "POST",
			url: ElatedListingAjaxUrl,
			data: ajaxData,
			success: function (data) {
				if (data === 'error') {
					//error handler
				}else{
					var response = $.parseJSON(data);

					//update current post number
					var foundPosts = response.foundPosts;
					eltdUpdateListingsNumber(container, foundPosts);

					var mapObjs = response.mapAddresses;
					var mapAddresses = '';
					if(mapObjs !== null){
						mapAddresses = mapObjs['addresses'];
					}

					//update maxNumPages after each ajax response
					currentVar['maxPage'] = response.maxNumPages;

					//if is clicked load more button
					if(loadMoreFlag){
						//update nextPage after each ajax response
						currentVar['nextPage']++;

						//if new map objects are sent via ajax, update global map objects
						if(mapAddresses !== ''){
							eltd.modules.listings.eltdReinitMultipleGoogleMaps(mapAddresses, 'append');
						}
						itemHolder.append(response.html);
					}
					else{
						//update multiple map addressess object
						if(mapAddresses !== ''){
							eltd.modules.listings.eltdReinitMultipleGoogleMaps(mapAddresses, 'replace');
						}

						//get new listings html
						itemHolder.html(response.html);
					}

					//reinit bindTitles function
					eltd.modules.listings.eltdBindTitles();

					//show button
					eltd.modules.listings.eltdShowHideButton(loadMoreButton, currentVar['nextPage'], currentVar['maxPage']);

					//reinit global archive var object
					eltdListingArchiveVar.searchParams = currentVar;
				}
			}
		});

	}
	
	function eltdGetAddressFieldParams(addressInput){

        if (typeof google === 'object') {
            if (eltd.modules.listings.eltdIsValidObject(addressInput)) {

                //Init Places search
                var autocomplete = new google.maps.places.Autocomplete(addressInput);
                //take initial value

                autocomplete.addListener('place_changed', function () {
                    //take value after change
                    eltdGetAddressAutocompleteResponse(autocomplete);
                });
            }
        }
	}

	function eltdGetAddressAutocompleteResponse(autocomplete){
		var place = autocomplete.getPlace(),
			location = place.geometry.location;

			if(eltd.modules.listings.eltdIsValidObject(location)){

				if(eltd.modules.listings.eltdIsValidObject(location.lat()) &&  eltd.modules.listings.eltdIsValidObject(location.lng())){
					eltdSetListingAddressParams(location.lat(), location.lng());
				}

			}

	}
	
	function eltdSetListingAddressParams(latitude, longitude){

		var locationObject = {};
 		locationObject['lat'] = latitude;
		locationObject['long'] = longitude;

		eltdListingArchiveVar.searchParams['locationObject'] = locationObject;

	}

	function eltdInitRangeSlider(){

		var selectorHolder =  $('.eltd-listing-places-dist-holder');
		var slider = selectorHolder.find('.eltd-rangle-slider');
		var output = selectorHolder.find('.eltd-rangle-slider-response');;

		// Basic rangeslider initialization
		slider.rangeslider({
			polyfill: false,
			onInit: function(position, value) {
				eltdListingSetCurrentDistance(value);
			},
			onSlide: function(position, value) {
				eltdListingSetCurrentDistance(value);
			}
		});

		function eltdListingSetCurrentDistance(value){
			output.text(value);
		}

	}
	
	function eltdFindUserLocation(){

		var location = $('.eltd-archive-current-location');

		location.on('click', function(){

			if (!navigator.geolocation){
				alert('Geolocation is not supported by your browser');
				return;
			}

			var thisLocationField = $(this);
			var addressField = thisLocationField.next('.eltd-archive-places-search');
			var address = '';

			function success(position) {

				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
				

				var GEOCODING = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latitude + '%2C' + longitude + '&language=en';

				$.getJSON(GEOCODING).done(function(location) {
					address = location.results[0].formatted_address;
					addressField.val(address);
				});

				eltdSetListingAddressParams(latitude, longitude);
			}

			function error(error) {

				if(error.code === 1 && error.message === 'Only secure origins are allowed (see: https://goo.gl/Y0ZkNV).'){

					$.getJSON("http://jsonip.com/?callback=?", function (data) {

						if(eltd.modules.listings.eltdIsValidObject(data.ip)){

							$.getJSON('http://ip-api.com/json/'+data.ip, function(response) {
								
								if(eltd.modules.listings.eltdIsValidObject(response.lat) && eltd.modules.listings.eltdIsValidObject(response.lon)) {

									$.getJSON('http://maps.googleapis.com/maps/api/geocode/json?latlng='+response.lat+','+response.lon+'&sensor=true', function(response){
										address = response.results[0].formatted_address;
										addressField.val(address);
									});
									eltdSetListingAddressParams(response.lat, response.lon);
								}
							});

						}

					});

				}else {
					alert('ERROR(' + error.code + '): ' + error.message);
				}
			}

			navigator.geolocation.getCurrentPosition(success, error);

		});
	}
})(jQuery);