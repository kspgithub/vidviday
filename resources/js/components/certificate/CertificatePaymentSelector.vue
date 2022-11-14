<template>
    <div>
        <span class="h3">{{ __('certificate-section.payment-options') }}</span>
        <div class="spacer-xs"></div>
        <template v-for="(paymentType, idx) in paymentTypes" :key="'payment-type-' + paymentType.value">
            <br v-if="idx > 0" />
            <form-radio
                v-model="payment_type"
                name="payment_type"
                :value="paymentType.value"
                :label="paymentType.text"
            />
        </template>
        <div v-if="errors.payment_type" class="alert alert-danger">{{ errors.payment_type }}</div>
        <div class="spacer-xs"></div>
    </div>
</template>

<script>
import FormRadio from '../form/FormRadio'
import { useStore } from 'vuex'
import { computed } from 'vue'
import { useFormDataProperty } from '../../store/composables/useFormData'

export default {
    name: 'CertificatePaymentSelector',
    components: { FormRadio },
    props: {
        errors: {
            type: Object,
            default: () => {},
        },
    },
    setup() {
        const store = useStore()
        const paymentTypes = computed(() => store.state.orderCertificate.paymentTypes)

        return {
            paymentTypes: paymentTypes,
            payment_type: useFormDataProperty('orderCertificate', 'payment_type'),
        }
    },
}
</script>

<style scoped></style>
