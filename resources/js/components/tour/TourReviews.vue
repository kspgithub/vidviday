<template>
    <div ref="accordionItem" class="accordion-item hidden-print" id="reviews-accordion">
        <div class="accordion-title">
            <span>
                <img src="/img/preloader.png" data-img-src="/icon/rating.svg" alt="rating">
            </span>
            {{ __('tours-section.reviews.title') }}
            ({{ testimonials.length }})
            <i></i>
        </div>
        <div class="accordion-inner">
            <div></div>
            <open-testimonial-form class="btn btn-block-sm type-1" :parent='0'>
                {{ __('tours-section.reviews.leave-review') }}
            </open-testimonial-form>
            <div class="spacer-xs"></div>
            <template v-if="testimonials.length">
                <hr>
                <div class="spacer-xs"></div>

                <tour-review v-for="testimonial in testimonials"
                    :testimonial="testimonial"
                />

                <div class="spacer-xs"></div>
                <hr>
                <div class="spacer-xs"></div>
                <open-testimonial-form class="btn btn-block-sm type-1" :parent='0'>
                    {{ __('tours-section.reviews.leave-review') }}
                </open-testimonial-form>
            </template>
        </div>
    </div>
</template>

<script>
import TourReview from './TourReview.vue'
import OpenTestimonialForm from '../common/OpenTestimonialForm.vue'
import { computed, ref } from 'vue'
import { useStore } from 'vuex'

export default {
    name: "TourReviews",
    components: { TourReview, OpenTestimonialForm },
    props: {
        tour: Object,
    },
    setup(props) {
        const accordionItem = ref(null)

        const store = useStore();

        store.commit('testimonials/SET_TESTIMONIALS', props.tour.testimonials || [])

        const testimonials = computed(() => store.state.testimonials.items)

        return {
            accordionItem,
            testimonials,
        }
    }
}
</script>

<style scoped>

</style>
