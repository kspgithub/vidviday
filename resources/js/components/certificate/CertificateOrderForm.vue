<template>
    <form :action="action" class="tabs vue-tabs" method="POST">
        <slot/>
        <ul class="tab-toggle">
            <li class="tab-caption" :class="{active: currentStep === 1}" @click="setStep(1)"
                data-text="Загальна інформація">
                <span>1</span> Загальна інформація
            </li>
            <li class="tab-caption" :class="{active: currentStep === 2}" @click="setStep(2)"
                data-text="Оплата та отримання">
                <span>2</span> Оплата та отримання
            </li>
        </ul>
        <div class="spacer-xs"></div>
        <div class="tabs-wrap">
            <!-- TAB #1 -->
            <certificate-step-one v-show="currentStep === 1"/>
            <!-- TAB #1 END -->

            <!-- TAB #2 -->
            <certificate-step-two v-show="currentStep === 2"/>
            <!-- TAB #2 END -->
        </div>
        <hr>
        <div class="spacer-xs"></div>
        <div class="relative">
            <div class="row align-items-center">

                <div class="col-6" v-if="currentStep === 1">
                    <a :href="backUrl" class="btn btn-read-more left-arrow text-bold tab-prev w-normal">
                        До опису сертифікату
                    </a>
                </div>
                <div class="col-6 text-right" v-if="currentStep === 1">
                    <a href="#" @click.prevent="nextStep()" class="btn type-1 tab-next w-normal">Перейти до оплати</a>
                </div>

                <div class="col-4" v-if="currentStep === 2">
                    <a href="#" @click.prevent="prevStep()" class="btn btn-read-more left-arrow text-bold tab-prev">Назад</a>
                </div>

                <div class="col-8 text-right" v-if="currentStep === 2">
                    <button type="submit" class="btn type-1 w-normal">
                        Надіслати замовлення
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
                    return 'Оберіть тип сертифікату';
                },
                format: () => {
                    if (!!formData.value.format) return true;
                    return 'Оберіть формат сертифікату';
                },
                design: () => {
                    if (!!formData.value.design) return true;
                    return 'Оберіть дизайн сертифікату';
                },
                sum: (value) => {
                    if (formData.value.type === 'sum' && (value === '' || value === null || value < 100)) {
                        return 'Сума не може бути менше 100';
                    }
                    return true;
                },
                tour_id: (value) => {
                    if (formData.value.type === 'type' && (value === '' || value === null || value <= 0)) {
                        return 'Оберіть тур';
                    }
                    return true;
                },
                packing_type: () => {
                    if (formData.value.packing === 1 && !formData.value.packing_type) {
                        return 'Оберіть тип пакування';
                    }
                    return true;
                }
            },
        });

        const nextStep = async () => {
            const result = await validate();
            if (result.valid) {
                await store.dispatch('orderCertificate/nextStep')
                scrollToEl('.h1', -110);
            } else {
                console.log(errors.value);
                const name = Object.keys(errors.value)[0];
                scrollToEl('[name="' + name + '"]', -160)
            }

        }

        const prevStep = async () => {
            await store.dispatch('orderCertificate/prevStep')
            scrollToEl('.h1', -110);
        }

        const setStep = async (step) => {
            const result = await validate();
            if (result.valid) {
                await store.dispatch('orderCertificate/setStep', step)
                scrollToEl('.h1', -110);
            }
        }

        return {
            prevStep,
            nextStep,
            setStep,
            currentStep,
            errors,
        }
    }

}
</script>

<style scoped>

</style>
