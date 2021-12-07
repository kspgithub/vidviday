<template>
    <a class="text-sm cancel-tour-btn" @click.prevent="showPopup">
        <b class="text-bold">
            <slot/>
        </b>
    </a>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "OrderCancelBtn",
    props: {
        order: Object
    },
    setup(props) {
        const store = useStore();

        const showPopup = () => {
            store.commit('profileOrders/SET_ORDER', props.order);
            store.commit('profileOrders/SET_POPUP_OPEN', true);
        }

        return {
            showPopup,
        }
    }
}
</script>

<style scoped>

</style>
