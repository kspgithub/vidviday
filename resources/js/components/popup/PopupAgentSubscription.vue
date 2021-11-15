<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">Розсилка для турфірм</span>
                        <br>
                        <span class="text">Підпишіться на наші новини та особливі пропозиції!</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <form @submit="submitForm" method="POST" :action="action" class="row">
                        <form-csrf/>
                        <div class="col-12">
                            <form-input name="name" id="name_agent_sub"
                                        v-model="data.name" rules="required"
                                        label="Ваше ім’я"/>

                        </div>

                        <div class="col-12">
                            <form-input type="email" name="email" id="email_agent_sub" v-model="data.email"
                                        label="Email"
                                        rules="required|email"/>
                        </div>
                        <div class="col-12">
                            <form-input name="company" id="company_user_sub"
                                        v-model="data.company"
                                        label="Назва турфірми"/>
                        </div>

                        <div class="col-12">
                            <form-input name="viber" id="viber_user_sub"
                                        v-model="data.viber"
                                        label="Viber"/>
                        </div>

                        <div class="col-12">
                            <utm-fields/>
                            <div class="text text-sm">* обов’язкове для заповнення поле</div>
                            <div class="spacer-xs"></div>
                            <div class="text-center">
                                <button type="submit" class="btn type-1" :disabled="request">Підписатись</button>
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

export default {
    name: "PopupAgentSubscription",
    components: {UtmFields, FormCsrf, FormInput, Popup},
    props: {
        action: String,
    },
    setup() {
        const store = useStore();
        const popupOpen = computed(() => store.state.userQuestion.popupAgentSubOpen);
        const request = ref(false);
        const closePopup = () => store.commit('userQuestion/SET_POPUP_AGENT_SUB_OPEN', false);


        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                email: 'required|email',
            },
        });

        const data = reactive({
            name: '',
            email: '',
            company: '',
            viber: '',
            utm_source: '',
            utm_campaign: '',
            utm_content: '',
            utm_medium: '',
            utm_term: '',
        });

        const submitForm = async (event) => {
            event.preventDefault();
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
                            title: response.data.message,
                        })
                    } else {
                        toast.error(response.data.message);
                    }

                }

                request.value = false
            }
        }

        return {
            data,
            request,
            popupOpen,
            closePopup,
            submitForm,
        }
    }
}
</script>

<style scoped>

</style>
