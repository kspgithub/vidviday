<template>
    <div class="tab" :class="{active}">
        <template v-if="active">
            <div class="spacer-xs"></div>
            <tour-calendar :filter="filter"/>
        </template>
    </div>
</template>

<script>
import { useStore } from "vuex";
import { computed, onBeforeUnmount, onMounted, ref } from "vue";

export default {
    name: "TourViewCalendar",
    components: {
        TourCalendar: () => import('./TourCalendar.vue')
    },
    props: {
        active: Boolean,
    },
    setup({props}) {

        const store = useStore();
        const filter = computed(() => store.getters['tourFilter/filterData']);

        return {
            filter,
        }

    }
}
</script>

<style scoped>

</style>
