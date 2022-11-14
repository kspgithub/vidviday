<template>
    <div class="tab active">
        <div class="spacer-xs"></div>
        <tour-sort-form />
        <div class="spacer-xs"></div>
        <div :class="{ loading: fetchRequest }" class="thumb-wrap row">
            <div v-for="tour in tours" class="col-lg-4 col-sm-6 col-12 d-flex">
                <tour-card :key="'tour-' + tour.id" :tour="tour" :like-btn="!!$store.state.user.currentUser" />
            </div>

            <div v-if="currentPage < lastPage" class="col-12">
                <div class="spacer-xs"></div>
                <div class="text-center">
                    <a class="btn type-2" @click.prevent="nextPage()">
                        {{ __('tours-section.show-more') }} {{ perPage }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TourSortForm from './TourSortForm'
import TourCard from './TourCard'

import useTourView from './useTourView'

export default {
    name: 'TourViewGallery',
    components: { TourCard, TourSortForm },
    setup() {
        return {
            ...useTourView(),
        }
    },
}
</script>

<style scoped></style>
