<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">{{ __('popup.newsletter-travel-agency') }}</span>
                        <br>
                        <span class="text">{{ __('popup.subscribe-text') }}</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <form @submit="submitForm" method="POST" :action="action" class="row">
                        <form-csrf/>
                        <div class="col-12">
                            <form-input name="name" id="name_agent_sub"
                                        v-model="data.name"
                                        :label="__('forms.your-name')"/>

                        </div>

                        <div class="col-12">
                            <form-input type="email" name="email" id="email_agent_sub" v-model="data.email"
                                        :label="__('forms.email')"/>
                        </div>
                        <div class="col-12">
                            <form-input name="company" id="company_user_sub"
                                        v-model="data.company"
                                        :label="__('forms.travel-agency-name')"/>
                        </div>

                        <div class="col-12">
                            <form-input name="viber" id="viber_user_sub"
                                        v-model="data.viber"
                                        :label="__('forms.viber')"/>
                        </div>

                        <div class="col-12">
                            <utm-fields/>
                            <div class="text text-sm">{{ __('forms.required-fields') }}</div>
                            <div class="spacer-xs"></div>
                            <div class="text-center">
                                <vue-recaptcha v-if="useRecaptcha && popupOpen" :sitekey="sitekey"
                                               @verify="verify"
                                               @render="render"
                                               ref="recaptcha"
                                >
                                    <button id="b19" type="submit" class="btn type-1" :disabled="request" @click="validateForm">
                                        {{ __('forms.subscribe') }}
                                    </button>
                                </vue-recaptcha>
                                <template v-if="!useRecaptcha">
                                    <button id="b20" type="submit" class="btn type-1" :disabled="request" @click="validateForm">
                                        {{ __('forms.subscribe') }}
                                    </button>
                                </template>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="btn-close" @click.prevent.stop="closePopup()">
                <span></span>
            </div>
        </div>

    </popup>
</template>

<script>
import Popup from "./Popup";
import FormInput from "../form/FormInput";
import {computed, reactive, ref} from "vue";
import {useStore} from "vuex";
import {useForm} from "vee-validate";
import FormCsrf from "../form/FormCsrf";
import toast from "../../libs/toast";
import axios from "axios";
import {getError} from "../../services/api";
import UtmFields from "../common/UtmFields";
import { VueRecaptcha } from 'vue-recaptcha'
import { __ } from '../../i18n/lang'

export default {
    name: "PopupAgentSubscription",
    components: { VueRecaptcha, UtmFields, FormCsrf, FormInput, Popup },
    props: {
        action: String,
    },
    setup() {
        const store = useStore();
        const popupOpen = computed(() => store.state.userQuestion.popupAgentSubOpen);
        const request = ref(false);
        const recaptcha = ref(null);
        const closePopup = () => store.commit('userQuestion/SET_POPUP_AGENT_SUB_OPEN', false);
        const user = store.state.user.currentUser

        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                email: 'required|email',
            },
        });

        const data = reactive({
            name: user ? (user.first_name + ' ' + user.last_name) : '',
            email: user ? user.email : '',
            company: '',
            viber: '',
            utm_source: '',
            utm_campaign: '',
            utm_content: '',
            utm_medium: '',
            utm_term: '',
            'g-recaptcha-response': '',
        });

        const submitForm = async (event) => {
            if(typeof event === 'object') {
                event.preventDefault();
            }

            const result = await validate();
            if (!result.valid) {
                console.log(errors);
            } else {

                request.value = true;

                const response = await axios.post('/api/user/agent-subscription', data).catch(error => {
                    if (!axios.isCancel(error)) {
                        const message = getError(error);
                        toast.error(message);
                    }
                })


                if (response.data) {
                    if (response.data.result === 'success') {
                        closePopup();
                        await store.dispatch('userQuestion/showThanks', {
                            title: __('popup.types.agent-subscription.thanks-title'),
                            message: __('popup.types.agent-subscription.thanks-message'),
                        })
                    } else {
                        toast.error(response.data.message);
                    }

                }

                request.value = false
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
            request,
            popupOpen,
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
