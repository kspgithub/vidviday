<template>
    <div>
        <div class="swiper-button-prev" v-if="buttons" ref="prevRef">
            <i></i>
        </div>
        <div class="swiper-button-next" v-if="buttons" ref="nextRef">
            <i></i>
        </div>
        <div class="swiper-container swiper-vue" ref="swiperRef">
            <div class="swiper-wrapper lightbox-wrap">
                <div class="swiper-slide" v-for="(slide, idx) in media">
                    <div class="img zoom">
                        <img class="swiper-lazy" v-bind="imgAttrs(slide, idx)">
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


import { computed, onMounted, reactive, ref } from 'vue'
import { useStore } from 'vuex'

export default {
    name: 'SwiperSlider',

    props: {
        media: Array,
        options: {
            type: Object,
            default() {
                return {}
            },
        },
        buttons: {
            type: Boolean,
            default: false,
        },
    },
    setup(props) {
        const store = useStore()
        const swiper = ref()
        const swiperRef = ref()
        const paginationRef = ref()
        const nextRef = ref()
        const prevRef = ref()
        const slider = ref()

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
            slidesPerView: 3,
            spaceBetween: 15,
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
                },
            },
            pagination: {
                clickable: true,
                el: paginationRef,
                dynamicBullets: true,
                dynamicMainBullets: 5,
            },
            navigation: {
                nextEl: nextRef,
                prevEl: prevRef,
            },
        }, props.options))

        const setController = (instance) => {
            swiper.value = instance
        }

        const hidePopup = () => {
            store.commit('popupGallery/SET_ACTIVE', false)
        }

        const showPopup = (index) => {
            store.commit('popupGallery/SET_MEDIA', props.media)
            store.commit('popupGallery/SET_CURRENT_SLIDE', index)
            store.commit('popupGallery/SET_ACTIVE', true)
        }

        var observerHandler = (e) => {
            // console.log('observerUpdate', e)
            // Update on parent node change
            if (e.target.contains(swiperRef.value) && e.attributeName === 'style' && e.target.style.display !== 'none') {
                initDynamicPagination()
            }
        }

        const initDynamicPagination = function () {
            // console.log('initDynamicPagination')

            const pagination = swiper.value.pagination

            if (pagination && typeof pagination.bullets !== 'undefined') {

                const bullets = Object.values(pagination.bullets).filter(bullet => bullet instanceof Element)

                if (bullets.length) {
                    swiper.value.off('observerUpdate', observerHandler)
                }

                const totalBullets = bullets.length

                if (totalBullets > 5) {
                    const maxIndex = totalBullets - 1
                    const activeIndex = bullets.findIndex((bullet, i) => bullet.classList.contains('swiper-pagination-bullet-active'))

                    const visibleIndexes = [activeIndex]

                    for (let i = 1; i < 3; i++) {
                        let index, currentIndex = activeIndex + i

                        if (currentIndex >= maxIndex) {
                            index = currentIndex - maxIndex
                        } else {
                            index = currentIndex
                        }
                        visibleIndexes.push(index)
                    }

                    for (let i = 1; i < 3; i++) {
                        let index, currentIndex = activeIndex - i

                        if (currentIndex < 0) {
                            index = maxIndex + currentIndex + 1
                        } else {
                            index = currentIndex
                        }
                        visibleIndexes.push(index)
                    }

                    $(bullets).each((index, bullet) => {
                        if (visibleIndexes.includes(index)) {
                            $(bullet).addClass('visible').show()
                        } else {
                            $(bullet).removeClass('visible').hide()
                        }
                    })

                }

            }
        }

        onMounted(() => {

            swiper.value = new window.Swiper(swiperRef.value, options.value)

            slider.value = $(swiperRef.value).closest('.swiper-entry')

            swiper.value.on('slideChangeTransitionStart', () => {
                if (slider.value.hasClass('popup-gallery-slider')) {
                    let customFraction = slider.value.closest('.popup-align').find('.pagination-fraction .text-bold'),
                        activeSlideIndex = slider.value.find('.swiper-slide-active').index()
                    $(customFraction).html(activeSlideIndex + 1)
                }
            })

            swiper.value.on('slideChange', () => {
                initDynamicPagination()
            })

            const isVisible = $(swiperRef.value).is(':visible')

            if (isVisible) {
                initDynamicPagination()
            } else {
                if (swiper.value.pagination && typeof swiper.value.pagination.bullets !== 'undefined') {
                    swiper.value.on('observerUpdate', observerHandler)
                }
            }

        })

        const imgAttrs = computed(() => (slide, idx) => {
            const attrs = {
                alt: slide.alt,
                title: slide.title,
            }

            const isLazy = idx > options.value.slidesPerView

            attrs[isLazy ? 'data-src' : 'src'] = slide['thumb']

            if(isLazy) {
                attrs['loading'] = 'lazy'
            }

            return attrs
        })

        return {
            imgAttrs,
            swiperRef,
            paginationRef,
            nextRef,
            prevRef,
            setController,
            showPopup,
            hidePopup,
        }
    },
}
</script>
