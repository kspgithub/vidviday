<template>
    <div class="tab" :class="{active: active}">
        <div class="row">
            <div class="col-lg-9 col-md-7 col-12">
                <order-payment-selector/>
                <template v-if="group_type === 1">
                    <order-offer-date/>
                    <div class="spacer-xs"></div>
                </template>

                <div class="row">
                    <div class="col-lg-5 col-12">
                        <order-confirmation/>

                        <order-act v-if="group_type === 0"/>

                        <order-comment/>

                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-5 col-12" v-if="group_type === 0">
                <order-summary/>
            </div>
        </div>
    </div>
</template>

<script>
import OrderSummary from "./OrderSummary";
import OrderPaymentSelector from "./OrderPaymentSelector";
import OrderConfirmation from "./OrderConfirmation";
import OrderAct from "./OrderAct";
import OrderComment from "./OrderComment";
import {useFormDataProperty} from "../../store/composables/useFormData";
import OrderOfferDate from "./OrderOfferDate";
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    name: "OrderStepThree",
    components: {OrderOfferDate, OrderComment, OrderAct, OrderConfirmation, OrderPaymentSelector, OrderSummary},
    props: {
        active: Boolean,
    },
    setup() {


        return {
            group_type: useFormDataProperty('orderTour', 'group_type'),
        }
    }
}
</script>

<style scoped>

</style>
