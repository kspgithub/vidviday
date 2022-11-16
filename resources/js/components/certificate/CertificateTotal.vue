<template>
    <div class="order-page">
        <hr>
        <div class="spacer-xs"></div>
        <span class="text-sm text-medium title inline">
            {{ __('certificate-section.total-sum') }}
        </span>
        <div class="thumb-price">
            <div class="text">
                <span>{{ totalPrice }}</span>
                <sup class="ms-5"> {{ __('certificate-section.uah') }}</sup>
            </div>
        </div>
        <div class="spacer-xs"></div>
    </div>
</template>

<script>
import {computed} from "vue";
import {toAmount} from "../../utils/number";
import {useStore} from "vuex";

export default {
    name: "CertificateTotal",
    setup() {
        const store = useStore();
        const totalPrice = computed(() => toAmount(store.getters['orderCertificate/totalPrice'], 0, 'en-UK'));
        return {
            totalPrice,
        }
    }
}
</script>

<style scoped>

</style>
