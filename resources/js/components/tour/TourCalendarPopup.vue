<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <span class="h2 title text-medium">{{ __('tours-section.popup-date-title') }}</span>
        </div>
        <div class="popup-align p-0">
            <tour-calendar :events="events"

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
import {computed} from "vue";
import TourCalendar from "./TourCalendar";

export default {
    name: "TourCalendarPopup",
    components: {TourCalendar, Popup},
    props: {
        tour: Object,
        events: Array,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.orderTour.calendarOpen);
        const closePopup = () => store.commit('orderTour/SET_CALENDAR_OPEN', false);

        const onClick = (event) => {
            store.commit('orderTour/SET_CALENDAR_OPEN', false);
            store.commit('orderTour/UPDATE_FORM_DATA', {schedule_id: event.id});
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
