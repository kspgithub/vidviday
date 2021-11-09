<template>
    <div class="tab active">
        <div class="text mb-20">
            <p>Отримати сертифікат можна в нашому офісі або Новою Поштою чи Укрпоштою
                (вартість доставки за тарифами сервісів)</p>
        </div>

        <certificate-payment-selector/>

        <certificate-comment/>

        <div class="row">
            <div class="col-12">
                <certificate-total/>
            </div>
        </div>
    </div>
</template>

<script>
import CertificatePaymentSelector from "./CertificatePaymentSelector";
import {useFormDataProperty} from "../../store/composables/useFormData";
import CertificateComment from "./CertificateComment";

import CertificateTotal from "./CertificateTotal";

export default {
    name: "CertificateStepTwo",
    components: {CertificateTotal, CertificateComment, CertificatePaymentSelector},
    setup() {
        return {
            comment: useFormDataProperty('orderCertificate', 'comment'),
        }
    }
}
</script>

<style scoped>

</style>
