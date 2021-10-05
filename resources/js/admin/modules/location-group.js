import { Loader } from '@googlemaps/js-api-loader';
import Choices from 'choices.js';

let googleMaps;

const loader = new Loader({
    apiKey: process.env.MIX_GOOGLE_MAPS_KEY,
    version: "weekly",
    libraries: ["places"],
    language: 'uk',
});

//48.736383466532274 31.460746106250006

const DEFAULT_LAT_LNG =  { lat: 48.7363835, lng: 31.46074611 };

const LocationGroup = function (wrapper) {
    const noMap = wrapper.classList.contains('no-map');
    const citySelect = wrapper.querySelector('[name="city_id"]');


    if (!noMap) {
        const latInput = wrapper.querySelector('[name="lat"]');
        const lngInput = wrapper.querySelector('[name="lng"]');
        const mapElement = wrapper.querySelector('.map');


        let latValue = latInput.value ? parseFloat(latInput.value) : DEFAULT_LAT_LNG.lat;
        let lngValue = lngInput.value ? parseFloat(lngInput.value) : DEFAULT_LAT_LNG.lng;

        let latLng = {lat: latValue, lng: lngValue};


        const map = new googleMaps.Map(mapElement, {
            zoom: 6,
            center: latLng,
        });

        const marker = new googleMaps.Marker({
            position: latLng,
            map: map,
        });

        map.addListener("drag", () => {
            marker.setPosition(map.getCenter());
        });

        map.addListener("center_changed", () => {
            marker.setPosition(map.getCenter());
            latLng = {lat: map.getCenter().lat(), lng: map.getCenter().lng()};
            latInput.value = latLng.lat;
            lngInput.value = latLng.lng;
        });
    }


    // city search

    const CancelToken = axios.CancelToken;
    let cancel;
    let citySearchText = '';

    const cityChoices = new Choices(citySelect);

    const searchCities = async (q) => {
        if(q === citySearchText) return;
        citySearchText = q;

        if (cancel !== undefined) {
            cancel();
        }
        if(q.length > 0){
            const items = await axios
                .get('/admin/city/search?q='+q, {
                    cancelToken: new CancelToken(function executor(c) {
                        cancel = c;
                    }),
                })
                .catch(err => console.log(err));

            cityChoices.setChoices(items && items.data ? items.data : [],
                'value',
                'text',
                true);
        }else{
            cityChoices.setChoices( [],
                'value',
                'text',
                true);
        }

    }

    cityChoices.passedElement.element.addEventListener('search', async (event)=>{
        const searchText = event.detail.value;
        await searchCities(searchText)
    })

    //change

    cityChoices.passedElement.element.addEventListener('change', async (event)=>{
        cityChoices.setChoices( [],
            'value',
            'text',
            true);
    })
}

window.LocationGroup = LocationGroup;

loader.load()
    .then((google)=>{
        googleMaps = google.maps;
        const groupElements = document.querySelectorAll('.location-group');
        groupElements.forEach( (elem)=>{
            const gr = new LocationGroup(elem);
        })
    })
    .catch(e => {
        // do something
        console.log(e);
    });


