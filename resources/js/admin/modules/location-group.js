import { Loader } from '@googlemaps/js-api-loader';

let googleMaps;

const loader = new Loader({
    apiKey: process.env.MIX_GOOGLE_MAPS_KEY,
    version: "weekly",
    libraries: ["places"],
    language: 'uk',
});

const DEFAULT_LAT_LNG =  { lat: 48.7363835, lng: 31.46074611 };

let LocationWrapper

const LocationGroup = async function (wrapper, event) {
    LocationWrapper = wrapper || LocationWrapper || document.querySelector('.location-group')
    const noMap = LocationWrapper.classList.contains('no-map');
    const citySelect = LocationWrapper.querySelector('[name="city_id"]');

    const latInput = LocationWrapper.querySelector('[name="lat"]');
    const lngInput = LocationWrapper.querySelector('[name="lng"]');
    const mapElement = LocationWrapper.querySelector('.map');

    if (!noMap && mapElement) {

        if(citySelect && citySelect.value && event?.detail?.cityChanged && latInput && lngInput) {
            const {lat, lng} = await GetLocation();
            latInput.value = lat
            lngInput.value = lng

            window.Livewire.emit('locationChanged', {lat, lng})
        }

        let latValue = latInput?.value ? parseFloat(latInput.value) : DEFAULT_LAT_LNG.lat;
        let lngValue = lngInput?.value ? parseFloat(lngInput.value) : DEFAULT_LAT_LNG.lng;

        let latLng = {lat: latValue, lng: lngValue};

        const map = new googleMaps.Map(mapElement, {
            zoom: 6,
            center: latLng,
        });

        const marker = new googleMaps.Marker({
            position: latLng,
            map: map,
        });

        //function that will handle the wheelEvent
        function wheelEvent(event) {
            var e = window.event || e; // old IE support
            var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail))); //to know whether it was wheel up or down
            map.setZoom(map.getZoom() + delta);
        }

        function zoomIn() {
            map.setZoom(map.getZoom() + 1);
        }

        map.addListener("drag", () => {
            marker.setPosition(map.getCenter());
            latLng = {lat: map.getCenter().lat(), lng: map.getCenter().lng()};
            if(latInput && lngInput) {
                latInput.value = latLng.lat;
                lngInput.value = latLng.lng;

                window.Livewire.emit('locationChanged', latLng)
            }
        });

        map.addListener("dragend", () => {
            if(latInput && lngInput) {
                jQuery(latInput).trigger('change')
                jQuery(lngInput).trigger('change')
            }
        });

        //add a normal event listener on the map container
        map.addListener('mousewheel', wheelEvent, true);
        map.addListener('DOMMouseScroll', wheelEvent, true);

        //same with the double click
        map.addListener('dblclick', zoomIn, true);

    }

    function GetLocation() {
        const geocoder = new google.maps.Geocoder();
        const address = citySelect.options[citySelect.selectedIndex].text

        return new Promise((resolve, reject) => {
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const coords = {
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng(),
                    }

                    resolve(coords)
                } else {
                    alert("Request failed.")
                }
            });
        })
    }
}

window.LocationGroup = LocationGroup;

loader.load()
    .then((google) => {
        googleMaps = google.maps;
        const groupElements = document.querySelectorAll('.location-group');
        groupElements.forEach((elem) => {
            const gr = new LocationGroup(elem);
        })
    })
    .catch(e => {
        // do something
        console.log(e);
    });

window.addEventListener('initLocation', event => {
    const groupElements = document.querySelectorAll('.location-group');
    groupElements.forEach((elem) => {
        const gr = new LocationGroup(elem, event);
    })
})
