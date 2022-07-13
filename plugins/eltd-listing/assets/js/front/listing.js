(function ($) {

    var listings = {};
    eltd.modules.listings = listings;
    listings.eltdOnDocumentReady = eltdOnDocumentReady;
    listings.eltdOnWindowLoad = eltdOnWindowLoad;
    listings.eltdOnWindowResize = eltdOnWindowResize;
    listings.eltdOnWindowScroll = eltdOnWindowScroll;


    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    listings.eltdInitListingTypeCustomFields = eltdInitListingTypeCustomFields;
    listings.eltdGetListingTypeCustomFieldsOnChange = eltdGetListingTypeCustomFieldsOnChange;
    listings.eltdInitListingMainSearch = eltdInitListingMainSearch;
    listings.eltdBindTitles = eltdBindTitles;
    listings.eltdShowHideButton = eltdShowHideButton;
    listings.eltdReinitMultipleGoogleMaps = eltdReinitMultipleGoogleMaps;
    listings.eltdIsValidObject = eltdIsValidObject;

    function eltdOnDocumentReady() {
        eltdInitListingTypeCustomFields();
        eltdGetListingTypeCustomFieldsOnChange();
        eltdInitListingMainSearch();
        eltdBindTitles();
    }
    function eltdOnWindowLoad() { }
    function eltdOnWindowResize() { }
    function eltdOnWindowScroll() { }

    function eltdInitListingMainSearch() {
        var container = $('.eltd-ls-main-search-holder');
        if (container.length) {
            container.each(function () {
                var thisContainer = $(this),
                    keywordSearch = thisContainer.find('.eltd-ls-main-search-keyword'),
                    availableListings = eltdListingTitles.titles;

                keywordSearch.autocomplete({
                    source: availableListings
                });

            });
        }
    }

    function eltdInitListingTypeCustomFields() {

        var typeField = $('.job-manager-form fieldset #job_type');

        var typeFieldVal = typeField.val();
        eltdAddListingTypeItems(typeFieldVal);
        eltdDeleteListingTypeItems(typeFieldVal);

    }

    function eltdGetListingTypeCustomFieldsOnChange() {

        var typeField = $('.job-manager-form fieldset #job_type');
        typeField.on('change', function () {
            var thisField = $(this);
            var thisFieldVal = thisField.val();
            eltdAddListingTypeItems(thisFieldVal);
            eltdDeleteListingTypeItems(thisFieldVal);
        });

    }

    function eltdAddListingTypeItems(types) {

        if (typeof types !== 'undefined' && types !== null && types.length) {

            //there is minimum one selected type
            var i;
            for (i = 0; i < types.length; i++) {

                if ($.inArray(types[i], eltdListingGlobalVars.vars.selectedTypes) > -1) {
                }
                else {
                    //element is in not in array, add it
                    eltdGetListingTypeField(types[i]);
                }
            }


        } else {
            //there is no selected types
            eltdDeleteAllListingTypeFields();
        }

    }

    function eltdDeleteListingTypeItems(types) {
        if (typeof types !== 'undefined' && types !== null && types.length) {

            //there is minimum one selected type
            var i;
            for (i = 0; i < eltdListingGlobalVars.vars.selectedTypes.length; i++) {
                if ($.inArray(eltdListingGlobalVars.vars.selectedTypes[i], types) > -1) {
                }
                else {
                    //element is in not in array, add it
                    eltdDeleteListingTypeField(eltdListingGlobalVars.vars.selectedTypes[i]);
                }
            }

        } else {
            //there is no selected types
            eltdDeleteAllListingTypeFields();
        }
    }

    function eltdGetListingTypeField(itemId) {

        var form = $('.job-manager-form');
        var formAction = form.attr('action');
        var field = $('.job-manager-form fieldset #job_type');
        var container = field.parent().parent();

        //get current post id if is set
        // this id is set on edit job pages and we need it to get custom field values
        var actionArray = formAction.split('=');
        var userAction = actionArray[1];

        var currentPostId = false;

        if (userAction !== null && typeof userAction !== 'undefined' && userAction !== 'add-new-listing') {
            currentPostId = actionArray[actionArray.length - 1];
        }

        var data = {
            selectedType: itemId,
            action: 'eltd_listing_type_get_custom_fields',
            currentPostId: currentPostId
        };

        $.ajax({
            type: "POST",
            url: ElatedListingAjaxUrl,
            data: data,
            success: function (data) {
                if (data === 'error') {
                    //error handler
                } else {
                    //set new item in global var
                    eltdListingGlobalVars.vars.selectedTypes.push(itemId);
                    var response = $.parseJSON(data);
                    var responseHtml = response.html;
                    container.after(responseHtml);
                    eltdReinitAdditionalSelectFields();
                }
            }
        });
    }

    function eltdReinitAdditionalSelectFields() {
        var selectFields = $('.job-manager-form .eltd-ls-type-field-wrapper select');
        if (selectFields.length) {
            selectFields.each(function () {
                $(this).select2();
            });
        }
    }

    function eltdDeleteListingTypeField(itemId) {

        var typeFieldWrappers = $('.eltd-ls-type-field-wrapper');

        if (typeFieldWrappers.length) {
            typeFieldWrappers.each(function () {
                var thisFieldWrapper = $(this);
                var id = thisFieldWrapper.attr('id');

                if (id === itemId) {
                    setTimeout(function () {
                        thisFieldWrapper.remove();
                        //remove current element from global array
                        var index = eltdListingGlobalVars.vars.selectedTypes.indexOf(itemId);
                        eltdListingGlobalVars.vars.selectedTypes.splice(index, 1);
                    }, 300);
                };

            });
        }
    }

    function eltdDeleteAllListingTypeFields() {
        var typeFieldWrappers = $('.eltd-ls-type-field-wrapper ');

        if (typeFieldWrappers.length) {
            typeFieldWrappers.each(function () {
                var thisFieldWrapper = $(this);
                //empty selected types arrray
                eltdListingGlobalVars.vars.selectedTypes = [];
                //empty selected types html
                thisFieldWrapper.remove();
            });
        }
    }

    function eltdReinitMultipleGoogleMaps(addresses, action) {

        if (action === 'append') {

            var mapObjs = eltdMultipleMapVars.multiple.addresses;
            mapObjs = eltdMultipleMapVars.multiple.addresses.concat(addresses);
            eltdMultipleMapVars.multiple.addresses = mapObjs;

            eltd.modules.maps.eltdGoogleMaps.getDirectoryItemsAddresses({
                addresses: mapObjs
            });
        }
        else if (action === 'replace') {

            eltdMultipleMapVars.multiple.addresses = addresses;
            eltd.modules.maps.eltdGoogleMaps.getDirectoryItemsAddresses({
                addresses: addresses
            });

        }
    }

    function eltdShowHideButton(button, nextPage, maxNumPages) {

        if (typeof button !== 'undefined' && button !== false && button !== null) {
            if (nextPage <= maxNumPages) {
                button.show();
            } else {
                button.hide();
            }
        }

    }

    function eltdListingArchiveInitBack() {

        window.addEventListener("popstate", function (e) { // if a back or forward button is clicked
            location.reload();
        });

    }

    function eltdBindTitles() {

        var maps = $('.eltd-ls-archive-map-holder'),
            lists = $('.eltd-ls-archive-items');

        if (maps.length && lists.length) {
            maps.each(function () {

                $(this).mouseenter(function () {

                });
                var listItems = lists.find('.eltd-ls-item');

                listItems.each(function () {
                    var listItem = $(this);
                    listItem.mouseenter(function () {
                        var itemId = listItem.attr('id');
                        if ($('.eltd-map-marker-holder').length) {
                            $('.eltd-map-marker-holder').each(function () {
                                var markerHolder = $(this),
                                    markerId = markerHolder.attr('id');
                                if (itemId == markerId) {
                                    markerHolder.addClass('active');
                                    setTimeout(function () {
                                    }, 300);
                                } else {
                                    markerHolder.removeClass('active');
                                }
                            });
                        }
                    });
                });

                lists.mouseleave(function () {
                    $('.eltd-map-marker-holder').removeClass('active');
                });
            });
        }
    }

    function eltdIsValidObject(object) {
        if (typeof (object !== 'undefined') && object !== 'false' && object !== '' && object !== undefined) {
            return true;
        }
        return false;
    }

})(jQuery);