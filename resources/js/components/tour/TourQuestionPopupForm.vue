<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <div class="text-center">
                <span class="h2 title text-medium">{{ __('forms.reply') }}</span>
            </div>
        </div>
        <form method="post" :action="action" class="popup-align" enctype="multipart/form-data"
              @submit.prevent="onSubmit"
              ref="formRef"
        >
            <slot/>

            <div class="row">
                <div class="col-md-6 col-12">
                    <form-input name="last_name" id="tq_last_name" v-model="data.last_name"
                                :label="__('forms.last-name')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="first_name" id="tq_first_name" v-model="data.first_name"
                                :label="__('forms.name')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="email" id="tq_email" v-model="data.email"
                                :label="__('forms.email')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-phone name="phone" id="tq_phone" v-model="data.phone"
                                :label="__('forms.phone')"/>
                </div>

                <div class="col-12">
                    <form-textarea name="text" id="tq_text" v-model="data.text" class="smile"
                                   :label="__('forms.your-comment')"
                                   :tooltip="__('forms.required')"/>

                    <vue-recaptcha v-if="useRecaptcha" :sitekey="sitekey"
                                   @verify="verify"
                                   @render="render"
                                   ref="recaptcha"
                    >
                        <button id="b34" type="submit" class="btn type-1" :disabled="submitted" @click="validateForm">
                            {{ __('forms.send') }}
                        </button>
                    </vue-recaptcha>
                    <template v-if="!useRecaptcha">
                        <button  id="b35" type="submit" class="btn type-1" :disabled="submitted" @click="validateForm">
                            {{ __('forms.send') }}
                        </button>
                    </template>

                </div>
            </div>

        </form>
    </popup>
</template>

<script>

import { useStore } from 'vuex'
import { computed, reactive, ref, watch } from 'vue'
import { useForm } from 'vee-validate'
import { VueRecaptcha } from 'vue-recaptcha'
import Popup from '../popup/Popup.vue'
import FormInput from '../form/FormInput.vue'
import FormTextarea from '../form/FormTextarea.vue'
import { getError } from '../../services/api.js'
import FormPhone from "../form/FormPhone";
import { __ } from '../../i18n/lang'

export default {
    name: "TourQuestionPopupForm",
    components: {FormPhone, VueRecaptcha, Popup, FormTextarea, FormInput },
    props: {
        tour: Object,
        action: String,
        dataParent: Number,
    },
    setup(props) {
        const store = useStore();
        const user = store.state.user.currentUser
        const parentId = computed(() => store.state.tourQuestion.parentId);
        const popupOpen = computed(() => store.state.tourQuestion.popupOpen);
        const closePopup = () => store.commit('tourQuestion/SET_POPUP_OPEN', false);

        const submitted = ref(false);
        const formRef = ref(null);
        const recaptcha = ref(null);

        const data = reactive({
            first_name: user ? user.first_name : '',
            last_name: user ? user.last_name : '',
            phone: user ? user.mobile_phone : '',
            email: user ? user.email : '',
            text: '',
            parent_id: parentId || 0,
            'g-recaptcha-response': '',
        });

        const { validate, errors } = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'required|tel',
                email: 'required|email',
                text: 'required',
            }
        })

        watch(data, () => submitted.value && (submitted.value = false))

        const onSubmit = async () => {
            submitted.value = true;
            const response = await axios.post(props.action, data)
                .catch(error => {
                    const message = getError(error);
                    toast.error(message);
                });

            if (response?.data?.result === 'success') {
                closePopup();
                if (window._functions) {
                    await store.dispatch('userQuestion/showThanks', {
                        title: __('popup.types.agent-subscription.thanks-title'),
                        message: __('popup.types.agent-subscription.thanks-message'),
                    })
                    window._functions.showPopup('thanks-popup');
                } else {
                    toast.success(response.message);
                }
            }
        };

        const useRecaptcha = String(process.env.MIX_INVISIBLE_RECAPTCHA_ENABLED) === 'true'
        const sitekey = process.env.MIX_INVISIBLE_RECAPTCHA_SITEKEY

        const verify = (e) => {
            data['g-recaptcha-response'] = e
            onSubmit()
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
            }, 1000)
        }

        const validateForm = async (e) => {
            if (e.isTrusted) {
                e.stopImmediatePropagation()
                e.preventDefault()

                const result = await validate();
                if (!result.valid) {
                    return false
                } else {
                    e.target.dispatchEvent(new e.constructor(e.type, e))
                }
            }
        }

        return {
            submitted,
            onSubmit,
            formRef,
            data,
            popupOpen,
            useRecaptcha,
            sitekey,
            recaptcha,
            verify,
            render,
            validateForm,
            closePopup,
        }
    }
}
</script>

<style scoped>

</style>
