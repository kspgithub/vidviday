<template>
    <div>
        <h2 class="h3">Оберіть форму оплати</h2>
        <div class="spacer-xxs"></div>
        <template v-for="(paymentType, idx) in paymentTypes" :key="'payment-type-' + paymentType.value">
            <br v-if="idx > 0">
            <form-radio v-model="payment_type" name="payment_type"
                        :value="paymentType.value"
                        :label="paymentType.text"
            />
        </template>
        <div class="spacer-xs"></div>
    </div>
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";
import {useFormDataProperty} from "../../store/composables/useFormData";
import FormRadio from "../form/FormRadio";

export default {
    name: "OrderPaymentSelector",
    components: {FormRadio},
    setup() {
        const store = useStore();
        const paymentTypes = computed(() => store.state.orderTour.paymentTypes);

        return {
            paymentTypes: paymentTypes,
            payment_type: useFormDataProperty('orderTour', 'payment_type'),
        }
    }

}
</script>

<style scoped>

</style>
