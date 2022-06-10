import { Loader } from '@googlemaps/js-api-loader';
import Choices from 'choices.js';
import axios from "axios";

let googleMaps;

const loader = new Loader({
    apiKey: process.env.MIX_GOOGLE_MAPS_KEY,
    version: "weekly",
    libraries: ["places"],
    language: 'uk',
});

//48.736383466532274 31.460746106250006

const DEFAULT_LAT_LNG =  { lat: 48.7363835, lng: 31.46074611 };

let LocationWrapper

const LocationGroup = async function (wrapper, event) {
    LocationWrapper = LocationWrapper || wrapper
    const noMap = LocationWrapper.classList.contains('no-map');
    const citySelect = LocationWrapper.querySelector('[name="city_id"]');
    const districtSelect = LocationWrapper.querySelector('[name="district_id"]');
    const regionSelect = LocationWrapper.querySelector('[name="region_id"]');
    const countrySelect = LocationWrapper.querySelector('[name="country_id"]');

    const latInput = LocationWrapper.querySelector('[name="lat"]');
    const lngInput = LocationWrapper.querySelector('[name="lng"]');
    const mapElement = LocationWrapper.querySelector('.map');

    let cityChanged = false

    // if (citySelect) {
    //     const cityChoices = new Choices(citySelect, {
    //         maxItemCount: -1,
    //         renderChoiceLimit: -1,
    //         searchResultLimit: 20,
    //         searchFloor: 2,
    //     });
    //
    //     //change
    //     // cityChoices.passedElement.element.addEventListener('change', async (event) => {
    //     //     cityChoices.setChoices([],
    //     //         'value',
    //     //         'text',
    //     //         true);
    //     //     cityChanged = true
    //     // })
    //
    //     let citySearchEventListener = async (event) => {
    //         let cities = await axios.get('/api/location/cities', {
    //             params: {
    //                 q: event.detail.value,
    //                 limit: 20,
    //                 country_id: countrySelect.value,
    //                 district_id: districtSelect.value,
    //                 region_id: regionSelect.value,
    //             }
    //         })
    //
    //         cityChoices.setChoices(cities.data,
    //             'value',
    //             'text',
    //             true);
    //
    //     }
    //
    //     if(event){
    //         cityChoices.passedElement.element.removeEventListener('search', citySearchEventListener)
    //     }
    //
    //     cityChoices.passedElement.element.addEventListener('search', citySearchEventListener)
    // }
    //
    // if (districtSelect) {
    //     const districtChoices = new Choices(districtSelect);
    //
    //     //change
    //     districtChoices.passedElement.element.addEventListener('change', async (event) => {
    //         districtChoices.setChoices([],
    //             'value',
    //             'text',
    //             true);
    //     })
    // }
    //
    // if (regionSelect) {
    //     const regionChoices = new Choices(regionSelect);
    //
    //     //change
    //     regionChoices.passedElement.element.addEventListener('change', async (event) => {
    //         regionChoices.setChoices([],
    //             'value',
    //             'text',
    //             true);
    //     })
    // }
    //
    // if (countrySelect) {
    //     const countryChoices = new Choices(countrySelect);
    //
    //     //change
    //     countryChoices.passedElement.element.addEventListener('change', async (event) => {
    //         countryChoices.setChoices([],
    //             'value',
    //             'text',
    //             true);
    //     })
    // }


    if (!noMap && mapElement) {

        if(citySelect && citySelect.value && cityChanged && latInput && lngInput) {
            const {lat, lng} = await GetLocation();
            latInput.value = lat
            lngInput.value = lng

            jQuery(latInput).trigger('change')
            jQuery(lngInput).trigger('change')
        }

        let latValue = latInput?.value ? parseFloat(latInput.value) : DEFAULT_LAT_LNG.lat;
        let lngValue = lngInput?.value ? parseFloat(lngInput.value) : DEFAULT_LAT_LNG.lng;

        if(event && event?.detail?.address && latInput && lngInput) {
            const geocoder = new googleMaps.Geocoder()
            const geocode = await geocoder.geocode({ address: event.detail.address })
            latValue = geocode.results[0].geometry.location.lat()
            lngValue = geocode.results[0].geometry.location.lng()
            latInput.value = latValue
            lngInput.value = lngValue

            jQuery(latInput).trigger('change')
            jQuery(lngInput).trigger('change')
        }

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
        const address = countrySelect.options[countrySelect.selectedIndex].text
            + regionSelect.options[countrySelect.selectedIndex].text
            + districtSelect.options[districtSelect.selectedIndex].text
            + citySelect.options[citySelect.selectedIndex].text

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

window.addEventListener('livewire-refresh', event => {
    setTimeout(function () {
        const groupElements = document.querySelectorAll('.location-group');
        groupElements.forEach((elem) => {
            const gr = new LocationGroup(elem, event);
        })
    }, 500);
})
