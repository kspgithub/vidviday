<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">

            <form @submit.prevent="submitForm" method="POST" action="/" class="row">

                <div class="col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">{{ __('common.order-call') }}</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <input type="hidden" name="type" :value="data.type">
                </div>
                <div class="col-md-6 col-12">
                    <form-input name="name" v-model="data.name" :label="__('forms.your-name')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-phone name="phone"
                                v-model="data.phone" :label="__('forms.phone-number')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" name="email" v-model="data.email" :label="__('forms.email')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-sumo-select name="question_type" v-model="data.question_type"
                                      :options="questionTypes"
                                      :label="__('common.question-type')"
                    >
                    </form-sumo-select>
                </div>

                <div class="col-md-6 col-12">
                    <div class="single-datepicker">
                        <form-datepicker name="call_date" v-model="data.call_date" required :label="__('common.call-date')"/>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="timepicker-input">
                        <form-sumo-select name="call_time" v-model="data.call_time"
                                          :options="callTimes"
                                          :label="__('common.call-time')"
                        />
                    </div>
                </div>

                <div class="col-12">
                    <utm-fields/>
                    <form-textarea name="comment" v-model="data.comment" :label="__('certificate-section.notes')"/>
                    <div class="text text-sm">{{ __('forms.required-fields') }}</div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <vue-recaptcha v-if="useRecaptcha && popupOpen" :sitekey="sitekey"
                                       @verify="verify"
                                       @render="render"
                                       ref="recaptcha"
                        >
                            <seo-button code="order.call" type="submit" class="btn type-1" :disabled="request" @click.prevent="validateForm">
                                {{ __('common.order-call') }}
                            </seo-button>
                        </vue-recaptcha>
                        <template v-if="!useRecaptcha">
                            <seo-button code="order.call" type="submit" class="btn type-1" :disabled="request" @click.prevent="validateForm">
                                {{ __('common.order-call') }}
                            </seo-button>
                        </template>
                    </div>
                </div>
                <div class="btn-close" @click.prevent.stop="closePopup()">
                    <span></span>
                </div>
            </form>
        </div>
    </popup>
</template>

<script>
import Popup from "./Popup";
import {useStore} from "vuex";
import FormInput from "../form/FormInput";
import { computed, onMounted, reactive, ref } from "vue";
import FormSelect from "../form/FormSelect";
import FormCustomSelect from "../form/FormCustomSelect";
import FormDatepicker from "../form/FormDatepicker";
import FormTextarea from "../form/FormTextarea";
import {useForm} from "vee-validate";
import toast from "../../libs/toast";
import UtmFields from "../common/UtmFields";
import { VueRecaptcha } from 'vue-recaptcha'
import FormSumoSelect from '../form/FormSumoSelect.vue'
import FormPhone from "../form/FormPhone";
import { __ } from '../../i18n/lang'
import SeoButton from '../common/SeoButton.vue'

export default {
    name: "PopupCall",
    components: {
        SeoButton,
        FormPhone,
        FormSumoSelect,
        VueRecaptcha,
        UtmFields,
        FormTextarea,
        FormDatepicker,
        FormCustomSelect,
        FormSelect,
        FormInput,
        Popup
    },
    props: {
        questionTypes: Array,
        timeOptions: Array,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.userQuestion.popupCallOpen);
        const request = computed(() => store.state.userQuestion.request);
        const recaptcha = ref(null);
        const closePopup = () => store.commit('userQuestion/SET_POPUP_CALL_OPEN', false);
        const user = store.state.user.currentUser

        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                phone: 'required|tel',
                email: 'required|email',
                question_type: 'required',
                call_time: 'required',
                call_date: 'required|date:DD.MM.YYYY',
            },
        });

        const data = reactive({
            type: 0,
            name: user ? (user.first_name + ' ' + user.last_name) : '',
            phone: user ? user.mobile_phone : '',
            email: user ? user.email : '',
            question_type: '',
            call_date: '',
            call_time: '',
            comment: '',
            'g-recaptcha-response': '',
        });

        const submitForm = async () => {
            const result = await validate();
            if (!result.valid) {

                console.log(errors);
            } else {

                const response = await store.dispatch('userQuestion/send', data);

                if (response?.data) {
                    if (response.data.result === 'success') {
                        closePopup();
                        await store.dispatch('userQuestion/showThanks', {
                            title: __('popup.types.recall.thanks-title'),
                            message: __('popup.types.recall.thanks-message'),
                        })

                    } else {
                        toast.error(response.data.message);
                    }

                }

            }
        }

        const useRecaptcha = String(process.env.MIX_INVISIBLE_RECAPTCHA_ENABLED) === 'true'
        const sitekey = process.env.MIX_INVISIBLE_RECAPTCHA_SITEKEY

        const verify = (e) => {
            data['g-recaptcha-response'] = e
            submitForm()
            recaptcha.value.reset()
        }

        const render = (e) => {
            setTimeout(() => {
                const htmlOffset = $('html').css('top')

                if (htmlOffset) {
                    const layout = $('iframe[title*="recaptcha"]')
                    layout.css('margin-top', htmlOffset.replace('-', ''))
                    layout.parent().css('overflow', 'visible')
                }
            }, 500)
        }

        const validateForm = async (e) => {
            if (e.isTrusted) {
                e.stopImmediatePropagation()
                e.preventDefault()

                const result = await validate();
                if (!result.valid) {
                    console.log(errors);
                    return false
                } else {
                    e.target.dispatchEvent(new e.constructor(e.type, e))
                }
            }
        }

        const callTimes = ref(props.timeOptions || [])

        if(!callTimes.value.length){
            for(let time = 11; time <= 20; time++) {
                callTimes.value.push({text: `${time}:00`, value: `${time}:00`})
            }
        }

        return {
            data,
            errors,
            callTimes,
            popupOpen,
            request,
            closePopup,
            submitForm,
            useRecaptcha,
            sitekey,
            recaptcha,
            verify,
            render,
            validateForm,
        }
    }
}
</script>

<style scoped>

</style>
