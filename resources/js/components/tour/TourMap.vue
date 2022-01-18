<template>
    <div ref="mapRef"></div>
</template>

<script>
import {computed, onMounted, ref} from "vue";
import {useI18n} from "vue-i18n";
import {mapOptions} from "./useGoogleMap";

export default {
    name: "TourMap",

    props: {
        tour: Object,
    },
    setup(props) {
        const {locale} = useI18n({useScope: 'global'});
        const mapRef = ref(null);
        const map = ref(null);
        const markers = ref([]);

        const apiKey = process.env.MIX_GOOGLE_MAPS_KEY;


        onMounted(() => {

            map.value = new google.maps.Map(mapRef.value, {
                ...mapOptions,
                center: {lat: 49.822385, lng: 24.023855},
                zoom: 15,
            });

            const bounds = new google.maps.LatLngBounds();

            for (let i = 0; i < props.tour.places.length; i++) {
                const place = props.tour.places[i];
                const position = {lat: place.lat, lng: place.lng};
                const marker = new google.maps.Marker({
                    position: position,
                    icon: '/icon/marker.svg',
                    label: {text: (i + 1).toString(), color: "white"},
                    title: place.title[locale] || place.title['uk'],
                    map: map.value,
                });

                bounds.extend(marker.getPosition());
                markers.value.push(marker);
            }
            map.value.fitBounds(bounds, 100);
        });

        return {
            mapRef,
        }
    }
}
</script>

<style scoped>

</style>