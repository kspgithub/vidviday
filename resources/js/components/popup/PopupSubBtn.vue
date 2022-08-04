<template>
    <a href="#" @click.prevent="openPopup">
        <slot/>
    </a>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "PopupSubBtn",
    props: {
        type: String
    },
    setup(props) {
        const store = useStore();
        const openPopup = () => {
            if (props.type === 'tourist') {
                $('#mailerlite-tourist button').click()
                // store.commit('userQuestion/SET_POPUP_USER_SUB_OPEN', true)
            } else {
                $('#mailerlite-agent button').click()
                // store.commit('userQuestion/SET_POPUP_AGENT_SUB_OPEN', true)
            }
        }
        return {
            openPopup,
        }
    }
}
</script>

<style scoped>

</style>
