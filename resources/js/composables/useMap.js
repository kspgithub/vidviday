export const mapInfoWindow = {};
export const mapMarkers = [];
import { Loader } from '@googlemaps/js-api-loader';

const loader = new Loader({
    apiKey: process.env.MIX_GOOGLE_MAPS_KEY,
    version: "weekly",
    libraries: ["places"],
    language: 'uk',
});

export const MAP_STYLES = [{
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
}];


export const mapLatLng = (options = {}) => {
    return 'google' in window ? new google.maps.LatLng(options.lat, options.lng) : {lat: options.lat, lng: options.lng}
}

export const mapOptions = (options = {}) => {

    const center = options.center || mapLatLng(options.lat || 49.850562, options.lng || 24.026892);
    return {
        zoom: 13,
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
        center: center,
        scaleControl: true,
        mapTypeControl: false,
        ...options,
    }
}


export const initMap = (element, options = {}) => {
    return new Promise((resolve, reject) => {
        loader.load()
            .then((google) => {
                window.google = google;
                const styledMap = new google.maps.StyledMapType(MAP_STYLES, {name: "Styled Map"});
                const map = new google.maps.Map(element, mapOptions(options));
                map.mapTypes.set('map_style', styledMap);
                map.setMapTypeId('map_style');
                resolve(map)
            })
            .catch(e => {
                // do something
                console.log(e);
                reject(e)
            });
    })
}


export const addMarker = (map, options = {}) => {
    const position = options.position || new google.maps.LatLng(options.lat || 49.850562, options.lng || 24.026892);
    const id = mapMarkers.length;
    const name = 'map_marker_' + id;
    const marker = new google.maps.Marker({
        position: position,
        map: map,
        icon: options.icon,
        name: name
    });
    mapMarkers.push(marker);
    return marker;
}

export const addInfoWindow = (marker, options = {}) => {
    const map = options.map || marker.map;
    const infoWindow = new google.maps.InfoWindow({
        content: options.content
    });
    google.maps.event.addListener(marker, 'click', function () {
        mapMarkers.forEach(mrkr => mapInfoWindow[mrkr.name].close())
        mapInfoWindow[marker.name].open(map, this);
        map.setCenter(marker.getPosition());
    });

    mapInfoWindow[marker.name] = infoWindow;
    return infoWindow;
}

export const directionsService = (options = {}) => {
    return new google.maps.DirectionsService(options);
}

export const directionsDisplay = (options = {}) => {
    const center = options.center || new google.maps.LatLng(options.lat || 49.850562, options.lng || 24.026892);
    return new google.maps.DirectionsRenderer({
        suppressMarkers: true,
        polylineOptions: {
            geodesic: true,
            strokeColor: "#df8f4e",
            strokeOpacity: 1,
            strokeWeight: 3,
            center: center
        }
    });
}

export const autocompletePlaces = (element, options) => {
    options = {types: ['geocode'], componentRestrictions: {country: "ua"}, ...options};
    return new google.maps.places.Autocomplete(element, options);
}
