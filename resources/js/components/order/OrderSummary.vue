<template>
    <div class="bordered-box">
        <div>
            <span class="text">Вартість туру:</span>
            <span class="text-md"><b>{{ format(tourPrice) }}</b> грн</span>
        </div>
        <hr v-if="totalChildrenDiscount > 0">
        <div v-if="totalChildrenDiscount > 0">
            <span class="text">Знижка за дітей:</span>
            <span class="text-md"><b>-{{ format(totalChildrenDiscount) }}</b> грн</span>
        </div>
        <hr v-if="totalCommission > 0">
        <div v-if="totalCommission > 0">
            <span class="text">Комісія турагенту</span>
            <span class="discount">
                {{ format(totalCommission) }} грн
                <span class="tooltip-wrap red"><span class="tooltip text text-sm">Комісія турагенту</span></span>
            </span>
        </div>
        <hr>
        <div>
            <span class="h5">Кінцева вартість:</span>
            <span class="thumb-price">
                <span class="text"><span>{{ format(totalPrice) }}</span><sup>грн</sup></span>
            </span>
        </div>
    </div>
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";
import {toAmount} from "../../utils/number";
import {fetchTourSchedules} from "../../services/tour-service";

export default {
    name: "OrderSummary",
    setup() {
        const store = useStore();
        const tour_id = computed(() => store.state.orderTour.formData.tour_id);
        const schedule_id = computed(() => store.state.orderTour.formData.schedule_id);
        const schedules = computed(() => store.state.orderTour.schedules);

        const fetchSchedules = async () => {
            const items = await fetchTourSchedules(tour_id.value);
            store.commit('orderTour/SET_SCHEDULES', items || []);
        }

        if (tour_id.value > 0 && schedule_id.value && schedules.value.length === 0) {
            fetchSchedules();
        }

        const tourPrice = computed(() => store.getters["orderTour/tourTotalPrice"]);
        const totalChildrenDiscount = computed(() => store.getters["orderTour/totalChildrenDiscount"]);
        const totalCommission = computed(() => store.getters["orderTour/totalCommission"]);
        const totalPrice = computed(() => store.getters["orderTour/totalPrice"]);

        const format = (val) => toAmount(val);


        return {
            format,
            tourPrice,
            totalChildrenDiscount,
            totalCommission,
            totalPrice,
        }
    }
}
</script>

<style scoped>

</style>
