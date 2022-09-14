<template>
    <div class="review-item" :id="'testimonial-'+testimonial.id">
        <div class="spacer-xs"></div>
        <div class="review">
            <div class="review-header">
                <div class="review-img">
                    <img v-if="testimonial.avatar" src="/img/preloader.png"
                         :data-img-src="testimonial.avatar_url" alt="user">
                    <span v-else class="full-size h4">{{ testimonial.initials }}</span>
                </div>
                <div class="review-title">
                    <span class="h4">{{ testimonial.name }}</span>
                    <span class="text text-sm">{{ testimonial.created_at }}</span>
                    <span class="text text-sm">{{ testimonial.created_at }}</span>
                    <span v-if="testimonial.on_moderation" class="text text-sm">
                        {{ __('tours-section.reviews.in-moderation') }}
                    </span>
                    <template v-else>
                        <template v-if="!testimonial.parent_id">
                            <star-rating :rating="testimonial.rating"/>
                        </template>
                        <template v-if="!testimonial.short">
                            <open-testimonial-form class="text" :parent="testimonial.id">
                                {{ __('tours-section.reviews.answer') }}
                            </open-testimonial-form>
                        </template>
                    </template>
                </div>
            </div>

            <div class="seo-text load-more-wrapp p-0 m-0">
                <template v-if="testimonial.short_text.length <= (textMaxLength + 3)">
                    <div class="less-info">
                        <p v-html="testimonial.short_text"></p>
                    </div>
                    <div class="more-info">
                        <p v-html="testimonial.text"></p>
                    </div>

                    <div class="show-more">
                        <span v-text="__('common.read-more')"></span>
                        <span v-text="__('common.hide-text')"></span>
                    </div>
                </template>
                <p v-else v-html="testimonial.text"></p>
            </div>
            <template v-if="testimonial.gallery">
                <div class="spacer-xs"></div>
                <swiper-slider :key="'swp-'+testimonial.id"
                               class="swiper-entry"
                               :media="testimonial.gallery"
                               :buttons="false"
                               :options="{
                                   slidesPerView: 3,
                                   spaceBetween: 15,
                                   breakpoints: {
                                       992: {slidesPerView: 4, spaceBetween: 22},
                                       1200: {slidesPerView: 5, spaceBetween: 22},
                                   }}"
                />
            </template>
        </div>
        <template v-if="!short && !testimonial.parent_id && testimonial.children?.length">
            <div class="load-more-wrapp">
                <div class="show-more active">
                    <span v-text="__('tours-section.reviews.hide-answers')"></span>
                    <span v-text="__('tours-section.reviews.show-answers')"></span>
                </div>
                <div class="more-info">
                    <tour-review v-for="review in (testimonial.children || [])" :testimonial="review" />
                </div>
            </div>
        </template>
        <template v-else-if="!short && testimonial.children?.length">
            <tour-review v-for="review in (testimonial.children || [])" :testimonial="review" />
        </template>
    </div>
</template>

<script>
import StarRating from '../common/StarRating.vue'
import SwiperSlider from '../common/SwiperSlider.vue'
import OpenTestimonialForm from '../common/OpenTestimonialForm.vue'

export default {
    name: "TourReview",
    components: { StarRating, SwiperSlider, OpenTestimonialForm },
    props: {
        testimonial: {
            type: Object,
        },
        textMaxLength: {
            type: Number,
            default: 120,
        },
        short: {
            type: Boolean,
            default: false,
        },
    },
    setup() {
        return {

        }
    }
}
</script>
