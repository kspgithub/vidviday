<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">

            <form @submit.prevent="submitForm" method="POST" action="/" class="row">
                <div class="col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">{{ __('common.write-email') }}</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <input type="hidden" name="type" :value="data.type">
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="name" id="name_mail" v-model="data.name"
                                :label="__('forms.your-name')"/>
                </div>


                <div class="col-md-6 col-12">
                    <form-input type="email" name="email" id="email_mail" v-model="data.email"
                                :label="__('forms.email')"/>
                </div>
                <div class="col-md-6 col-12">
                    <form-phone name="phone"
                                id="phone_mail"
                                v-model="data.phone" :label="__('forms.phone-number')"/>
                </div>
                <div class="col-md-6 col-12">
                    <form-sumo-select name="question_type" v-model="data.question_type"
                                      :options="questionTypes"
                                      :label="__('common.question-type')"
                    />
                </div>

                <div class="col-12">
                    <utm-fields/>
                    <form-textarea name="comment" id="comment_mail" v-model="data.comment" label="Текст повідомлення"/>
                    <div class="text text-sm">{{ __('forms.required-fields') }}</div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <vue-recaptcha v-if="useRecaptcha && popupOpen" :sitekey="sitekey"
                                       @verify="verify"
                                       @render="render"
                                       ref="recaptcha"
                        >
                            <seo-button code="order.email" type="submit" class="btn type-1" :disabled="request" @click="validateForm">
                                {{ __('forms.send') }}
                            </seo-button>
                        </vue-recaptcha>
                        <template v-if="!useRecaptcha">
                            <seo-button code="order.email" type="submit" class="btn type-1" :disabled="request" @click.prevent="validateForm">
                                {{ __('forms.send') }}
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
import {computed, reactive, ref} from "vue";
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
    name: "PopupEmail",
    components: {
        SeoButton,
        FormPhone,
        FormSumoSelect,
        VueRecaptcha, UtmFields, FormTextarea, FormDatepicker, FormCustomSelect, FormSelect, FormInput, Popup},
    props: {
        questionTypes: Array,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.userQuestion.popupMailOpen);
        const request = computed(() => store.state.userQuestion.request);
        const recaptcha = ref(null);
        const closePopup = () => store.commit('userQuestion/SET_POPUP_MAIL_OPEN', false);
        const user = store.state.user.currentUser


        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                phone: 'required|tel',
                email: 'required|email',
                comment: 'required',
                question_type: 'required',
            },
        });

        const data = reactive({
            type: 1,
            name: user ? (user.first_name + ' ' + user.last_name) : '',
            phone: user ? user.mobile_phone : '',
            email: user ? user.email : '',
            question_type: '',
            comment: '',
            'g-recaptcha-response': '',
        });

        const submitForm = async () => {
            const result = await validate();
            if (!result.valid) {

                console.log(errors);
            } else {

                const response = await store.dispatch('userQuestion/send', data);

                if (response.data) {
                    if (response.data.result === 'success') {
                        closePopup();
                        await store.dispatch('userQuestion/showThanks', {
                            title: __('popup.types.email.thanks-title'),
                            message: __('popup.types.email.thanks-message'),
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

                if(htmlOffset) {
                    const layout = $('iframe[title*="recaptcha"]')
                    layout.css('margin-top', htmlOffset.replace('-', ''))
                    layout.parent().css('overflow', 'visible')
                }
            }, 500)
        }

        const validateForm = async (e) => {
            if(e.isTrusted) {
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

        return {
            data,
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
