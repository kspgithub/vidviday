<template>
    <div>
        <spinner v-if="loading"/>
        <div v-if="total > 0 &&  !loading">
            <mobile-btns-bar/>
            <template v-if="showTitle">
                <tour-request-title/>
                <div class="spacer-xs"></div>
                <hr>
                <div class="spacer-xs"></div>
            </template>
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
        </div>
        <tour-empty-result v-if="total === 0 && !loading"/>
    </div>

</template>

<script>
import TourTabNav from "./TourTabNav";
import {computed, onUnmounted, ref} from "vue";
import {useStore} from "vuex";
import TourViewGallery from "./TourViewGallery";
import TourViewList from "./TourViewList";
import TourViewCalendar from "./TourViewCalendar";
import TourEmptyResult from "./TourEmptyResult";
import * as urlUtils from '../../utils/url';
import MobileBtnsBar from "../mobile/MobileBtnsBar";
import Spinner from "../spinner";
import TourRequestTitle from "./TourRequestTitle";

export default {
    name: "TourSearch",
    components: {
        TourRequestTitle,
        Spinner, MobileBtnsBar, TourEmptyResult, TourViewCalendar, TourViewList, TourViewGallery, TourTabNav
    },
    props: {
        showTitle: Boolean
    },
    setup() {
        const store = useStore();
        const viewType = computed(() => store.state.tourFilter.viewType);
        const params = computed(() => store.getters['tourFilter/formData']);
        const defaultParams = computed(() => store.getters['tourFilter/defaultData']);
        const total = computed(() => store.state.tourFilter.pagination.total);
        const loading = ref(true);


        store.dispatch('tourFilter/fetchPopularTours');

        const unsubscribe = store.subscribeAction({
            after: async (action, state) => {
                if (action.type === 'tourFilter/initFilter') {

                    const query = urlUtils.filterParams(params.value, defaultParams.value);
                    await store.dispatch('tourFilter/fetchTours', query);
                    loading.value = false;
                }
            }
        })


        onUnmounted(() => {
            unsubscribe();
        })

        return {
            viewType,
            total,
            loading,
        }
    }
}
</script>

<style scoped>

</style>
