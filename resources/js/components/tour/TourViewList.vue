<template>
    <div class="tab active">
        <div class="spacer-xs"></div>
        <tour-sort-form/>
        <div class="spacer-xs"></div>
        <div :class="{loading: fetchRequest}">
            <tour-card-list v-for="tour in tours" :key="'tour-'+tour.id" :tour="tour"
                            :like-btn="!!$store.state.user.currentUser"/>
        </div>
        <div class="spacer-xs"></div>
        <div v-if="currentPage < lastPage" class="text-center">
            <seo-button code="tour.show_more" class="btn type-2" @click.prevent="nextPage()">{{ __('tours-section.show-more') }} {{ perPage }}</seo-button>
        </div>
    </div>
</template>

<script>
import TourSortForm from "./TourSortForm";
import TourCardList from "./TourCardList";
import useTourView from "./useTourView";

export default {
    name: "TourViewList",
    components: {TourCardList, TourSortForm},
    props: {
        tour: {
            type: Object,
            default() {
                return {
                    title: {uk: ''},
                    short_text: {uk: ''},
                    schedule_items: []
                }
            }
        },
        active: Boolean,
    },
    setup() {

        return {
            ...useTourView(),
        }
    }
}
</script>

<style scoped>

</style>
