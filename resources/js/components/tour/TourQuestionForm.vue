<template>
    <form ref="formRef" :action="action" class="row" method="POST" @submit.prevent="onSubmit">

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
            <form-phone name="phone" id="tq_phone" v-model="data.phone" :label="__('forms.phone')"/>
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
                <button code="tour.send_question_1" type="submit" class="btn type-1" :disabled="submitted" @click.prevent="validateForm">{{ __('forms.send') }}</button>
            </vue-recaptcha>
            <template v-if="!useRecaptcha">
                <button code="tour.send_question_1" type="submit" class="btn type-1" :disabled="submitted" @click.prevent="validateForm">{{ __('forms.send') }}</button>
            </template>

        </div>
    </form>
</template>

<script>
import { computed, onMounted, reactive, ref, watch } from "vue";
import {getError} from "../../services/api";
import toast from '../../libs/toast'
import FormInput from "../form/FormInput";
import FormTextarea from "../form/FormTextarea";
import { useForm } from 'vee-validate'
import { VueRecaptcha } from 'vue-recaptcha'
import { useStore } from 'vuex'
import FormPhone from "../form/FormPhone";
import axios from "axios";

export default {
    name: "TourQuestionForm",
    components: { FormPhone, VueRecaptcha, FormTextarea, FormInput},
    props: {
        tour: Object,
        action: String,
        dataParent: Number,
    },
    setup(props) {
        const store = useStore();
        const user = store.state.user.currentUser
        const parentId = computed(() => store.state.tourQuestion.parentId);

        const submitted = ref(false);
        const recaptcha = ref(null);
        const formRef = ref(null);

        const data = reactive({
            first_name: user ? user.first_name : '',
            last_name: user ? user.last_name : '',
            phone: user ? user.mobile_phone : '',
            email: user ? user.email : '',
            text: '',
            parent_id: parentId.value || 0,
            'g-recaptcha-response': '',
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

        watch(data, () => submitted.value && (submitted.value = false))

        const onSubmit = async () => {
            submitted.value = true;
            const response = await axios.post(props.action, data)
                .catch(error => {
                    const message = getError(error);
                    toast.error(message);
                });

            if (response?.data?.result === 'success') {
                if (window._functions) {
                    // Close accordion
                    $(formRef.value).closest('.accordion-item').find('.accordion-title').click()
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
                    onSubmit()
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
            formRef,
        }
    }
}
</script>

<style scoped>

</style>
