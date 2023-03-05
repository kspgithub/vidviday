<template>
    <div>
        <div class="only-pad-mobile">
            <seo-button code="tour.search"
                        tag="span"
                        class="btn type-5 arrow-right text-left flex"
            >
                <img alt="filter-dark" src="/icon/filter-dark.svg">{{ __('tours-section.search-btn') }}
            </seo-button>
            <div class="spacer-xs"></div>
        </div>
        <div class="section text-center">
            <div class="spacer-xs"></div>
            <h1 class="h1 title">
                {{ __('tours-section.empty-results') }}
            </h1>
            <div class="text text-md">
                <p>{{ __('tours-section.empty-proposal') }}</p>
            </div>
            <div class="spacer-xs"></div>
            <seo-button code="goto.home" class="btn type-1" href="/">{{ __('tours-section.go-home') }}</seo-button>
            <div class="spacer-lg"></div>
            <hr>
            <div class="spacer-xs"></div>
        </div>

        <tour-slider v-if="popularTours.length" :tours="popularTours" :title="__('tours-section.popular-title')"/>
    </div>

</template>

<script>
import TourSlider from "./TourCarousel";
import {computed} from "vue";
import {useStore} from "vuex";
import SeoButton from '../common/SeoButton.vue'

export default {
    name: "TourEmptyResult",
    components: {SeoButton, TourSlider},
    setup() {
        const store = useStore();
        const popularTours = computed(() => store.state.tourFilter.popularTours);
        return {
            popularTours,
        }
    }
}
</script>

<style scoped>

</style>
