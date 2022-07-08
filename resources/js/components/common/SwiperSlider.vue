<template>
    <div>
        <div class="swiper-button-prev" v-if="buttons" ref="prevRef" @click="prevSlide()">
            <i></i>
        </div>
        <div class="swiper-button-next" v-if="buttons" ref="nextRef" @click="nextSlide()">
            <i></i>
        </div>
        <div class="swiper-container swiper-vue" ref="swiperRef">
            <div class="swiper-wrapper lightbox-wrap">
                <div class="swiper-slide" v-for="(slide, idx) in media">
                    <div class="img zoom">
                        <img :src="slide.thumb" :title="slide.title" :alt="slide.alt" class="swiper-lazy">
                        <div class="swiper-lazy-preloader"></div>
                        <div class="full-size" @click="showPopup(idx)"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="only-mobile swiper-pagination" ref="paginationRef"></div>
    </div>

</template>

<script>


import {onMounted, reactive, ref} from "vue";
import {useStore} from "vuex";

export default {
    name: "SwiperSlider",

    props: {
        media: Array,
        options: {
            type: Object,
            default() {
                return {}
            }
        },
        buttons: {
            type: Boolean,
            default: false,
        }
    },
    setup(props) {
        const store = useStore();
        const swiper = ref(null);
        const swiperRef = ref(null);
        const paginationRef = ref(null);
        const nextRef = ref(null);
        const prevRef = ref(null);

        const options = ref(Object.assign({
            loop: false,
            lazy: true,
            preloadImages: false,
            roundLengths: false,
            observer: true,
            observeParents: true,
            watchOverflow: true,
            watchSlidesVisibility: true,
            centerInsufficientSlides: false,
            speed: 900,
            slidesPerView: 4,
            spaceBetween: 0,
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 22,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 22,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                }
            },
            pagination: {
                clickable: true,
                el: paginationRef.value,
            },
            navigation: {
                nextEl: nextRef.value,
                prevRef: prevRef.value,
            },

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

        const hidePopup = () => {
            store.commit('popupGallery/SET_ACTIVE', false);
        }

        const showPopup = (index) => {
            store.commit('popupGallery/SET_MEDIA', props.media);
            store.commit('popupGallery/SET_CURRENT_SLIDE', index);
            store.commit('popupGallery/SET_ACTIVE', true);
        }


        onMounted(() => {
            swiper.value = new window.Swiper(swiperRef.value, options.value);
        });

        return {
            swiperRef,
            paginationRef,
            nextRef,
            prevRef,
            setController,
            nextSlide,
            prevSlide,
            showPopup,
            hidePopup,
        }
    }
}
</script>

<style scoped>

</style>
