<template>
    <div class="tab active">
        <div class="text mb-20">
            <p>{{ __('certificate-section.delivery-description') }}</p>
        </div>

        <certificate-payment-selector :errors="errors" />

        <certificate-comment />

        <div class="row">
            <div class="col-12">
                <certificate-total />
            </div>
        </div>
    </div>
</template>

<script>
import CertificatePaymentSelector from './CertificatePaymentSelector'
import { useFormDataProperty } from '../../store/composables/useFormData'
import CertificateComment from './CertificateComment'

import CertificateTotal from './CertificateTotal'

export default {
    name: 'CertificateStepTwo',
    components: { CertificateTotal, CertificateComment, CertificatePaymentSelector },
    props: {
        errors: {
            type: Object,
            default: () => {},
        },
    },
    setup() {
        return {
            comment: useFormDataProperty('orderCertificate', 'comment'),
        }
    },
}
</script>

<style scoped></style>
