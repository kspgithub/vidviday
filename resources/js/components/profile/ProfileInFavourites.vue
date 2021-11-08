<template>
    <span v-show="count">{{ count }}</span>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: "ProfileInFavourites",
    setup() {
        const store = useStore();
        const count = computed(() => store.getters['user/countFavourites']);
        return {
            count
        }
    }
}
</script>

<style scoped>

</style>
