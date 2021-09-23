import MarkerClusterer from '@googlemaps/markerclustererplus';

jQuery(function ($) {

    var winWidth = $(window).width();

    var maps = [],
        mapStyles = [{
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#6195a0"}]
        }, {
            "featureType": "administrative.province",
            "elementType": "geometry.stroke",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [{"lightness": "0"}, {"saturation": "0"}, {"color": "#f5f5f2"}, {"gamma": "1"}]
        }, {
            "featureType": "landscape.man_made",
            "elementType": "all",
            "stylers": [{"lightness": "-3"}, {"gamma": "1.00"}]
        }, {
            "featureType": "landscape.natural.terrain",
            "elementType": "all",
            "stylers": [{"visibility": "off"}]
        }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
            "featureType": "poi.park",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#bae5ce"}, {"visibility": "on"}]
        }, {
            "featureType": "road",
            "elementType": "all",
            "stylers": [{"saturation": -100}, {"lightness": 45}, {"visibility": "simplified"}]
        }, {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [{"visibility": "simplified"}]
        }, {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#fac9a9"}, {"visibility": "simplified"}]
        }, {
            "featureType": "road.highway",
            "elementType": "labels.text",
            "stylers": [{"color": "#4e4e4e"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#787878"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [{"visibility": "simplified"}]
        }, {
            "featureType": "transit.station.airport",
            "elementType": "labels.icon",
            "stylers": [{"hue": "#0a00ff"}, {"saturation": "-77"}, {"gamma": "0.57"}, {"lightness": "0"}]
        }, {
            "featureType": "transit.station.rail",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#43321e"}]
        }, {
            "featureType": "transit.station.rail",
            "elementType": "labels.icon",
            "stylers": [{"hue": "#ff6c00"}, {"lightness": "4"}, {"gamma": "0.75"}, {"saturation": "-68"}]
        }, {
            "featureType": "water",
            "elementType": "all",
            "stylers": [{"color": "#eaf6f8"}, {"visibility": "on"}]
        }, {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [{"color": "#c7eced"}]
        }, {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [{"lightness": "-49"}, {"saturation": "-53"}, {"gamma": "0.79"}]
        }],

        ibOptions = $('.places-map').length ? {
            alignBottom: true,
            content: 'text',
            pixelOffset: new google.maps.Size(0, -40),
            closeBoxMargin: "0px 55px -10px 5px",
            //closeBoxURL: 'icon/icon-close.png'
        } : {
            alignBottom: true,
            content: 'text',
            //pixelOffset: new google.maps.Size(50, 0),
            pixelOffset: $('.contact-map').length ? new google.maps.Size(50, 0) : new google.maps.Size(50, 150),
            boxStyle: {
                width: ($(window).width() < 1200) ? "270px" : "408px"
            },
            closeBoxMargin: "5px 5px 5px 5px",
            //closeBoxURL: 'icon/icon-close.png'
        },
        ib = new InfoBox(ibOptions);

    function Map(id, mapOptions) {
        this.map = new google.maps.Map(document.getElementById(id), mapOptions);
        this.markers = [];
        this.infowindows = [];
        this.clusters = null;
    }

    function addMarker(mapId, location, index, string, image, markerFilter) {
        const newMarker = new google.maps.Marker({
            position: location,
            map: maps[mapId].map,
            icon: {
                url: image
            },
            mainImage: image,
            active: false,
            filter: markerFilter
        });


        var content = '<div class="info-box">' + string + '</div>';

        google.maps.event.addListener(newMarker, 'click', function () {
            ib.setContent(content);
            ib.setPosition(location);
            ib.open(maps[mapId].map);

            maps[mapId].markers.forEach(function (marker) {
                marker.active = false;
                marker.setIcon(marker.mainImage);
            });
            //this.setIcon(this.activeIcon);
            this.active = true;

            maps[mapId].map.setCenter(location);
            //maps[mapId].map.setZoom(15);
        });
        maps[mapId].markers[index] = newMarker;

        return newMarker;
    }

    function initialize(mapInst) {

        var lat = mapInst.attr("data-lat"),
            lng = mapInst.attr("data-lng"),
            clusterImage = mapInst.attr("data-img-cluster"),
            myLatlng = new google.maps.LatLng(lat, lng),
            setZoom = parseInt(mapInst.attr("data-zoom")),
            mapId = mapInst.attr('id');

        var mapOptions = {
            zoom: setZoom,
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_BOTTOM
            },
            disableDefaultUI: true,
            scrollwheel: false,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.LEFT_BOTTOM
            },
            streetViewControl: false,
            center: myLatlng,
            styles: mapStyles
        };

        maps[mapId] = new Map(mapId, mapOptions);
        maps[mapId].bounds = new google.maps.LatLngBounds();

        //maps[mapId].bounds = new google.maps.LatLngBounds();
        $('.marker[data-rel="' + mapId + '"]').each(function (i, el) {
            const marker = addMarker(
                mapId,
                new google.maps.LatLng(
                    $(this).attr('data-lat'),
                    $(this).attr('data-lng')
                ),
                i,
                $(this).attr('data-string'),
                $(this).attr('data-image'),
                $(this).attr('data-filter')
            );
            maps[mapId].bounds.extend(marker.getPosition());
        });

        /* maps[mapId].markers.forEach(function(marker, index) {
            maps[mapId].bounds.extend(marker.getPosition());
        });
        maps[mapId].map.fitBounds(maps[mapId].bounds);*/

        maps[mapId].map.addListener('click', function () {
            ib.close();
            //show default marker image
            maps[mapId].markers.forEach(function (marker) {
                marker.active = false;
                marker.setIcon(marker.mainImage);
            });
        });
        //infobox close additional
        ib.addListener('closeclick', function () {
            //show default marker image
            maps[mapId].markers.forEach(function (marker) {
                marker.active = false;
                marker.setIcon(marker.mainImage);
            });
        });
        //get position
        /* maps[mapId].map.addListener('rightclick', function(e){
          var lat = e.latLng.lat();
          var lng = e.latLng.lng();
          console.log(e.latLng.lat(), e.latLng.lng());
        }); */


        if ($('.project-map').length || $('.places-map').length) {

            maps[mapId].mapmarkerClusterer = new MarkerClusterer(
                maps[mapId].map,
                maps[mapId].markers,
                {imagePath: clusterImage, gridSize: 60, minimumClusterSize: 2}
            );


            maps[mapId].map.fitBounds(maps[mapId].bounds);
        }

        if ((winWidth < 768) && ($('.contact-map').length)) {
            maps[mapId].map.panBy(180, 0);
            //maps[mapId].map.setZoom(15);
        } else {
            //map.setCenter(this.getPosition());
            //maps[mapId].map.setCenter(location);
        }

        //filter markers
        $('#filter-markers-select').on('change', function () {
            var filters = $(this).val(),
                filteredMarkers = [];
            //close infobox, if opened
            ib.close();
            //set markers to default state
            maps[mapId].markers.forEach(function (marker) {
                marker.active = false;
                marker.setIcon(marker.mainImage);
            });

            maps[mapId].markers.forEach(function (marker) {
                //console.log(marker);

                if (filters.includes(marker.filter)) {
                    marker.setVisible(true);
                    //fit map to filtered markers
                    filteredMarkers.push(marker);
                    /* filteredMarkers.forEach(function(marker, index) {
                        maps[mapId].extend(marker.getPosition());
                    });
                    maps[mapId].map.fitBounds(maps[mapId].bounds);*/
                    //console.log(maps[mapId].bounds)
                } else {
                    marker.setVisible(false)
                }
            });
        });
    }

    $('.map-init').on('click', function () {
        $('.map-wrapper.hidden-map').each(function () {
            initialize($(this));
        });
        $(this).removeClass('map-init');
    });

    setTimeout(function () {
        $('.map-wrapper:not(.hidden-map)').each(function () {
            initialize($(this));
        });
    }, 300);
});
