/*###########################################*/
/* TABLE OF CONTENTS:                        */
/*###########################################*/
/* 01 SET MARKER                             */
/*===========================================*/
/* 02 ADD MARKER                             */
/*===========================================*/
/* 03 INITIALIZE MAP                         */
/*===========================================*/
/* 04 AUTOMATIC BIULD ROUTE ON CHANGE INPUTS */
/*===========================================*/
/* 05 BUILD ROUTE                            */
/*===========================================*/
/* 06 SET CURRENT POSITION                   */
/*###########################################*/

$(function () {
    var marker,
        markers = [],
        infowindow = [],
        map,
        image,
        autocomplete,
        set_marker;
    /*###############*/
    /* 01 SET MARKER */

    /*###############*/
    function setMarker(location) {
        image = {
            url: $('#map-canvas').attr('data-set-marker'),
            scaledSize: new google.maps.Size(50, 50),
        };
        set_marker = new google.maps.Marker({
            position: location,
            icon: image
        });
        set_marker.setMap(map);
        map.panTo(location);
    }

    /*###############*/
    /* 02 ADD MARKER */

    /*###############*/
    function addMarker(location, name, contentstr, markimg, mark_city) {
        marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: markimg
        });
        marker.setMap(map);
        infowindow[name] = new google.maps.InfoWindow({
            content: contentstr
        });
        google.maps.event.addListener(marker, 'click', function () {
            for (var i = 0; i < markers.length; i++) {
                infowindow['template_marker_' + i].close();
            }
            infowindow[name].open(map, this);
            map.setCenter(this.getPosition());
        });
        markers.push(marker);
    }

    /*###################*/
    /* 03 INITIALIZE MAP */

    /*###################*/
    function initialize() {
        var lat = $('#map-canvas').attr("data-lat"),
            lng = $('#map-canvas').attr("data-lng"),
            myLatlng = new google.maps.LatLng(lat, lng),
            setZoom = parseInt($('#map-canvas').attr("data-zoom")),
            styles = [{
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
            }, {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [{"visibility": "off"}]
            }, {
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
            styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"}),
            mapOptions = {
                zoom: setZoom,
                panControl: false,
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL,
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_BOTTOM
                },
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                },
                gestureHandling: 'cooperative',
                center: myLatlng,
                scaleControl: true,
                mapTypeControl: false
            };

        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');

        $('.addresses-block a').each(function () {
            var mark_lat = $(this).attr('data-lat'),
                mark_lng = $(this).attr('data-lng'),
                this_index = $('.addresses-block a').index(this),
                mark_name = 'template_marker_' + this_index,
                mark_locat = new google.maps.LatLng(mark_lat, mark_lng),
                mark_str = $(this).attr('data-string'),
                mark_img = $(this).attr('data-marker');
            mark_city = $(this).attr('data-city');
            addMarker(mark_locat, mark_name, mark_str, mark_img, mark_city);
        });

        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true,
            polylineOptions: {
                geodesic: true,
                strokeColor: "#df8f4e",
                strokeOpacity: 1,
                strokeWeight: 3,
                center: location
            }
        });
        // Google Autocomplete options
        var options = {
            types: ['geocode'],
            componentRestrictions: {country: "ua"}
        };

        if ($('#your_location').length) {
            your_location = new google.maps.places.Autocomplete(
                (document.getElementById('your_location')),
                options
            );
            google.maps.event.addListener(your_location, 'place_changed', function () {
                var place = your_location.getPlace(),
                    newLocation;
                if (markers.length) {
                    map.panTo(myLatlng);
                }
                newLocation = new google.maps.LatLng(
                    place.geometry.location.lat(),
                    place.geometry.location.lng()
                );
                setMarker(newLocation);
            });
        }
    }

    /*###########################################*/
    /* 04 AUTOMATIC BIULD ROUTE ON CHANGE INPUTS */

    /*###########################################*/
    function onChangeInput() {
        buildRoute(directionsService, directionsDisplay);
    }

    if ($('.build-route').length && $('#your_location').length) {
        var input_your_location = document.getElementById('your_location');
        autocomplete = new google.maps.places.Autocomplete(input_your_location);
        document.getElementById('your_location').addEventListener('change', onChangeInput);
    }
    /*################*/
    /* 05 BIULD ROUTE */

    /*################*/
    function buildRoute(markimg) {
        for (var y = 0; y < markers.length; y++) {
            infowindow['template_marker_' + y].close();
        }
        directionsDisplay.setMap(null);
        setTimeout(function () {
            var start = 'Україна, ' + document.getElementById("your_location").value;
            var end = document.getElementById("select_department").value;
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            directionsService.route(request, function (response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setMap(map);
                    directionsDisplay.setDirections(response);
                }
            });
        }, 200);
    }

    $(document).on('change', '#select_department', function () {
        if ($('#your_location').val()) {
            buildRoute();
        }
    });

    $(document).on('click', '.select2-selection__rendered', function () {
        if ($('#your_location').val()) {
            buildRoute();
        }
    });

    $(document).on('blur', '#your_location', function () {
        if ($(this).val() == '') {
            setTimeout(function () {
                directionsDisplay.setMap(null);
                set_marker.setMap(null);
            }, 230);
        }
    });
    /*#########################*/
    /* 06 SET CURRENT POSITION */
    /*#########################*/
    if ($('.build-route').length && $('#your_location').length) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                var geocoder = new google.maps.Geocoder;
                var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
                geocoder.geocode({'location': latlng}, function (results, status) {
                    document.getElementById('your_location').setAttribute('value', results[1].formatted_address);
                });
                setMarker(latlng);
            }
        );
    }

    if ($('#map-canvas').length) {
        setTimeout(function () {
            initialize();
        }, 500);
    }
});
