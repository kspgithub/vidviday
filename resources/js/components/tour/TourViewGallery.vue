<template>
    <div class="tab active">
        <div class="spacer-xs"></div>
        <tour-sort-form/>
        <div class="spacer-xs"></div>
        <div :class="{loading: fetchRequest}" class="thumb-wrap row">
            <div v-for="tour in tours" class="col-lg-4 col-sm-6 col-12 d-flex">
                <tour-card :key="'tour-'+tour.id" :tour="tour" :like-btn="!!$store.state.user.currentUser"/>
            </div>

            <div class="col-12">
                <div class="spacer-xs"></div>
                <div class="text-center">
                    <div class="pagination">
                        <seo-button code="tour.show_less" class="btn type-2" @click.prevent="prevPage()" :disabled="currentPage === 1">
                            &laquo; 
                        </seo-button>
                        <span class="pagination-info">
                            Сторінка {{ currentPage }} из {{ lastPage }}
                        </span>
                        <seo-button code="tour.show_more" class="btn type-2" @click.prevent="nextPage();" :disabled="currentPage === lastPage">
                            &raquo;
                        </seo-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TourSortForm from "./TourSortForm";
import TourCard from "./TourCard";

import useTourView from "./useTourView";
import SeoButton from '../common/SeoButton.vue'

export default {
    name: "TourViewGallery",
    components: {SeoButton, TourCard, TourSortForm},
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
