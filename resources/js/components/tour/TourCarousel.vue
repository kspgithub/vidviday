<template>
    <div class="section">
        <h2 class="h2">{{ title }}</h2>
        <div class="spacer-xs"></div>

        <div class="thumbs-carousel swiper-entry swiper-vue">
            <div class="swiper-button-prev bottom" @click="prevSlide()">
                <i></i>
            </div>
            <div class="swiper-button-next bottom" @click="nextSlide()">
                <i></i>
            </div>
            <swiper
                :breakpoints="swiperOptions.breakpoints"
                :pagination="swiperOptions.pagination"
                :slides-per-view="swiperOptions.slidesPerView"
                :space-between="swiperOptions.spaceBetween"
                @swiper="setController"


            >
                <swiper-slide v-for="tour in tours">
                    <tour-card :key="'tour-slide-'+tour.id" :tour="tour"/>
                </swiper-slide>
            </swiper>

        </div>
    </div>
</template>

<script>
import TourCard from "./TourCard";
import {ref} from "vue";

import SwiperCore, {Navigation, Pagination, Controller} from 'swiper';

SwiperCore.use([Navigation, Pagination, Controller]);
import {Swiper, SwiperSlide} from 'swiper/vue';

export default {
    name: "TourSlider",
    components: {TourCard, Swiper, SwiperSlide},
    props: {
        tours: Array,
        title: String,
        options: {
            type: Object,
            default() {
                return {}
            }
        }
    },
    setup(props) {
        const swiper = ref(null);

        const swiperOptions = ref(Object.assign({
            loop: true,
            lazy: {loadPrevNext: true},
            preloadImages: false,
            roundLengths: false,
            observer: true,
            observeParents: true,
            watchOverflow: true,
            watchSlidesVisibility: true,
            centerInsufficientSlides: false,
            speed: 900,
            slidesPerView: 1,
            spaceBetween: 20,
            breakpoints: {
                1200: {
                    slidesPerView: 3
                },
                992: {
                    slidesPerView: 3
                },
                768: {
                    slidesPerView: 2
                }
            },
            pagination: {
                clickable: true,
            },
            navigation: true,

        }, props.options));

        const setController = (instance) => {
            swiper.value = instance;
        }

        const nextSlide = () => {
            swiper.value.slideNext();
        }

        const prevSlide = () => {
            swiper.value.slidePrev();
        }
        return {
            swiperOptions,
            setController,
            nextSlide,
            prevSlide,
        }
    }
}
</script>

<style scoped>

</style>
