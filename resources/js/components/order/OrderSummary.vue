<template>
    <div class="bordered-box">
        <div>
            <span class="text">{{ __('order-section.summary.cost-tour') }}:</span>
            <span class="text-md"><b>{{ format(tourPrice) }}</b> {{ __('order-section.currency.uah') }}</span>
        </div>
        <hr v-if="totalChildrenDiscount > 0">
        <div v-if="totalChildrenDiscount > 0">
            <span class="text">{{ __('order-section.summary.children-discount') }}:</span>
            <span class="text-md">
                <b>-{{ format(totalChildrenDiscount) }}</b>
                {{ __('order-section.currency.uah') }}
            </span>
        </div>
        <hr v-if="totalCommission > 0">
        <div v-if="totalCommission > 0">
            <span class="text">{{ __('order-section.summary.commission') }}</span>
            <span class="discount">
                {{ format(totalCommission) }} {{ __('order-section.currency.uah') }}
                <tooltip variant="red">
                    <span v-html="__('order-section.summary.commission-tooltip') "></span>
                </tooltip>
            </span>
        </div>
        <hr>
        <div>
            <span class="h5">{{ __('order-section.summary.final-cost') }}:</span>
            <span class="thumb-price">
                <span class="text">
                    <span>{{ format(totalPrice) }}</span>
                    <sup>{{ __('order-section.currency.uah') }}</sup>
                </span>
            </span>
        </div>
    </div>
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";
import {toAmount} from "../../utils/number";
import {fetchTourSchedules} from "../../services/tour-service";
import Tooltip from "../common/Tooltip";

export default {
    name: "OrderSummary",
    components: {Tooltip},
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
