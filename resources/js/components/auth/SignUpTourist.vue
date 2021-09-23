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
                <form-input rules="required" name="last_name" label="Прізвище"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input rules="required" name="first_name" label="Ім’я"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input rules="required" name="middle_name" label="По-батькові"/>
            </div>

            <div class="col-md-6 col-12">
                <div class="single-datepicker">
                    <form-datepicker name="birthday" label="Дата народження"/>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <form-input rules="required|email" name="email" label="Email"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input rules="required|tel" name="mobile_phone" label="Мобільний телефон"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="viber" label="Viber"/>
            </div>

            <div class="col-md-6 col-12"></div>

            <div class="col-md-6 col-12">
                <form-input type="password" rules="required" name="password" label="Пароль"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input type="password" rules="required" name="password_confirmation" label="Повторіть пароль"/>
            </div>
        </div>
    </div>
</template>

<script>
import FormInput from "../form/FormInput";
import FormDatepicker from "../form/FormDatepicker";

export default {
    name: "SignUpTourist",
    components: {FormDatepicker, FormInput},
}
</script>

<style scoped>

</style>
