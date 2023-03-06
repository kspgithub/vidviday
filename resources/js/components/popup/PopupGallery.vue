<template>
    <popup :active="visible" size="size-3-new" @hide="hide()">
        <div class="popup-align">
            <div class="pagination-fraction">
                <span class="text-bold">{{ activeIndex }}</span> / <span>{{ media.length }}</span>
            </div>
            <div class="swiper-entry popup-gallery-slider">
                <div class="swiper-container swiper-vue" ref="swiperRef">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" v-for="(slide, idx) in media">
                            <img :data-src="slide.url" :title="slide.title" :alt="slide.alt" class="swiper-lazy">
                            <div class="swiper-lazy-preloader"></div>
                            <span class="text-md text-medium">{{ slide.title }}</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-prev" ref="prevRef" @click="prevSlide()">
                    <i></i>
                </div>
                <div class="swiper-pagination" ref="paginationRef"></div>
                <div class="swiper-button-next" ref="nextRef" @click="nextSlide()">
                    <i></i>
                </div>
            </div>
            <div class="btn-close" @click.stop="hide()">
                <span></span>
            </div>
        </div>
    </popup>


</template>

<script>
import Popup from "./Popup";
import {computed, onMounted, ref, watch} from "vue";
import {useStore} from "vuex";

export default {
    name: "PopupGallery",
    components: {Popup},
    props: {},
    setup(props) {
        const store = useStore();
        const visible = computed(() => store.state.popupGallery.active);
        const media = computed(() => store.state.popupGallery.media);
        const currentSlide = computed(() => store.state.popupGallery.currentSlide);

        const swiper = ref(null);
        const swiperRef = ref(null);
        const slider = ref(null);
        const paginationRef = ref(null);
        const nextRef = ref(null);
        const prevRef = ref(null);
        const activeIndex = ref(1);

        const nextSlide = () => {
            swiper.value.slideNext();
        }

        const prevSlide = () => {
            swiper.value.slidePrev();
        }

        const initDynamicPagination = function () {
            // console.log('initDynamicPagination')

            const pagination = swiper.value.pagination

            if(pagination && typeof pagination.bullets !== 'undefined') {

                const bullets = Object.values(pagination.bullets).filter(bullet => bullet instanceof Element)

                const totalBullets = bullets.length

                if(totalBullets > 5) {
                    const maxIndex = totalBullets - 1
                    const activeIndex = bullets.findIndex((bullet, i) => bullet.classList.contains('swiper-pagination-bullet-active'))

                    const visibleIndexes = [activeIndex];

                    for(let i = 1; i < 3; i++) {
                        let index, currentIndex = activeIndex + i;

                        if(currentIndex >= maxIndex) {
                            index = currentIndex - maxIndex
                        } else {
                            index = currentIndex
                        }
                        visibleIndexes.push(index)
                    }

                    for(let i = 1; i < 3; i++) {
                        let index, currentIndex = activeIndex - i;

                        if(currentIndex < 0) {
                            index = maxIndex + currentIndex + 1
                        } else {
                            index = currentIndex
                        }
                        visibleIndexes.push(index)
                    }

                    $(bullets).each((index, bullet) => {
                        if(visibleIndexes.includes(index)) {
                            $(bullet).addClass('visible').show()
                        } else {
                            $(bullet).removeClass('visible').hide()
                        }
                    })
                }
            }
        }

        onMounted(() => {
            swiper.value = new window.Swiper(swiperRef.value, {
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
                spaceBetween: 0,
                autoHeight: true,
                mousewheel: true,
                initialSlide: currentSlide.value,
                pagination: {
                    clickable: true,
                    el: paginationRef.value,

                },

            });

            slider.value = $(swiperRef.value).closest('.swiper-entry')

            swiper.value.on('slideChangeTransitionStart', () => {
                if (slider.value.hasClass('popup-gallery-slider')) {
                    let customFraction = slider.value.closest('.popup-align').find('.pagination-fraction .text-bold'),
                        activeSlideIndex = slider.value.find('.swiper-slide-active').index();
                    $(customFraction).html(activeSlideIndex + 1);
                }
            })

            swiper.value.on('slideChange', () => {
                activeIndex.value = swiper.value.realIndex + 1;

                initDynamicPagination()
            })

        });

        watch(currentSlide, () => {
            swiper.value.slideTo(currentSlide.value, 0);
            activeIndex.value = currentSlide.value + 1;
        })

        watch(visible, () => {
            setTimeout(() => initDynamicPagination(), 250)
        })

        const hide = () => {
            store.commit('popupGallery/SET_ACTIVE', false);
        }

        return {
            swiperRef,
            paginationRef,
            nextRef,
            prevRef,

            nextSlide,
            prevSlide,
            activeIndex,
            hide,
            visible,
            media,
        }
    }
}
</script>

<style scoped>

</style>
