<template>
    <div>
        <span class="btn type-1 btn-block-sm" @click="showPopup()">{{ __('forms.leave-feedback') }}</span>
        <div class="spacer-xs"></div>
        <hr>
        <testimonial-item v-for="item in testimonials" :item="item" :key="'tm-'+item.id"/>
        <hr>
        <div class="spacer-xs"></div>
        <div class="row">
            <div class="col-xl-6 col-12">
                <span class="btn type-1 btn-block-sm" @click="showPopup()">{{ __('forms.leave-feedback') }}</span>
                <div class="spacer-xxs only-pad-mobile"></div>
            </div>

            <div class="col-xl-6 col-12 text-right">
                <span class="btn type-2 btn-block-sm btn-block-xs" v-if="currentPage < lastPage" @click="loadMore()">
                    {{ __('common.show-more-10') }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import TestimonialItem from "./TestimonialItem";
import {computed, ref} from "vue";
import {useStore} from "vuex";

export default {
    name: "TestimonialList",
    components: {TestimonialItem},
    props: {
        url: String,
        page: {
            type: Number,
            default: 1
        }
    },
    setup(props) {
        const store = useStore();
        store.commit('testimonials/SET_URL', props.url);
        store.dispatch('user/loadProfile');

        const testimonials = computed(() => store.state.testimonials.items);
        const currentPage = computed(() => store.state.testimonials.currentPage);
        const lastPage = computed(() => store.state.testimonials.lastPage);
        const request = computed(() => store.state.testimonials.request);

        const loadItems = async () => await store.dispatch('testimonials/loadItems');

        const loadMore = async () => await store.dispatch('testimonials/loadMore');

        loadItems();

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
