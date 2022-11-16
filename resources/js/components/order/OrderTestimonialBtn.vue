<template>
    <span class="btn type-2" @click="openPopup()"><slot/></span>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "OrderTestimonialBtn",
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
