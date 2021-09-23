<template>
    <div>
        <div class="row mt-30" v-if="totalTour > 0">
            <div class="col-lg-3 col-12" v-if="totalTour > 0">
                <span class="text-sm text-medium title inline">Загальна сума</span>
                <div class="thumb-price">
                    <div class="text">
                        <span>{{ format(totalTour) }}</span>
                        <sup> грн</sup>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-12" v-if="totalCommission >  0">
                <span class="text-sm text-medium title inline">Комісія турагенту</span>
                <span class="discount margin-top">{{ format(totalCommission) }} грн. <span
                    class="tooltip-wrap red"><span
                    class="tooltip text text-sm">Комісія турагенту</span></span></span>

            </div>
        </div>
    </div>
</template>

<script>
import {computed} from "vue";
import {toAmount} from "../../utils/number";
import {useStore} from "vuex";

export default {
    name: "OrderTotal",
    setup() {
        const store = useStore();

        const totalTour = computed(() => store.getters['orderTour/totalTour']);
        const totalCommission = computed(() => store.getters['orderTour/totalCommission']);

        const format = (val) => toAmount(val);

        return {
            format,
            totalTour,
            totalCommission,
        }
    }
}
</script>

<style scoped>

</style>
