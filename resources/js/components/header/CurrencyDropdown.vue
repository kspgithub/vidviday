<template>
    <div>
        <slot/>
    </div>
</template>

<script>
import {useStore} from "vuex";

export default {
    name: "CurrencyDropdown",
    props: {
        current: Object,
    },
    setup(props) {
        const store = useStore();
        store.commit('currency/SET_CURRENT', props.current || {
            iso: 'UAH',
            course: 1.0,
            symbol: '₴',
        });
    }
}
</script>

<style scoped>

</style>
