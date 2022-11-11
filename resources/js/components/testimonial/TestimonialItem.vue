<template>
    <div :id="'testimonial-' + item.id" class="review-item">
        <div class="spacer-xs"></div>
        <div class="review testimonial clear-bottom">
            <div class="review-header">
                <div class="review-img">
                    <img v-if="item.avatar || !item.initials" :src="item.avatar_url" :alt="item.name" />
                    <div v-if="!item.avatar && !!item.initials" class="full-size h4">{{ item.initials }}</div>
                </div>
                <div class="review-title">
                    <span class="h4">{{ item.name }}</span>
                    <span class="text text-sm">{{ item.date }}</span>
                    <span class="text text-sm">{{ item.time }}</span>
                    <span v-if="item.on_moderation" class="text text-sm">{{
                        __('tours-section.reviews.in-moderation')
                    }}</span>
                    <star-rating v-if="!item.parent_id" :value="item.rating" />
                    <span class="text" @click="showAnswerForm">{{ __('forms.reply') }}</span>
                </div>
            </div>
            <div class="text text-md">
                <p v-if="!item.parent_id && item.type === 'tour' && item.tour">
                    Тур: <a :href="item.tour.url">{{ item.tour.title }}</a>
                </p>
                <p v-if="!item.parent_id && item.type === 'tour' && item.guide">
                    Гід: <b>{{ item.guide.name }}</b>
                </p>
                <div class="seo-text load-more-wrapp p-0 m-0">
                    <template v-if="item.short_text.length >= textMaxLength + 3">
                        <div class="less-info">
                            <p>
                                <span v-if="item.parent" class="label">{{ item.parent.name }}</span>
                                {{ item.short_text }}
                            </p>
                        </div>
                        <div class="more-info">
                            <p>
                                <span v-if="item.parent" class="label">{{ item.parent.name }}</span>
                                {{ item.text }}
                            </p>
                        </div>

                        <div class="show-more">
                            <span v-text="__('common.read-more')"></span>
                            <span v-text="__('common.hide-text')"></span>
                        </div>
                    </template>
                    <p v-else>
                        <span v-if="item.parent" class="label">{{ item.parent.name }}</span>
                        {{ item.text }}
                    </p>
                </div>
            </div>
            <div v-if="item.gallery && item.gallery.length > 0" class="spacer-xs"></div>
            <swiper-slider
                v-if="item.gallery.length > 0"
                :key="'swp-' + item.id"
                class="swiper-entry"
                :media="item.gallery"
                :buttons="false"
                :options="{
                    slidesPerView: 3,
                    spaceBetween: 15,
                    breakpoints: {
                        992: { slidesPerView: 4, spaceBetween: 22 },
                        1200: { slidesPerView: 5, spaceBetween: 22 },
                    },
                }"
            ></swiper-slider>
        </div>
        <slide-up-down :key="'tsma-' + item.id" v-model="answer" :duration="300">
            <testimonial-answer
                :key="'answ' + item.id"
                :item="item"
                @cancel="onAnswerCancel"
                @success="onAnswerSuccess"
            />
        </slide-up-down>
        <div v-if="!answer" class="spacer-xxs"></div>
        <div v-if="item.children_count > 0 || children.length > 0" class="load-more-wrapp">
            <div class="show-more-btn" :class="{ active: showMore }" @click="showChildren()">
                <span v-if="!showMore">{{ __('common.show-answers') }}</span>
                <span v-if="showMore">{{ __('common.hide-answers') }}</span>
            </div>
            <slide-up-down :key="'tsmc-' + item.id" v-model="showMore" :duration="300" class="ps-30">
                <testimonial-item v-for="child in children" :key="'tm-' + child.id" :item="child" />
            </slide-up-down>
        </div>
    </div>
</template>

<script>
import FormStarRating from '../form/FormStarRating'
import StarRating from '../common/StarRating'
import { computed, nextTick, ref } from 'vue'

import TestimonialAnswer from './TestimonialAnswer'
import { useStore } from 'vuex'
import SwiperSlider from '../common/SwiperSlider'
import SlideUpDown from '../common/SlideUpDown'

export default {
    name: 'TestimonialItem',
    components: { SlideUpDown, SwiperSlider, TestimonialAnswer, StarRating, FormStarRating },
    props: {
        item: Object,
        textMaxLength: {
            type: Number,
            default: 120,
        },
    },
    emits: ['add'],
    setup(props, { emit }) {
        const store = useStore()
        const currentUser = computed(() => store.state.user.currentUser)
        const answer = ref(false)
        const showMore = ref(false)
        const children = ref([])

        const showAnswerForm = () => {
            if (currentUser.value) {
                answer.value = true
            } else {
                store.commit('testimonials/SET_PARENT_ID', props.item.id)
                store.commit('testimonials/SET_POPUP_OPEN', true)
                store.commit('testimonials/SET_CALLBACK', response => {
                    if (response.result === 'success') {
                        children.value = [response.testimonial || response.question, ...children.value]
                        answer.value = false

                        setTimeout(() => {
                            let loadMoreWrap = $('#testimonial-' + (response.testimonial?.id || response.question?.id))
                                .parents('.load-more-wrapp')
                                .first()

                            if (loadMoreWrap.length) {
                                let showMoreBtn = $(loadMoreWrap).find('.show-more-btn')
                                if (!$(showMoreBtn).hasClass('active')) {
                                    $(showMoreBtn).click()
                                }
                            }
                        }, 500)
                    } else {
                        toast.error(response.message)
                    }
                })
            }
        }

        const onAnswerCancel = () => {
            answer.value = false
        }

        const onAnswerSuccess = async text => {
            const response = await store.dispatch('testimonials/answer', { text: text, parent_id: props.item.id })
            if (response.result === 'success') {
                children.value = [response.testimonial, ...children.value]
                answer.value = false
                await store.dispatch('userQuestion/showThanks', {
                    title: response.message,
                })

                let loadMoreWrap = $('#testimonial-' + (response.testimonial?.id || response.question?.id))
                    .parents('.load-more-wrapp')
                    .first()
                if (loadMoreWrap.length) {
                    let showMoreBtn = $(loadMoreWrap).find('.show-more-btn')
                    if (!$(showMoreBtn).hasClass('active')) {
                        $(showMoreBtn).click()
                    }
                }
            } else {
                toast.error(response.message)
            }
        }

        const showChildren = async () => {
            if (showMore.value) {
                showMore.value = false
            } else {
                if (children.value.length === 0) {
                    const testimonials = await store.dispatch('testimonials/children', props.item.id)
                    children.value = testimonials || []
                }
                await nextTick(() => {
                    showMore.value = true
                })
            }
        }

        return {
            answer,
            showMore,
            children,
            onAnswerCancel,
            onAnswerSuccess,
            showAnswerForm,
            showChildren,
        }
    },
}
</script>

<style scoped></style>
