<template>
    <div>
        <div class="only-pad-mobile">
            <span v-bind="$buttons.tour.search" class="btn type-5 arrow-right text-left flex">
                <img alt="filter-dark" src="/icon/filter-dark.svg">{{ __('tours-section.search-btn') }}
            </span>
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
            <a v-bind="$buttons.goto.home" class="btn type-1" href="/">{{ __('tours-section.go-home') }}</a>
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

export default {
    name: "TourEmptyResult",
    components: {TourSlider},
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
