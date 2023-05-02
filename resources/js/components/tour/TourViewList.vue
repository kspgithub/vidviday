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

        <div class="text-center">
            <div class="pagination">
                <seo-button code="tour.show_less" class="btn type-2" @click.prevent="prevPage()" :disabled="currentPage === 1">
                    &laquo; 
                </seo-button>
                <span class="pagination-info">
                    Cторінка {{ currentPage }} из {{ lastPage }}
                </span>
                <seo-button code="tour.show_more" class="btn type-2" @click.prevent="nextPage();" :disabled="currentPage === lastPage">
                    &raquo;
                </seo-button>
            </div>
        </div>
    </div>
</template>

<script>
import TourSortForm from "./TourSortForm";
import TourCardList from "./TourCardList";
import useTourView from "./useTourView";
import SeoButton from '../common/SeoButton.vue'

export default {
    name: "TourViewList",
    components: {SeoButton, TourCardList, TourSortForm},
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
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
}

.pagination-info {
  font-size: 14px;
  margin: 5px;
}
</style>
