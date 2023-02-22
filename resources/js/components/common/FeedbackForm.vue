<template>
    <div class="contacts-block">
        <span class="text-md">{{ __('forms.feedback-title') }}</span>
        <form action="/" @submit="submitForm" method="POST">

            <form-input name="name" id="name_feedback" v-model="data.name"
                        :label="__('forms.your-name')"/>
            <form-input name="email" id="email_feedback" v-model="data.email" :label="__('forms.email')" />
            <form-textarea name="comment" id="comment_feedback" v-model="data.comment"
                           :label="__('forms.you-question')" />

            <utm-fields/>
            <vue-recaptcha v-if="useRecaptcha" :sitekey="sitekey"
                           @verify="verify"
                           @render="render"
                           ref="recaptcha"
            >
                <button v-bind="$buttons('forms.send_feedback')" type="submit" class="btn type-2 btn-block" :disabled="request" @click="validateForm">
                    {{ __('forms.send-message') }}
                </button>
            </vue-recaptcha>
            <template v-if="!useRecaptcha">
                <button v-bind="$buttons('forms.send_feedback')" type="submit" class="btn type-2 btn-block" :disabled="request" @click="validateForm">
                    {{ __('forms.send-message') }}
                </button>
            </template>

        </form>
    </div>
</template>

<script>
import FormInput from "../form/FormInput";
import FormTextarea from "../form/FormTextarea";
import {useStore} from "vuex";
import {computed, reactive, ref} from "vue";
import {useForm} from "vee-validate";
import toast from "../../libs/toast";
import UtmFields from "./UtmFields";
import {__} from "../../i18n/lang";
import { VueRecaptcha } from 'vue-recaptcha'

export default {
    name: "FeedbackForm",
    components: {VueRecaptcha, UtmFields, FormTextarea, FormInput},
    props: {
        user: Object,
    },
    setup(props) {
        const store = useStore();
        const request = ref(false);
        const recaptcha = ref(null);

        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                email: 'required|email',
                comment: 'required',
            },
        });

        const data = reactive({
            type: 2,
            name: props.user && props.user.first_name ? props.user.first_name + ' ' + props.user.last_name : '',
            email: props.user && props.user.email ? props.user.email : '',
            comment: '',
            'g-recaptcha-response': '',
        });

        const submitForm = async (event) => {
            event && event.preventDefault();
            const result = await validate();
            if (!result.valid) {
                console.log(errors);
            } else {
                request.value = true;
                const response = await store.dispatch('userQuestion/send', data);

                if (response.data) {
                    if (response.data.result === 'success') {
                        data.comment = '';
                        data.name = '';
                        data.email = '';
                        await store.dispatch('userQuestion/showThanks', {
                            title: __('forms.thank-you-message'),
                            message: __('forms.reply-message')
                        })
                    } else {
                        toast.error(response.data.message);
                        request.value = false;
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
            }, 1000)
        }

        const validateForm = async (e) => {
            if(e.isTrusted) {
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
            data,
            request,

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
