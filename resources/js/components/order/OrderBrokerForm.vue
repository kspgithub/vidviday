<template>
    <div>
        <h2 class="h1">{{ __('order-section.order-consult') }}</h2>
        <div class="spacer-xs"></div>
        <form @submit="onSubmit" :action="action" method="POST" class="row">
            <div class="col-md-6 col-12">
                <form-input name="last_name" v-model="data.last_name" :label="__('forms.last-name')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="first_name" v-model="data.first_name" :label="__('forms.name')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="email" id="broker-email" v-model="data.email" :label="__('forms.email')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="phone" id="broker-phone" v-model="data.phone" :label="__('forms.phone')"
                            mask="+38 (999) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="viber" v-model="data.viber" :label="__('forms.viber')"/>
            </div>

            <div class="col-12">
                <form-textarea name="comment" id="broker-comment" v-model="data.comment"
                               :label="__('forms.your-comment')"/>
                <form-csrf/>
                <div class="text-sm">{{ __('forms.required-fields') }}</div>
                <div class="spacer-xs"></div>
                <button type="submit" :disabled="submitted" class="btn type-1">
                    {{ __('forms.write') }}
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import FormInput from "../form/FormInput";
import {reactive, ref} from "vue";
import FormDateRangePicker from "../form/FormDateRangePicker";
import FormSelect from "../form/FormSelect";
import FormSumoSelect from "../form/FormSumoSelect";
import FormTextarea from "../form/FormTextarea";
import {useForm} from "vee-validate";
import FormCsrf from "../form/FormCsrf";
import {useStore} from "vuex";
import axios from "axios";
import {getError} from "../../services/api";
import toast from "../../libs/toast";
import FormDatepicker from "../form/FormDatepicker";
import {__} from "../../i18n/lang";
import moment from 'moment/moment.js'

export default {
    name: "OrderBrokerForm",
    components: {FormDatepicker, FormCsrf, FormTextarea, FormSumoSelect, FormSelect, FormDateRangePicker, FormInput},
    props: {
        action: {
            type: String,
            default: '/broker'
        },
        durations: {
            type: Array,
            default: () => []
        },
    },
    setup(props) {
        const store = useStore();
        const submitted = ref(false);

        const user = store.state.user.currentUser

        const data = reactive({
            first_name: user ? user.first_name : '',
            last_name: user ? user.last_name : '',
            email: user ? user.email : '',
            phone: user ? user.mobile_phone : '',
            viber: user ? user.viber : '',
            comment: '',
        });

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                email: 'required|email',
                phone: 'required|tel',
            }
        })

        const onSubmit = async (event) => {
            event.preventDefault();
            const result = await validate();

            if (result.valid) {
                submitted.value = true;
                const {data: response} = await axios.post(props.action, data)
                    .catch(error => {
                        if (!axios.isCancel(error)) {
                            const message = getError(error);
                            toast.error(message);
                            submitted.value = false;
                        }
                    });
                if (response && response.result === 'success') {

                    await store.dispatch('userQuestion/showThanks', {
                        title: response.message,
                        message: __('common.recall'),
                    })
                } else {
                    toast.error(response.message);
                    submitted.value = false;
                }

            } else {
                console.log(errors.value);
            }
        }


        return {
            data,
            submitted,
            onSubmit,
        }
    }
}
</script>

<style scoped>

</style>
