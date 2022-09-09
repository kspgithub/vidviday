<template>
    <form :action="action" class="row" method="POST" @submit.prevent="onSubmit()" v-show="!submitted">
        <div class="col-md-6 col-12">

            <form-input name="last_name" id="tq_last_name" v-model="data.last_name" rules="required"
                        :label="__('forms.last-name')"/>

        </div>

        <div class="col-md-6 col-12">
            <form-input name="first_name" id="tq_first_name" v-model="data.first_name" rules="required"
                        :label="__('forms.name')"/>
        </div>

        <div class="col-md-6 col-12">
            <form-input name="email" id="tq_email" v-model="data.email" rules="required"
                        :label="__('forms.email')"/>
        </div>

        <div class="col-md-6 col-12">
            <form-input name="phone" id="tq_phone" mask="+38 (099) 999-99-99" v-model="data.phone" :label="__('forms.phone')"/>
        </div>

        <div class="col-12">
            <form-textarea name="text" id="tq_text" v-model="data.text" class="smile"
                           :label="__('forms.your-comment')"
                           rules="required"
                           :tooltip="__('forms.required')"/>

            <vue-recaptcha v-if="useRecaptcha" :sitekey="sitekey"
                           @verify="verify"
                           @render="render"
                           ref="recaptcha"
            >
                <button type="submit" class="btn type-1" :disabled="submitted" @click="validateForm">
                    {{ __('forms.send') }}
                </button>
            </vue-recaptcha>
            <template v-if="!useRecaptcha">
                <button type="submit" class="btn type-1" :disabled="submitted" @click="validateForm">
                    {{ __('forms.send') }}
                </button>
            </template>

        </div>
    </form>
</template>

<script>
import {reactive, ref} from "vue";
import {getError} from "../../services/api";
import toast from '../../libs/toast'
import FormInput from "../form/FormInput";
import FormTextarea from "../form/FormTextarea";
import { useForm } from 'vee-validate'
import { VueRecaptcha } from 'vue-recaptcha'

export default {
    name: "TourQuestionForm",
    components: {VueRecaptcha, FormTextarea, FormInput},
    props: {
        action: String,
    },
    setup(props) {
        const submitted = ref(false);
        const recaptcha = ref(null);

        const data = reactive({
            first_name: '',
            last_name: '',
            phone: '',
            email: '',
            text: '',
        });

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'required|tel',
                email: 'required|email',
                text: 'required',
            }
        })

        const onSubmit = async () => {
            submitted.value = true;
            const response = await axios.post(props.action, data)
                .catch(error => {
                    const message = getError(error);
                    toast.error(message);
                });


            if (response?.result === 'success') {
                if (window._functions) {
                    window._functions.showPopup('thanks-popup');
                } else {
                    toast.success(response.message);
                }
            }
        }

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
            submitted,
            onSubmit,
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
