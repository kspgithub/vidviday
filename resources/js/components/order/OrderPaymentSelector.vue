<template>
    <div>
        <label :data-tooltip="errorMessage" :class="{invalid: errorMessage}" class="label_title"><h2 class="h3">{{ __('order-section.payment.title') }}*</h2></label>
        <div class="spacer-xxs"></div>
        <template v-for="(paymentType, idx) in paymentTypes" :key="'payment-type-' + paymentType.value">

            <br v-if="idx > 0">
            <form-radio v-if="paymentType.value !== 5"  v-model="payment_type"
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
import {useField} from "vee-validate";

export default {
    name: "OrderPaymentSelector",
    components: {FormRadio},
    props: {
        name: {
            type: String,
            default: '',
        },
        rules: {
            type: [String, Object],
            default: '',
        }
    },
    setup(props) {
        const store = useStore();
        const paymentTypes = computed(() => store.state.orderTour.paymentTypes);

        const {errorMessage} = useField(props.name, props.rules);

        return {
            paymentTypes: paymentTypes,
            payment_type: useFormDataProperty('orderTour', 'payment_type'),
            errorMessage,
        }
    }

}
</script>

<style scoped>

</style>
