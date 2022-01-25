<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">

            <form @submit="submitForm" method="POST" action="/" class="row">
                <div class="col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">Написати листа</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <input type="hidden" name="type" :value="data.type">
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="name" id="name_mail" v-model="data.name" rules="required"
                                :label="__('forms.your-name')"/>
                </div>


                <div class="col-md-6 col-12">
                    <form-input type="email" name="email" id="email_mail" v-model="data.email"
                                :label="__('forms.email')"
                                rules="required|email"/>
                </div>
                <div class="col-md-6 col-12">
                    <form-input mask="+38 (099) 999-99-99"
                                name="phone"
                                id="phone_mail"
                                rules="tel"
                                v-model="data.phone" :label="__('forms.phone-number')"/>
                </div>
                <div class="col-md-6 col-12">
                    <select name="question_type" required v-model="data.question_type">
                        <option value="" selected disabled>Тип запитання *</option>
                        <option value="tour">Запитання що до туру</option>
                        <option value="certificate">Запитання що до сертифікату</option>
                        <option value="other">Інше</option>
                    </select>
                </div>

                <div class="col-12">
                    <utm-fields/>
                    <form-textarea name="comment" id="comment_mail" v-model="data.comment" label="Текст повідомлення"
                                   rules="required"/>
                    <div class="text text-sm">{{ __('forms.required-fields') }}</div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <button type="submit" class="btn type-1" :disabled="request">Надіслати</button>
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

export default {
    name: "PopupEmail",
    components: {UtmFields, FormTextarea, FormDatepicker, FormCustomSelect, FormSelect, FormInput, Popup},
    props: {
        user: Object,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.userQuestion.popupMailOpen);
        const request = computed(() => store.state.userQuestion.request);
        const closePopup = () => store.commit('userQuestion/SET_POPUP_MAIL_OPEN', false);


        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                phone: 'tel',
                email: 'required|email',
                comment: 'required',
            },
        });

        const data = reactive({
            type: 1,
            name: props.user && props.user.first_name ? props.user.first_name + ' ' + props.user.last_name : '',
            phone: props.user && props.user.phone ? props.user.phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            question_type: '',
            comment: '',
        });

        const submitForm = async (event) => {
            event.preventDefault();
            const result = await validate();
            if (!result.valid) {

                console.log(errors);
            } else {

                const response = await store.dispatch('userQuestion/send', data);

                if (response.data) {
                    if (response.data.result === 'success') {
                        closePopup();
                        await store.dispatch('userQuestion/showThanks', {
                            title: 'Дякуємо за повідомлення',
                            message: 'ми відповімо вам найближчим часом'
                        })
                    } else {
                        toast.error(response.data.message);
                    }

                }
            }
        }

        return {
            data,
            popupOpen,
            request,
            closePopup,
            submitForm,
        }
    }
}
</script>

<style scoped>

</style>
