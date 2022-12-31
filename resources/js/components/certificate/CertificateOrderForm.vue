<template>
    <form :action="action" class="tabs vue-tabs" method="POST" @submit="handleSubmit">
        <slot/>
        <ul class="tab-toggle">
            <li class="tab-caption" :class="{active: currentStep === 1}" @click="setStep(1)"
                :data-text="__('certificate-section.general-information')">
                <span>1</span> {{ __('certificate-section.general-information') }}
            </li>
            <li class="tab-caption" :class="{active: currentStep === 2}" @click="setStep(2)"
                :data-text="__('certificate-section.payment-and-receipt')">
                <span>2</span> {{ __('certificate-section.payment-and-receipt') }}
            </li>
        </ul>
        <div class="spacer-xs"></div>
        <div class="tabs-wrap">
            <!-- TAB #1 -->
            <certificate-step-one :errors="errors" v-show="currentStep === 1"/>
            <!-- TAB #1 END -->

            <!-- TAB #2 -->
            <certificate-step-two :errors="errors" v-show="currentStep === 2"/>
            <!-- TAB #2 END -->
        </div>
        <hr>
        <div class="spacer-xs"></div>
        <div class="relative">
            <div class="row align-items-center">

                <div class="col-6" v-if="currentStep === 1">
                    <a :href="backUrl" class="btn btn-read-more left-arrow text-bold tab-prev w-normal">
                        {{ __('certificate-section.back-description') }}
                    </a>
                </div>
                <div class="col-6 text-right" v-if="currentStep === 1">
                    <a href="#" @click.prevent="nextStep()" class="btn type-1 tab-next w-normal">
                        {{ __('certificate-section.go-to-payment') }}
                    </a>
                </div>

                <div class="col-4" v-if="currentStep === 2">
                    <a href="#" @click.prevent="prevStep()" class="btn btn-read-more left-arrow text-bold tab-prev">
                        {{ __('certificate-section.back') }}
                    </a>
                </div>

                <div class="col-8 text-right" v-if="currentStep === 2">
                    <button type="submit" class="btn type-1 w-normal">
                        {{ __('certificate-section.send-order') }}
                    </button>
                </div>
            </div>


        </div>


    </form>
</template>

<script>
import {useStore} from "vuex";
import {scrollToEl} from "../../utils/functions";
import {computed} from "vue";
import {useForm} from "vee-validate";
import CertificateStepOne from "./CertificateStepOne";
import CertificateStepTwo from "./CertificateStepTwo";
import {required} from "@vee-validate/rules";
import {__} from "../../i18n/lang";

export default {
    name: "CertificateOrderForm",
    components: {CertificateStepTwo, CertificateStepOne},
    props: {
        action: String,
        packings: Array,
        paymentTypes: Array,
        backUrl: String,
        step: Number,
    },
    setup(props) {
        const store = useStore();
        store.commit('orderCertificate/SET_PACKINGS', props.packings);
        store.commit('orderCertificate/SET_PAYMENT_TYPES', props.paymentTypes);

        const orderCertificateData = localStorage.getItem('order-cretificate')

        if(orderCertificateData) {
            store.commit('orderCertificate/SET_DATA', JSON.parse(orderCertificateData));
        }

        const currentStep = computed(() => store.state.orderCertificate.currentStep);
        const formData = computed(() => store.state.orderCertificate.formData);

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                email: 'required|email',
                phone: 'required|tel',
                first_name_recipient: 'required',
                last_name_recipient: 'required',
                type: () => {
                    if (!!formData.value.type) return true;
                    return __('validation.select-certificate-type');
                },
                format: () => {
                    if (!!formData.value.format) return true;
                    return __('validation.select-certificate-format');
                },
                // design: () => {
                //     if (!!formData.value.design) return true;
                //     return __('validation.select-certificate-design');
                // },
                sum: (value) => {
                    if (formData.value.type === 'sum' && (value === '' || value === null || value < 100)) {
                        return __('validation.min-sum-100');
                    }
                    return true;
                },
                tour_id: (value) => {
                    if (formData.value.type === 'type' && (value === '' || value === null || value <= 0)) {
                        return __('validation.select-tour');
                    }
                    return true;
                },
                packing_type: () => {
                    if (formData.value.packing === 1 && !formData.value.packing_type) {
                        return __('validation.select-packaging-type');
                    }
                    return true;
                },
                payment_type: () => {
                    if (currentStep.value === 2 && !props.paymentTypes.filter(pt => pt.value === formData.value.payment_type).length) {
                        return __('validation.select-payment-type');
                    }
                    return true;
                },
            },
        });

        const nextStep = async () => {
            const result = await validate();
            if (result.valid) {
                await store.dispatch('orderCertificate/nextStep')
                scrollToEl('h1', -110);
            } else {
                const name = Object.keys(errors.value)[0];
                scrollToEl('[name="' + name + '"]', -160)
            }

        }

        const prevStep = async () => {
            await store.dispatch('orderCertificate/prevStep')
            scrollToEl('h1', -110);
        }

        const setStep = async (step) => {
            const result = await validate();
            if (result.valid) {
                await store.dispatch('orderCertificate/setStep', step)
                scrollToEl('.h1', -110);
            }
        }

        const handleSubmit = async (e) => {
            e.preventDefault()

            const result = await validate();

            if (result.valid) {
                localStorage.removeItem('order-cretificate')
                e.target.submit()
            }
        }

        return {
            prevStep,
            nextStep,
            setStep,
            currentStep,
            errors,
            handleSubmit,
        }
    }

}
</script>

<style scoped>

</style>
