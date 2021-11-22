<template>
    <div class="tab active">
        <div class="text-center">
            <h1 class="h1"><b>Реєстрація нового <span>туриста</span></b></h1>
            <span class="text">
                Уже є аккаунт?
                <a href="/auth/login" class="open-popup" data-rel="login-popup">Вхід</a>
            </span>
            <div class="spacer-xs"></div>
        </div>
        <div class="form row">
            <input type="hidden" name="role" value="tourist"/>

            <div class="col-md-6 col-12">
                <form-input v-model="data.last_name" rules="required" name="last_name" label="Прізвище"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.first_name" rules="required" name="first_name" label="Ім’я"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.middle_name" rules="required" name="middle_name" label="По-батькові"/>
            </div>

            <div class="col-md-6 col-12">
                <div class="single-datepicker">
                    <form-datepicker v-model="data.birthday" name="birthday" label="Дата народження"/>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.email" rules="required|email" name="email" id="tourist-email" label="Email"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.mobile_phone" rules="required|tel" name="mobile_phone"
                            label="Мобільний телефон"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.viber" name="viber" label="Viber"/>
            </div>

            <div class="col-md-6 col-12"></div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.password" type="password" rules="required" name="password" label="Пароль"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.password_confirmation" type="password" rules="required"
                            name="password_confirmation" label="Повторіть пароль"/>
            </div>
        </div>
    </div>
</template>

<script>
import FormInput from "../form/FormInput";
import FormDatepicker from "../form/FormDatepicker";
import {reactive} from "vue";

export default {
    name: "SignUpTourist",
    components: {FormDatepicker, FormInput},
    setup() {
        const data = reactive({
            first_name: '',
            last_name: '',
            middle_name: '',
            birthday: '',
            email: '',
            mobile_phone: '',
            viber: '',
            password: '',
            password_confirmation: '',
        });

        return {
            data,
        }
    }
}
</script>

<style scoped>

</style>
