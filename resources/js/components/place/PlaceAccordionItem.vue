<template>
    <div class="accordion-item">
        <div class="accordion-title" @click="$emit('load-place', {district, place})"
             v-html="place.text + '<i></i>'"></div>

        <div class="accordion-inner">

            <template v-if="place.media">
                <swiper-slider :media="place.media" class="swiper-entry"/>
                <div class="spacer-xs"></div>
            </template>

            <div class="text text-md">
                <p v-html="place.description"></p>

                <a :href="place.url" class="btn btn-read-more text-bold">Більше</a>
            </div>
        </div>
    </div>
</template>

<script>
import SwiperSlider from "../common/SwiperSlider";

export default {
    name: "PlaceAccordionItem",
    components: {SwiperSlider},
    props: {
        place: Object,
        district: Object,
    },
    emits: ['load-place']
}
</script>

<style scoped>

</style>
