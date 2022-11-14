<template>
    <a :href="href">
        <slot />
        &nbsp;<span v-if="count > 0">{{ count }}</span>
    </a>
</template>

<script>
import { useStore } from 'vuex'
import { computed } from 'vue'

export default {
    name: 'ProfileFavouriteLink',
    props: {
        href: String,
    },
    setup(props) {
        const store = useStore()
        const count = computed(() => store.getters['user/countFavourites'])
        store.dispatch('user/loadFavourites')

        return {
            count,
        }
    },
}
</script>

<style scoped></style>
