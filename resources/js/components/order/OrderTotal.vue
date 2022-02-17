<template>
    <div>
        <div class="row mt-30" v-if="totalPrice > 0">
            <div class="col-lg-3 col-12" v-if="totalPrice > 0">
                <span class="text-sm text-medium title inline">{{ __('order-section.total-sum') }}</span>
                <div class="thumb-price">
                    <div class="text">
                        <span>{{ format(totalPrice) }}</span>
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
            <div class="col-lg-4 col-12" v-if="totalAccommodation >  0">
                <span class="text-sm text-medium title inline">{{ __('tours-section.accomm-price') }}</span>
                <span class="discount margin-top">
                    {{ format(totalAccommodation) }} {{ __('order-section.currency.uah') }}
                     <tooltip variant="red">
                        <span
                            v-html="accommPrice + __('order-section.currency.uah') + ' '+__('order-section.summary.accomm-tooltip')"></span>
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
        const totalPrice = computed(() => store.getters['orderTour/totalPrice']);
        const accommPrice = computed(() => store.getters['orderTour/accommodationPrice']);
        const totalCommission = computed(() => store.getters['orderTour/totalCommission']);
        const totalAccommodation = computed(() => store.getters['orderTour/totalAccommodation']);
        const isTourAgent = computed(() => store.getters['user/isTourAgent']);

        const format = (val) => toAmount(val);

        return {
            format,
            accommPrice,
            totalPrice,
            totalCommission,
            totalAccommodation,
            isTourAgent,
        }
    }
}
</script>

<style scoped>

</style>
