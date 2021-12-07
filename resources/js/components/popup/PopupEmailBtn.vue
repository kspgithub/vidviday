<template>
    <span @click="openPopup()"><slot/></span>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "PopupEmailBtn",
    props: {
        parent: {
            type: Number,
            default: 0
        }
    },
    setup(props) {
        const store = useStore();

        const openPopup = () => {
            store.commit('userQuestion/SET_POPUP_MAIL_OPEN', true)
        }

        return {
            openPopup,
        }
    }
}
</script>

<style scoped>

</style>
