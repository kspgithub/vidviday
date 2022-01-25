<template>
    <div>
        <div class="row mt-30" v-if="totalTour > 0">
            <div class="col-lg-3 col-12" v-if="totalTour > 0">
                <span class="text-sm text-medium title inline">{{ __('order-section.total-sum') }}</span>
                <div class="thumb-price">
                    <div class="text">
                        <span>{{ format(totalTour) }}</span>
                        <sup> {{ __('order-section.currency.uah') }}</sup>
                    </div>
                </div>

            </div>

            <div class="col-lg-3 col-12" v-if="totalCommission >  0 && isTourAgent">
                <span class="text-sm text-medium title inline">{{ __('order-section.summary.commission') }}</span>
                <span class="discount margin-top">
                    {{ format(totalCommission) }} {{ __('order-section.currency.uah') }}

                    <tooltip variant="red">
                        <span v-html="__('order-section.summary.commission-tooltip')"></span>
                    </tooltip>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import {computed} from "vue";
import {toAmount} from "../../utils/number";
import {useStore} from "vuex";
import Tooltip from "../common/Tooltip";

export default {
    name: "OrderTotal",
    components: {Tooltip},
    setup() {
        const store = useStore();

        const totalTour = computed(() => store.getters['orderTour/totalTour']);
        const totalCommission = computed(() => store.getters['orderTour/totalCommission']);
        const isTourAgent = computed(() => store.getters['user/isTourAgent']);

        const format = (val) => toAmount(val);

        return {
            format,
            totalTour,
            totalCommission,
            isTourAgent,
        }
    }
}
</script>

<style scoped>

</style>
