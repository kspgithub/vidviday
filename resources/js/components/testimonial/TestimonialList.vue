<template>
    <div>
        <seo-button code="testimonial.send"
                    v-if="type !== 'tour_questions'"
                    class="btn type-1 btn-block-sm"
                    @click.prevent="showPopup()"
        >{{ __('forms.leave-feedback') }}</seo-button>
        <div class="spacer-xs"></div>
        <hr>
        <testimonial-item v-for="item in testimonials" :item="item" :key="'tm-'+item.id" :type="type" @add="" />
        <hr>
        <div class="spacer-xs"></div>
        <div class="row">
            <div class="col-xl-6 col-12" v-if="type !== 'tour_questions'">
                <seo-button code="testimonial.send" class="btn type-1 btn-block-sm" @click.prevent="showPopup()">{{ __('forms.leave-feedback') }}</seo-button>
                <div class="spacer-xxs only-pad-mobile"></div>
            </div>

            <div class="col-xl-6 col-12 text-right">
                <seo-button code="testimonial.show_more"
                            v-if="currentPage < lastPage"
                            @click.prevent="loadMore()"
                            tag="span"
                            class="btn type-2 btn-block-sm btn-block-xs"
                >
                    {{ __('common.show-more-10') }}
                </seo-button>
            </div>
        </div>
    </div>
</template>

<script>
import TestimonialItem from "./TestimonialItem";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import SeoButton from '../common/SeoButton.vue'

export default {
    name: "TestimonialList",
    components: {SeoButton, TestimonialItem},
    props: {
        url: String,
        items: Array,
        page: {
            type: Number,
            default: 1
        },
        type: String,
    },
    setup(props) {
        const store = useStore();
        store.commit('testimonials/SET_URL', props.url);
        store.commit('testimonials/SET_TESTIMONIALS', props.items);
        store.dispatch('user/loadProfile');

        const testimonials = props.items || computed(() => store.state.testimonials.items);
        const currentPage = computed(() => store.state.testimonials.currentPage);
        const lastPage = computed(() => store.state.testimonials.lastPage);
        const request = computed(() => store.state.testimonials.request);

        const loadItems = async () => await store.dispatch('testimonials/loadItems');

        const loadMore = async () => await store.dispatch('testimonials/loadMore');

        if(!testimonials.length && typeof props.items === 'undefined') {
            loadItems();
        }

        const showPopup = () => store.dispatch('testimonials/openPopup');

        return {
            testimonials,
            currentPage,
            lastPage,
            request,
            loadMore,
            showPopup,
        }
    }
}
</script>

<style scoped>

</style>
