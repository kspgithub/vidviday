<template>
    <a href="#" @click.prevent="openPopup">
        <slot/>
    </a>
</template>

<script>
import {useStore} from "vuex";
import store from '../../store/index.js'

export default {
    name: "PopupSubBtn",
    props: {
        type: String
    },
    setup(props) {
        const store = useStore();
        const openPopup = () => {
            if (props.type === 'tourist') {
                const mailerLiteTourist = $('#mailerlite-tourist')
                if(mailerLiteTourist.length) {
                    mailerLiteTourist.find('button').click()
                } else {
                    store.commit('userQuestion/SET_POPUP_USER_SUB_OPEN', true)
                }
            } else {
                const mailerLiteAgent = $('#mailerlite-agent')
                if(mailerLiteAgent.length) {
                    mailerLiteAgent.find('button').click()
                } else {
                    store.commit('userQuestion/SET_POPUP_AGENT_SUB_OPEN', true)
                }
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
