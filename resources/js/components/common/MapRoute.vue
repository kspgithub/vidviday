<template>
    <div class="map-route-wrap">
        <div ref="mapRef" class="map-block full-size"></div>

        <div class="addresses-block">
            <a
                :data-lat="lat"
                :data-lng="lng"
                :data-marker="marker"
                :data-string="`<div class='map-informer-content'><p>${addressComment}</p></div>`"
            ></a>
        </div>
        <form action="/" class="build-route">
            <label>
                <!-- <i>Ваше місце розташування</i> -->
                <input ref="userLocationRef" type="text" name="user-location" placeholder="Ваше місце розташування" />
            </label>

            <label>
                <input ref="targetLocationRef" type="text" :value="address" disabled />
            </label>
        </form>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue'
import {
    addInfoWindow,
    addMarker,
    autocompletePlaces,
    directionsDisplay,
    directionsService,
    initMap,
    mapLatLng,
} from '../../composables/useMap'

export default {
    name: 'MapRoute',
    props: {
        lat: {
            default: 49.850562,
        },
        lng: {
            default: 24.026892,
        },
        zoom: {
            default: 13,
        },
        marker: {
            default: '/img/marker.png',
        },
        markerCircle: {
            default: '/icon/marker-circle.svg',
        },
        address: {
            default: '',
        },
        addressComment: {
            default: '',
        },
    },
    setup(props) {
        const mapRef = ref(null)
        const userLocationRef = ref(null)
        const targetLocationRef = ref(null)
        const map = ref(null)
        const userPosition = ref(null)
        const targetPosition = ref(null)
        const dirDisplay = ref(null)
        const dirService = ref(null)

        const buildRoute = () => {
            dirDisplay.value.setMap(null)
            const request = {
                origin: userPosition.value,
                destination: targetPosition.value,
                travelMode: google.maps.DirectionsTravelMode.DRIVING,
            }

            dirService.value.route(request, function (response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    dirDisplay.value.setMap(map.value)
                    dirDisplay.value.setDirections(response)
                }
            })
        }

        onMounted(async () => {
            targetPosition.value = mapLatLng({
                lat: props.lat,
                lng: props.lng,
            })

            map.value = await initMap(mapRef.value, {
                center: targetPosition.value,
                zoom: props.zoom,
            })

            const targetMarker = addMarker(map.value, {
                position: targetPosition.value,
                icon: props.marker,
            })

            const infoWindow = addInfoWindow(targetMarker, {
                content: `<div class='map-informer-content'><p>${
                    props.addressComment || props.address || ''
                }</p></div>`,
            })

            dirDisplay.value = directionsDisplay({
                center: targetPosition.value,
            })
            dirService.value = directionsService()

            const userLocation = autocompletePlaces(userLocationRef.value)

            google.maps.event.addListener(userLocation, 'place_changed', () => {
                const place = userLocation.getPlace()

                map.value.panTo(targetPosition.value)

                userPosition.value = new google.maps.LatLng(
                    place.geometry.location.lat(),
                    place.geometry.location.lng(),
                )

                const userMarker = addMarker(map.value, {
                    icon: {
                        url: props.markerCircle,
                        scaledSize: new google.maps.Size(50, 50),
                    },
                    position: userPosition.value,
                })

                map.value.panTo(userPosition.value)
                buildRoute()
            })
        })

        return {
            mapRef,
            userLocationRef,
            targetLocationRef,
        }
    },
}
</script>

<style scoped></style>
