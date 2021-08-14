<template>
    <div>
        <div class="only-pad-mobile">
            <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex">
                <img alt="filter-dark" src="/icon/filter-dark.svg">Підбір туру
            </span>
            <div class="spacer-xs"></div>
        </div>
        <div class="section text-center">
            <div class="spacer-xs"></div>
            <h1 class="h1 title">Нажаль, за вашим запитом нічого не знайдено</h1>
            <div class="text text-md">
                <p>Пропонуємо почати з головної сторінки</p>
            </div>
            <div class="spacer-xs"></div>
            <a class="btn type-1" href="/">На головну</a>
            <div class="spacer-lg"></div>
            <hr>
            <div class="spacer-xs"></div>
        </div>

        <tour-slider v-if="popularTours.length" :tours="popularTours" title="Популярні тури"/>
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
