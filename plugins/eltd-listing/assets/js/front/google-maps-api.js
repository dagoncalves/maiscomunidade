(function ($) {
    "use strict";

    var maps = {};
    eltd.modules.maps = maps;
    eltd.modules.maps.eltdInitMultipleListingMap = eltdInitMultipleListingMap;
    eltd.modules.maps.eltdInitSingleListingMap = eltdInitSingleListingMap;
    eltd.modules.maps.eltdInitMobileMap = eltdInitMobileMap;
    eltd.modules.maps.eltdGoogleMaps = {};

    $(document).ready(eltdOnDocumentReady);
    $(window).on('load', eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);

    function eltdOnDocumentReady() { }

    function eltdOnWindowLoad() {
        eltdInitSingleListingMap();
        eltdInitMultipleListingMap();
        eltdInitMobileMap();
    }

    function eltdOnWindowResize() { }

    function eltdOnWindowScroll() { }

    function eltdInitSingleListingMap() {
        var mapHolder = $('#eltd-ls-single-map-holder');
        if (mapHolder.length && typeof google === 'object') {
            eltd.modules.maps.eltdGoogleMaps.getDirectoryItemAddress({
                mapHolder: 'eltd-ls-single-map-holder'
            });
        }
    }

    function eltdInitMultipleListingMap() {
        var mapHolder = $('#eltd-ls-multiple-map-holder');
        if (mapHolder.length && typeof google === 'object') {
            eltd.modules.maps.eltdGoogleMaps.getDirectoryItemsAddresses({
                mapHolder: 'eltd-ls-multiple-map-holder',
                hasFilter: true
            });
        }
    }

    eltd.modules.maps.eltdGoogleMaps = {

        //Object varibles
        mapHolder: {},
        map: {},
        markers: {},
        radius: {},

        /**
         * Returns map with single address
         *
         * @param options
         */
        getDirectoryItemAddress: function (options) {
            /**
             * use eltdMapsVars to get variables for address, latitude, longitude by default
             */
            var defaults = {
                location: eltdSingleMapVars.single['currentListing'].location,
                type: eltdSingleMapVars.single['currentListing'].listingType,
                zoom: 16,
                mapHolder: '',
                draggable: eltdMapsVars.global.draggable,
                mapTypeControl: eltdMapsVars.global.mapTypeControl,
                scrollwheel: eltdMapsVars.global.scrollable,
                streetViewControl: eltdMapsVars.global.streetViewControl,
                zoomControl: eltdMapsVars.global.zoomControl,
                title: eltdSingleMapVars.single['currentListing'].title,
                content: '',
                styles: eltdMapsVars.global.mapStyle,
                markerPin: eltdSingleMapVars.single['currentListing'].markerPin,
                featuredImage: eltdSingleMapVars.single['currentListing'].featuredImage,
                ratingHtml: eltdSingleMapVars.single['currentListing'].ratingHtml,
                itemUrl: eltdSingleMapVars.single['currentListing'].itemUrl
            };
            var settings = $.extend({}, defaults, options);

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;

            //Get map holder
            var mapHolder = document.getElementById(settings.mapHolder);

            //Initialize map
            var map = new google.maps.Map(mapHolder, {
                zoom: settings.zoom,
                draggable: settings.draggable,
                mapTypeControl: settings.mapTypeControl,
                scrollwheel: settings.scrollwheel,
                streetViewControl: settings.streetViewControl,
                zoomControl: settings.zoomControl
            });

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //Try to locate by latitude and longitude
            if (typeof settings.location !== 'undefined' && settings.location !== null) {
                var latLong = {
                    lat: parseFloat(settings.location.latitude),
                    lng: parseFloat(settings.location.longitude)
                };
                //Set map center to location
                map.setCenter(latLong);
                //Add marker to map

                var templateData = {
                    title: settings.title,
                    address: settings.location.address,
                    featuredImage: settings.featuredImage,
                    ratingHtml: settings.ratingHtml,
                    itemUrl: settings.itemUrl
                };

                var customMarker = new CustomMarker({
                    map: map,
                    position: latLong,
                    templateData: templateData,
                    markerPin: settings.markerPin
                });

                this.initMarkerInfo();

            }

        },

        /**
         * Returns map with multiple addresses
         *
         * @param options
         */
        getDirectoryItemsAddresses: function (options) {
            var defaults = {
                geolocation: false,
                mapHolder: 'eltd-ls-multiple-map-holder',
                addresses: eltdMultipleMapVars.multiple.addresses,
                draggable: eltdMapsVars.global.draggable,
                mapTypeControl: eltdMapsVars.global.mapTypeControl,
                scrollwheel: eltdMapsVars.global.scrollable,
                streetViewControl: eltdMapsVars.global.streetViewControl,
                zoomControl: eltdMapsVars.global.zoomControl,
                zoom: 16,
                styles: eltdMapsVars.global.mapStyle,
                radius: 50, //radius for marker visibility, in km
                hasFilter: false
            };
            var settings = $.extend({}, defaults, options);

            //Get map holder
            var mapHolder = document.getElementById(settings.mapHolder);

            //Initialize map
            var map = new google.maps.Map(mapHolder, {
                zoom: settings.zoom,
                draggable: settings.draggable,
                mapTypeControl: settings.mapTypeControl,
                scrollwheel: settings.scrollwheel,
                streetViewControl: settings.streetViewControl,
                zoomControl: settings.zoomControl
            });

            //Save variables for later usage
            this.mapHolder = settings.mapHolder;
            this.map = map;
            this.radius = settings.radius;

            //Set map style
            map.setOptions({
                styles: settings.styles
            });

            //If geolocation enabled set map center to user location
            if (navigator.geolocation && settings.geolocation) {
                this.centerOnCurrentLocation();
            }

            //Filter addresses, remove items without latitude and longitude
            var addresses = [],
                addressesLength = settings.addresses.length;
            if (settings.addresses.length !== null) {
                for (var i = 0; i < addressesLength; i++) {
                    var location = settings.addresses[i].location;
                    if (typeof location !== 'undefined' && location !== null) {

                        if (location.latitude !== '' && location.longitude !== '') {
                            addresses.push(settings.addresses[i]);
                        }
                    }
                }
            }


            //Center map and set borders of map
            this.setMapBounds(addresses);

            //Add markers to the map
            this.addMultipleMarkers(addresses);

        },

        /**
         * Add multiple markers to map
         */
        addMultipleMarkers: function (markersData) {

            var map = this.map;

            var markers = [];
            //Loop through markers
            var len = markersData.length;
            for (var i = 0; i < len; i++) {

                var latLng = {
                    lat: parseFloat(markersData[i].location.latitude),
                    lng: parseFloat(markersData[i].location.longitude)
                };

                //Custom html markers
                //Insert marker data into info window template
                var templateData = {
                    title: markersData[i].title,
                    address: markersData[i].location.address,
                    featuredImage: markersData[i].featuredImage,
                    ratingHtml: markersData[i].ratingHtml,
                    itemUrl: markersData[i].itemUrl
                };

                var customMarker = new CustomMarker({
                    position: latLng,
                    map: map,
                    templateData: templateData,
                    markerPin: markersData[i].markerPin
                });

                markers.push(customMarker);

            }

            this.markers = markers;

            //Init map clusters ( Grouping map markers at small zoom values )
            this.initMapClusters();

            //Init marker info
            this.initMarkerInfo();

            //Init visible circle area around center of map
            var that = this;
            google.maps.event.addListener(map, 'idle', function () {
                var visibleRadius = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0,
                    strokeWeight: 0,
                    fillColor: '#FF0000',
                    fillOpacity: 0,
                    map: map,
                    center: map.getCenter(),
                    radius: that.radius * 1000 //in meters
                });
                //Display only markers in circle
                //that.refreshCircleAreaMarkers( visibleRadius.getBounds() );
            });

        },

        /**
         * Set map bounds for Map with multiple markers
         *
         * @param addressesArray
         */
        setMapBounds: function (addressesArray) {

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < addressesArray.length; i++) {
                bounds.extend(new google.maps.LatLng(parseFloat(addressesArray[i].location.latitude), parseFloat(addressesArray[i].location.longitude)));
            }

            this.map.fitBounds(bounds);

        },

        /**
         * Init map clusters for grouping markers on small zoom values
         */
        initMapClusters: function () {

            //Activate clustering on multiple markers
            var markerClusteringOptions = {
                minimumClusterSize: 2,
                maxZoom: 12,
                styles: [{
                    width: 50,
                    height: 60,
                    url: '',
                    textSize: 12
                }]
            };
            var markerClusterer = new MarkerClusterer(this.map, this.markers, markerClusteringOptions);

        },

        initMarkerInfo: function () {

            $(document).on('click', '.eltd-map-marker', function () {
                var self = $(this),
                    markerHolders = $('.eltd-map-marker-holder'),
                    infoWindows = $('.eltd-info-window'),
                    markerHolder = self.parent('.eltd-map-marker-holder'),
                    infoWindow = self.siblings('.eltd-info-window');

                if (markerHolder.hasClass('active')) {
                    markerHolder.removeClass('active');
                    infoWindow.fadeOut(0);
                } else {
                    markerHolders.removeClass('active');
                    infoWindows.fadeOut(0);
                    markerHolder.addClass('active');
                    infoWindow.fadeIn(300);
                }

            });

        },
        /**
         * Info Window for displaying data on map markers
         *
         * @returns {google.maps.InfoWindow}
         */
        addInfoWindow: function () {

            var contentString = '';
            var infoWindow = new google.maps.InfoWindow({
                content: contentString
            });
            return infoWindow;

        },

        /**
         * If geolocation enabled center map on users current position
         */
        centerOnCurrentLocation: function () {
            var map = this.map;
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    var center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(center);
                }
            );
        },

        /**
         * Refresh area for visible markers
         *
         * @param circleArea
         */
        refreshCircleAreaMarkers: function (circleArea) {

            var length = this.markers.length;
            for (var i = 0; i < length; i++) {
                if (circleArea.contains(this.markers[i].getPosition())) {
                    this.markers[i].setVisible(true);
                } else {
                    this.markers[i].setVisible(false);
                }
            }

        },

    };

    function eltdInitMobileMap() {

        var mapOpener = $('.eltd-listing-view-larger-map a'),
            mapOpenerIcon = mapOpener.children('i'),
            mapHolder = $('.eltd-map-holder');
        if (mapOpener.length) {
            mapOpener.on('click', function (e) {
                e.preventDefault();
                if (mapHolder.hasClass('eltd-fullscreen-map')) {
                    mapHolder.removeClass('eltd-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-minus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-plus');
                } else {
                    mapHolder.addClass('eltd-fullscreen-map');
                    mapOpenerIcon.removeClass('icon-basic-magnifier-plus');
                    mapOpenerIcon.addClass('icon-basic-magnifier-minus');
                }
                eltd.modules.maps.eltdGoogleMaps.getDirectoryItemsAddresses();
            });
        }
    }

})(jQuery);