(function($) {
	'use strict';

	var listingAdvSearch = {};
	eltd.modules.listingAdvSearch = listingAdvSearch;

	listingAdvSearch.eltdOnDocumentReady = eltdOnDocumentReady;

	$(document).ready(eltdOnDocumentReady);
	listingAdvSearch.eltdInitAdvSearch = eltdInitAdvSearch;
	listingAdvSearch.eltdGetAdvancedSearchResponse = eltdGetAdvancedSearchResponse;

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdOnDocumentReady() {
		eltdInitAdvSearch();
	}
	
	function eltdInitAdvSearch(){

		var container = $('.eltd-ls-adv-search-holder');

		if(container.length){
			container.each(function(){

				var thisContainer = $(this),
					typeID = thisContainer.data('type'),
					nextPage = thisContainer.data('next-page'),
					maxNumPages = thisContainer.data('max-num-pages'),
				 	submitButton = thisContainer.find('.eltd-adv-search-submit'),
					keywordSubmitButton = thisContainer.find('.eltd-ls-adv-search-keyword-button'),
					keywordField = thisContainer.find('.eltd-ls-adv-search-keyword'),
					availableListings = eltdListingTitles.titles,
					loadMoreButton = thisContainer.find('.eltd-ls-adv-search-load-more');
					
				if(eltd.modules.listings.eltdIsValidObject(keywordField)){
				    keywordField.autocomplete({
					    source: availableListings
				    });
				}
				
				if(eltd.modules.listings.eltdIsValidObject(keywordField)){
				    keywordSubmitButton.on('click', function(){
					    eltdGetAdvancedSearchResponse(typeID, thisContainer, false);
				    });
				}
				

				submitButton.on('click', function(){
					eltdGetAdvancedSearchResponse(typeID, thisContainer, false);
				});
				
				

				if(typeof loadMoreButton !== 'undefined' && loadMoreButton !=='false'){
					eltd.modules.listings.eltdShowHideButton(loadMoreButton, nextPage, maxNumPages);
					
					loadMoreButton.on('click', function(){
						eltdGetAdvancedSearchResponse(typeID, thisContainer, true);
					});
				}

			});
		}

	}

	function eltdGetAdvancedSearchResponse(typeId, container, loadMoreFlag){

		if(typeof typeId !== 'undefined' && typeId !== false && typeId !== ''){
		    
		    
			var number = container.data('number'),
			    searchFields = container.find('.eltd-ls-adv-search-input'),
			    itemsHolder = container.find('.eltd-ls-adv-search-items-holder-inner'),
			    googleMap = container.data('enable-map'),
			    mapFlag = false,
			    loadMoreData,
			    loadMoreButton = container.find('.eltd-ls-adv-search-load-more'),
			    keywordField = container.find('.eltd-ls-adv-search-keyword'),
			    keyword = '',
			    defaultSearchParams = {},
			    checkBoxSearchParams  = {},
			    categoryParams  = {},
			    nextPage,
			    data = {};
			    
			if(eltd.modules.listings.eltdIsValidObject(googleMap))    {
			    if(googleMap === 'yes'){
				mapFlag = true;
			    }
			}
			

			if(searchFields.length){
				searchFields.each(function(){

					var thisField = $(this);
					var fieldNameAttr = thisField.attr('name');
					var fieldType = thisField.attr('type');
					var fieldID;
					var fieldVal;

					if(fieldNameAttr === 'job_type_categories'){
						//generate category params
						fieldVal = thisField.is(':checked');
						fieldID = thisField.attr('id');
						categoryParams[fieldID] = fieldVal;
					}else{
						//generate params for all other fields
						switch (fieldType) {
							case 'checkbox':
								fieldVal = thisField.is(':checked');
								checkBoxSearchParams[fieldNameAttr] = fieldVal;
								break;
							default :
								fieldVal = thisField.val();
								defaultSearchParams[fieldNameAttr] = fieldVal;
								break;
						}
					}
				});
			}
			
			if(eltd.modules.listings.eltdIsValidObject(keywordField))    {
			    keyword = keywordField.val();
			}
			
			
			if(loadMoreFlag){
				loadMoreData = eltd.modules.common.getLoadMoreData(container);
			}else{
				container.data('next-page', '2');
			}			
			
			
			//always get value from holder
			nextPage = container.data('next-page');
			
			data = {
				action: 'eltd_listing_advanced_search_response',
				typeId : typeId,
				postPerPage : number,
				defaultSearchParams: defaultSearchParams,
				checkBoxSearchParams: checkBoxSearchParams,
				catParams: categoryParams,		
				keyword: keyword,
				enableLoadMore: loadMoreFlag,
				loadMoreData: loadMoreData,
				enableMap: mapFlag
			};
			
			$.ajax({
				type: "POST",
				url: ElatedListingAjaxUrl,
				data: data,
				success: function (data) {
					if (data === 'error') {

					}else{
						var response = $.parseJSON(data);
						var responseHtml = response.html;
						var maxNumPages = response.maxNumPages;
						
						if(typeof maxNumPages !== 'undefined' && maxNumPages !== 'false'){
							container.data('max-num-pages', maxNumPages);
						}
						
						if(mapFlag){
						    
						    var mapObjs = response.mapAddresses;
						    var mapAddresses = '';
						   
						   
						    if(eltd.modules.listings.eltdIsValidObject(mapObjs)){
							    mapAddresses = mapObjs['addresses'];
						    }
						    
						    if(loadMoreFlag){
							nextPage++;
							container.data('next-page', nextPage);
							//if new map objects are sent via ajax, update global map objects
							
							eltd.modules.listings.eltdReinitMultipleGoogleMaps(mapAddresses, 'append');
							
							setTimeout(function(){
								itemsHolder.append(responseHtml);
							},300);
						    }else{
							//update multiple map addressess object
							
							eltd.modules.listings.eltdReinitMultipleGoogleMaps(mapAddresses, 'replace');
							
							setTimeout(function(){
								itemsHolder.html(responseHtml);
							},300);
						    }						    
							
						    eltd.modules.listings.eltdBindTitles();
						}
						else{
						    
						    if(loadMoreFlag){
								nextPage++;
								container.data('next-page', nextPage);

								setTimeout(function(){
									itemsHolder.append(responseHtml);
								},300);
						    }
						    else{
								setTimeout(function(){
									itemsHolder.html(responseHtml);
								},300);
						    }
						    
						}
						
						//show button
						eltd.modules.listings.eltdShowHideButton(loadMoreButton, nextPage, maxNumPages);
					}

				}
			});
		}

	}

})(jQuery);