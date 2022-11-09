<template>
    <popup v-if="popupOpen" size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <span class="h2 title text-medium">{{ __('tours-section.popup-date-title') }}</span>
        </div>
        <div class="popup-align p-0">
            <tour-calendar v-if="popupOpen" :events="events"
                           :view-change="false"
                           :footer="false"
                           @event-click="onClick"
                           class="popup-calendar"
            ></tour-calendar>

            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>
</template>

<script>
import Popup from "../popup/Popup";
import {useStore} from "vuex";
import {computed, defineAsyncComponent, onMounted} from 'vue'
// import TourCalendar from './TourCalendar'
const TourCalendar = defineAsyncComponent({
    loader: () => import('./TourCalendar.vue'),
})
export default {
    name: "TourCalendarPopup",
    components: {
        Popup,
        TourCalendar: defineAsyncComponent(() => import('./TourCalendar.vue')),
    },
    props: {
        tour: Object,
        events: Array,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.orderTour.calendarOpen);
        const closePopup = () => store.commit('orderTour/SET_CALENDAR_OPEN', false);

        const onClick = (event) => {
            store.commit('orderTour/UPDATE_FORM_DATA', {schedule_id: event.id});
            store.commit('orderTour/SET_CALENDAR_OPEN', false);
        }

        return {
            popupOpen,
            onClick,
            closePopup,
        }
    }
}
</script>

<style scoped>

</style>
