<template>
    <div class="review-item">
        <div class="spacer-xs"></div>
        <div class="review testimonial clear-bottom">
            <div class="review-header">
                <div class="review-img">
                    <img v-if="item.avatar || !item.initials" :src="item.avatar_url" :alt="item.name">
                    <div v-if="!item.avatar && !!item.initials" class="full-size h4">{{ item.initials }}</div>
                </div>
                <div class="review-title">
                    <span class="h4">{{ item.name }}</span>
                    <span class="text text-sm">{{ item.date }}</span>
                    <span class="text text-sm">{{ item.time }}</span>
                    <star-rating v-if="!item.parent_id" :value="item.rating"/>
                    <span class="text" @click="showAnswerForm">Відповісти</span>
                </div>
            </div>
            <div class="text text-md">
                <p v-if="!item.parent_id && item.type === 'tour' && item.tour">
                    Тур: <a :href="item.tour.url">{{ item.tour.title }}</a>
                </p>
                <p v-if="!item.parent_id && item.type === 'tour' && item.guide">
                    Гід: <b>{{ item.guide.name }}</b>
                </p>
                <p>
                    <span class="label" v-if="item.parent">{{ item.parent.name }}</span>
                    {{ item.text }}
                </p>
            </div>
            <div class="spacer-xs" v-if="item.gallery && item.gallery.length > 0"></div>
            <swiper-slider :key="'swp-'+item.id" class="swiper-entry" :media="item.gallery"
                           v-if="item.gallery.length > 0" :buttons="false"
                           :options="{slidesPerView: 3, spaceBetween: 15, breakpoints: {992: {slidesPerView: 4, spaceBetween: 22}, 1200: {slidesPerView: 5, spaceBetween: 22}}}"></swiper-slider>
        </div>
        <slide-up-down v-model="answer" :duration="300" :key="'tsma-'+item.id">
            <testimonial-answer :item="item" :key="'answ'+item.id" @cancel="onAnswerCancel" @success="onAnswerSuccess"/>
        </slide-up-down>
        <div class="spacer-xxs" v-if="!answer"></div>
        <div class="load-more-wrapp" v-if="item.children_count > 0 || children.length > 0">
            <div class="show-more-btn" :class="{active: showMore}" @click="showChildren()">
                <span v-if="!showMore">Показати відповіді</span>
                <span v-if="showMore">Приховати відповіді</span>
            </div>
            <slide-up-down v-model="showMore" :duration="300" :key="'tsmc-'+item.id" class="ps-30">
                <testimonial-item v-for="child in children" :item="child" :key="'tm-'+child.id"/>
            </slide-up-down>
        </div>
    </div>
</template>

<script>
import FormStarRating from "../form/FormStarRating";
import StarRating from "../common/StarRating";
import {computed, nextTick, ref} from "vue";

import TestimonialAnswer from "./TestimonialAnswer";
import {useStore} from "vuex";
import SwiperSlider from "../common/SwiperSlider";
import SlideUpDown from "../common/SlideUpDown";

export default {
    name: "TestimonialItem",
    components: {SlideUpDown, SwiperSlider, TestimonialAnswer, StarRating, FormStarRating},
    props: {
        item: Object,
    },
    setup(props) {
        const store = useStore();
        const currentUser = computed(() => store.state.user.currentUser);
        const answer = ref(false);
        const showMore = ref(false);
        const children = ref([]);

        const showAnswerForm = () => {
            if (currentUser.value) {
                answer.value = true;
            }
        }

        const onAnswerCancel = () => {
            answer.value = false;
        }

        const onAnswerSuccess = async (text) => {
            const response = await store.dispatch('testimonials/answer', {text: text, parent_id: props.item.id});
            if (response.result === 'success') {
                children.value = [response.testimonial, ...children.value];
                answer.value = false;
                await store.dispatch('userQuestion/showThanks', {
                    title: response.message,
                })
            } else {
                toast.error(response.message);
            }

        }


        const showChildren = async () => {

            if (showMore.value) {
                showMore.value = false;
            } else {
                if (children.value.length === 0) {
                    const testimonials = await store.dispatch('testimonials/children', props.item.id);
                    children.value = testimonials || [];
                }
                await nextTick(() => {
                    showMore.value = true;
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
    }
}
</script>

<style scoped>

</style>