<template>
    <div class="tab active">
        <div class="text-center">
            <h2 class="h1"><b>Реєстрація нового <span>турагента</span></b></h2>
            <span class="text">
                Уже є аккаунт?
                <a href="/auth/login" class="open-popup" data-rel="login-popup">Вхід</a>
            </span>
            <div class="spacer-xs"></div>
        </div>
        <div class="form row">
            <input type="hidden" name="role" value="tour-agent"/>

            <div class="col-12">
                <span class="h3">Інформація про турфірму</span>
                <div class="spacer-xs"></div>
            </div>

            <div class="col-md-6 col-12">
                <form-input rules="required" name="company" label="Назва турфірми"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="address" label="Адреса офісу"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="position" label="Посада"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="work_email" label="Електронна пошта фірми"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="website" label="Адреса веб-сторінки"/>
            </div>

            <div class="col-12">
                <div class="spacer-xs"></div>
                <span class="h3">Особиста інформація</span>
                <div class="spacer-xs"></div>
            </div>

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
                <form-input rules="tel" name="work_phone" label="Робочий телефон"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input name="viber" label="Viber">
                    <tooltip variant="light" class="text-center">
                        Ваш номер буде додано до турагентської <br>
                        Вайбер-розсилки з акціями, новими турами, даними <br>
                        про наявність місць та іншою корисною інформацією
                    </tooltip>
                </form-input>
            </div>


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
import Tooltip from "../common/Tooltip";

export default {
    name: "SignUpTourAgent",
    components: {Tooltip, FormDatepicker, FormInput}
}
</script>

<style scoped>

</style>
