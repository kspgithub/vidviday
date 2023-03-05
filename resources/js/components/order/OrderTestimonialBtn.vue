<template>
    <seo-button code="testimonial.order" class="btn type-2" @click="openPopup()"><slot/></seo-button>
</template>

<script>
import {useStore} from "vuex";
import SeoButton from '../common/SeoButton.vue'

export default {
    name: "OrderTestimonialBtn",
    components: {SeoButton},
    props: {
        url: String,
        tour: Object,
    },
    setup(props) {
        const store = useStore();

        const openPopup = () => {
            store.commit('testimonials/SET_TOUR', props.tour);
            store.commit('testimonials/SET_URL', props.url);
            store.commit('testimonials/SET_POPUP_OPEN', true)
        }

        return {
            openPopup,
        }
    }
}
</script>

<style scoped>

</style>
