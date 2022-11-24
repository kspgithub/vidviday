<template>
    <div class="section">
        <h2 class="h2">{{ title }}</h2>
        <div class="spacer-xs"></div>

        <div class="thumbs-carousel swiper-entry swiper-vue">
            <swiper
                :resize-observer="swiperOptions.resizeObserver"
                :update-on-window-resize="swiperOptions.updateOnWindowResize"
                :observe-parents="swiperOptions.observeParents"
                :watch-overflow="swiperOptions.watchOverflow"
                :round-lengths="swiperOptions.roundLengths"
                :watch-slides-visibility="swiperOptions.watchSlidesVisibility"
                :watch-slides-progress="swiperOptions.watchSlidesProgress"
                :center-insufficient-slides="swiperOptions.centerInsufficientSlides"
                :speed="swiperOptions.speed"
                :preload-images="swiperOptions.preloadImages"
                :update-on-images-ready="swiperOptions.updateOnImagesReady"
                :breakpoints="swiperOptions.breakpoints"
                :pagination="swiperOptions.pagination"
                :slides-per-view="swiperOptions.slidesPerView"
                :slides-per-group="swiperOptions.slidesPerGroup"
                :space-between="swiperOptions.spaceBetween"
                :auto-height="true"
                @swiper="setController"


            >
                <swiper-slide v-for="tour in tours">
                    <tour-card :key="'tour-slide-'+tour.id" :tour="tour" :like-btn="!!$store.state.user.currentUser"/>
                </swiper-slide>
            </swiper>
            <div class="swiper-button-prev bottom" @click="prevSlide()">
                <i></i>
            </div>
            <div class="swiper-pagination-placeholder"></div>
            <div class="swiper-button-next bottom" @click="nextSlide()">
                <i></i>
            </div>

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
    name: "TourCarousel",
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
            preloadImages: true,
            updateOnImagesReady: true,
            roundLengths: true,
            updateOnWindowResize: true,
            resizeObserver: true,
            observer: true,
            observeParents: true,
            watchOverflow: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            centerInsufficientSlides: false,
            speed: 900,
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 20,
            breakpoints: {
                1200: {
                    slidesPerGroup: 3,
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerGroup: 3,
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerGroup: 2,
                    slidesPerView: 2,
                    spaceBetween: 20,
                }
            },
            pagination: {
                clickable: true,
                // dynamicBullets: true,
                // dynamicMainBullets: 5,
            },
            navigation: true,

        }, props.options));

        const setController = (instance) => {
            swiper.value = instance;

            const paginator = $(swiper.value.el).find('.swiper-pagination')
                const paginatorPlaceholder = $(swiper.value.el).parent().find('.swiper-pagination-placeholder')

            // $(paginator).addClass('relative fixed-width bottom')

            if(paginatorPlaceholder.length) {
                paginatorPlaceholder.replaceWith(paginator)
            } else {
                paginator.appendTo(paginator.parents('.swiper-entry').first())
            }

            _functions.initDynamicPagination(swiper.value)

            instance.on('slideChange', (e) => {
                _functions.initDynamicPagination(swiper.value)
            })
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
