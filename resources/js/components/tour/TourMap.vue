<template>
    <div ref="mapRef"></div>
</template>

<script>
import { computed, onMounted, ref } from "vue";
import { useI18n } from "vue-i18n";
import { mapOptions } from "./useGoogleMap";
import MarkerClusterer from "@googlemaps/markerclustererplus";

export default {
    name: "TourMap",

    props: {
        places: Array,
    },
    setup(props) {
        const {locale} = useI18n({useScope: 'global'});
        const mapRef = ref(null);
        const map = ref(null);
        const markers = ref([]);

        const apiKey = process.env.MIX_GOOGLE_MAPS_KEY;

        onMounted(() => {
            if ('google' in window && 'maps' in google) {
                map.value = new google.maps.Map(mapRef.value, {
                    ...mapOptions,
                    center: {lat: 49.822385, lng: 24.023855},
                    zoom: 15,
                });

                const bounds = new google.maps.LatLngBounds();

                const infoWindows = {}

                for (let i = 0; i < props.places.length; i++) {
                    const place = props.places[i];
                    const position = {lat: place.lat, lng: place.lng};
                    const marker = new google.maps.Marker({
                        position: position,
                        icon: '/icon/marker.svg',
                        label: {text: (i + 1).toString(), color: "white"},
                        title: place.title[locale.value] || place.title['uk'],
                        map: map.value,
                    });

                    infoWindows[i] = new google.maps.InfoWindow({
                        ariaLabel: place.title[locale.value] || place.title['uk'],
                        content: place.title[locale.value] || place.title['uk'],
                    });

                    marker.addListener("click", () => {
                        for (let i in infoWindows) {
                            let infoWindow = infoWindows[i]
                            infoWindow.close()
                        }
                        infoWindows[i].open({
                            anchor: marker,
                            map: map.value,
                            shouldFocus: false,
                        });
                    });

                    bounds.extend(marker.getPosition());
                    markers.value.push(marker);
                }

                const clusterImage = 'img/cluster.png'

                map.value.mapmarkerClusterer = new MarkerClusterer(
                    map.value.map,
                    map.value.markers,
                    {imagePath: clusterImage, gridSize: 60, minimumClusterSize: 2}
                );

                if (markers.value.length === 1) {
                    map.value.setCenter(markers.value[0].getPosition())
                    map.value.setZoom(8)
                } else {
                    map.value.fitBounds(bounds, 100);
                }
            }

        });

        return {
            mapRef,
        }
    }
}
</script>
