<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">

            <form @submit="submitForm" method="POST" action="/" class="row">
                <div class="col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">Замовити дзвінок</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <input type="hidden" name="type" :value="data.type">
                </div>
                <div class="col-md-6 col-12">
                    <form-input name="name" v-model="data.name" rules="required" label="Ваше ім’я"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input mask="+38 (099) 999-99-99"
                                name="phone"
                                rules="tel|required"
                                v-model="data.phone" label="Номер телефону"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" name="email" v-model="data.email" label="Email"/>
                </div>

                <div class="col-md-6 col-12">
                    <select name="question_type" required v-model="data.question_type">
                        <option value="" selected disabled>Тип запитання *</option>
                        <option value="tour">Запитання що до туру</option>
                        <option value="certificate">Запитання що до сертифікату</option>
                        <option value="other">Інше</option>
                    </select>
                </div>

                <div class="col-md-6 col-12">
                    <div class="single-datepicker">
                        <form-datepicker name="call_date" v-model="data.call_date" required label="Дата дзвінка"/>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="timepicker-input">

                        <select name="call_time" v-model="data.call_time" required>
                            <option value="" selected disabled>Час дзвінка</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <form-textarea name="comment" v-model="data.comment" label="Примітки"/>
                    <div class="text text-sm">* обов’язкове для заповнення поле</div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <button type="submit" class="btn type-1" :disabled="request">Замовити дзвінок</button>
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

export default {
    name: "PopupCall",
    components: {FormTextarea, FormDatepicker, FormCustomSelect, FormSelect, FormInput, Popup},
    props: {
        user: Object,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.userQuestion.popupCallOpen);
        const request = computed(() => store.state.userQuestion.request);
        const closePopup = () => store.commit('userQuestion/SET_POPUP_CALL_OPEN', false);


        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                phone: 'required|tel',
                email: 'email',
            },
        });

        const data = reactive({
            type: 0,
            name: props.user && props.user.first_name ? props.user.first_name + ' ' + props.user.last_name : '',
            phone: props.user && props.user.phone ? props.user.phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            question_type: '',
            call_date: '',
            call_time: '',
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
                            message: 'Ми передзвонимо у обраний Вами час'
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
