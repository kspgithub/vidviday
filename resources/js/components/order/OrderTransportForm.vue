<template>
    <div>
        <h2 class="h1">Замовити оренду транспорту</h2>
        <div class="spacer-xs"></div>
        <form @submit="onSubmit" :action="action" method="POST" class="row">
            <div class="col-md-6 col-12">
                <form-input name="last_name" v-model="data.last_name" label="Прізвище" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="first_name" v-model="data.first_name" label="Ім’я" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="email" id="transport-email" v-model="data.email" label="Email" rules="email"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="phone" id="transport-phone" v-model="data.phone" label="Телефон"
                            rules="required|tel"/>
            </div>

            <div class="col-md-6 col-12">
                <div class="single-datepicker">
                    <form-datepicker name="start_date" v-model="data.start_date" label="Дата виїзду" rules="required"/>
                    <!--                    <form-date-range-picker v-model="[data.start_date, data.end_date]"-->
                    <!--                                            label="Дата виїзду"-->
                    <!--                                            rules="required"/>-->
                </div>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="duration" v-model="data.duration" label="Тривалість" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="route" v-model="data.route" label="Маршрут" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="places" v-model="data.places" label="Кількість пасажирів" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-sumo-select name="age_group"
                                  v-model="data.age_group"
                                  label="Вікова група пасажирів"
                                  rules="required"
                                  multiple
                                  :options="ageGroupOptions"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="viber" v-model="data.viber" label="Вайбер"/>
            </div>

            <div class="col-12">
                <form-textarea name="comment" id="transport-comment" v-model="data.comment" label="Ваш коментар"/>
                <form-csrf/>
                <div class="text-sm">* обов’язкове для заповнення поле</div>
                <div class="spacer-xs"></div>
                <button type="submit" :disabled="submitted" class="btn type-1">Написати</button>
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

export default {
    name: "OrderTransportForm",
    components: {FormDatepicker, FormCsrf, FormTextarea, FormSumoSelect, FormSelect, FormDateRangePicker, FormInput},
    props: {
        action: {
            type: String,
            default: '/transport'
        }
    },
    setup(props) {
        const store = useStore();
        const submitted = ref(false);

        const data = reactive({
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            viber: '',
            start_date: '',
            end_date: '',
            duration: null,
            route: '',
            places: null,
            age_group: [],
            comment: '',
        });

        const ageGroupOptions = ref([
            {value: 'to-6', text: 'До 6 років'},
            {value: '6-12', text: 'Від 6 до 12 років'},
            {value: '12-18', text: 'Від 12 до 18 років'},
            {value: 'from-18', text: 'Від 18 років'},
        ]);

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'required|tel',
                start_date: 'required',
                //end_date: 'required',
                duration: 'required',
                age_group: () => {
                    return data.age_group.length > 0 ? true : 'Це поле обов\'язкове'
                },
                places: 'required',
                route: 'required',
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
                        message: 'Ми передзвонимо вам у найближчий час',
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
            ageGroupOptions,
            submitted,
            onSubmit,
        }
    }
}
</script>

<style scoped>

</style>
