<template>
    <div class="tab active">
        <div class="spacer-xs"></div>
        <tour-calendar :filter="filter"/>
    </div>
</template>

<script>
import TourCalendar from "./TourCalendar";
import {useStore} from "vuex";
import {computed, onBeforeUnmount, onMounted, ref} from "vue";

export default {
    name: "TourViewCalendar",
    components: {
        TourCalendar
    },
    setup() {

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
