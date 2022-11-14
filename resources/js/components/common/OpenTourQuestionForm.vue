<template>
    <span @click="openPopup()"><slot /></span>
</template>

<script>
import { useStore } from 'vuex'

export default {
    name: 'OpenTestimonialForm',
    props: {
        parent: {
            type: Number,
            default: 0,
        },
    },
    setup(props) {
        const store = useStore()

        const openPopup = () => {
            store.commit('tourQuestion/SET_PARENT_ID', props.parent)
            store.commit('tourQuestion/SET_POPUP_OPEN', true)
        }

        return {
            openPopup,
        }
    },
}
</script>

<style scoped></style>
