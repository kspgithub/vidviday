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
                <form-input v-model="data.company" rules="required" name="company" label="Назва турфірми"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.address" name="address" label="Адреса офісу"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.position" name="position" label="Посада"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.work_email" name="work_email" label="Електронна пошта фірми"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.website" name="website" label="Адреса веб-сторінки"/>
            </div>

            <div class="col-12">
                <div class="spacer-xs"></div>
                <span class="h3">Особиста інформація</span>
                <div class="spacer-xs"></div>
            </div>

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
                <form-input v-model="data.email" rules="required|email" name="email" id="touragent-email"
                            label="Email"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.mobile_phone" rules="required|tel" name="mobile_phone"
                            label="Мобільний телефон"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.work_phone" rules="tel" name="work_phone" label="Робочий телефон"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.viber" name="viber" label="Viber">
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
import {reactive} from "vue";

export default {
    name: "SignUpTourAgent",
    components: {Tooltip, FormDatepicker, FormInput},
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
            company: '',
            address: '',
            position: '',
            website: '',
            work_phone: '',
            work_email: '',
        });

        return {
            data,
        }
    }
}
</script>

<style scoped>

</style>
