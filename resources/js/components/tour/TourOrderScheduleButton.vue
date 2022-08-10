<template>
    <a :href="orderLink" @click="orderTour">
        {{__('tours-section.order')}}
    </a>
</template>

<script>
import {computed, ref} from "vue";
import {useStore} from "vuex";

export default {
    name: "TourOrderScheduleButton",
    props: {
        tour: Object,
        corporate: Boolean,
        schedule: Object,
    },
    setup(props) {
        const store = useStore();

        const showPopup = () => {
            store.commit('orderTour/SET_POPUP_OPEN', true);
        }

        const onlyQuick = computed(() => {
            return props.schedule && (props.schedule.places_available === 0 || (props.schedule.places_available >= 2 && props.schedule.places_available <= 10))
        })

        const orderTour = (event) => {
            if(onlyQuick.value) {
                event.preventDefault()

                showPopup()
            } else {
                // event.target.click()
            }
        }

        const orderLink = '/tour/' + props.tour.id + '/order?schedule=' + props.schedule.id

        return {
            showPopup,
            orderTour,
            orderLink,
        }
    }
}
</script>

<style scoped>

</style>
