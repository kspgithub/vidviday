<template>
    <div class="tabs">
        <tour-tab-nav/>
        <div class="tabs-wrap">
            <transition name="fade">
                <tour-view-gallery v-if="viewType === 'gallery'"/>
            </transition>
            <transition name="fade">
                <tour-view-list v-if="viewType === 'list'"/>
            </transition>
            <transition name="fade">
                <tour-view-calendar v-if="viewType === 'calendar'"/>
            </transition>
        </div>
    </div>
</template>

<script>
import TourTabNav from "./TourTabNav";
import {computed} from "vue";
import {useStore} from "vuex";
import TourViewGallery from "./TourViewGallery";
import TourViewList from "./TourViewList";
import TourViewCalendar from "./TourViewCalendar";

export default {
    name: "TourSearch",
    components: {TourViewCalendar, TourViewList, TourViewGallery, TourTabNav},
    setup() {
        const store = useStore();


        const viewType = computed(() => store.state.tourFilter.viewType);

        store.dispatch('tourFilter/fetchTours');

        return {
            viewType,
        }
    }
}
</script>

<style scoped>

</style>
