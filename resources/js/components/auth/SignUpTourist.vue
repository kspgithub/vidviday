<template>
    <div class="tab active">
        <div class="text-center">
            <h1 class="h1"><b>{{ __('auth.registration-new') }} <span>{{ __('auth.tourist') }}</span></b></h1>
            <span class="text">
                {{ __('auth.have-account') }}
                <a href="/auth/login" class="open-popup" data-rel="login-popup">{{ __('auth.entrance') }}</a>
            </span>
            <div class="spacer-xs"></div>
        </div>
        <div class="form row">
            <input type="hidden" name="role" value="tourist"/>

            <div class="col-md-6 col-12">
                <form-input v-model="data.last_name" rules="required" name="last_name" :label="__('forms.last-name')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.first_name" rules="required" name="first_name" :label="__('forms.name')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.middle_name" rules="required" name="middle_name"
                            :label="__('forms.middle-name')"/>
            </div>

            <div class="col-md-6 col-12">
                <div class="single-datepicker">
                    <form-datepicker v-model="data.birthday" name="birthday"
                                     :label="__('forms.birthday')"
                                     :placeholder="__('forms.date-format')"
                    />
                </div>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.email" rules="required|email" name="email" id="tourist-email"
                            :label="__('forms.email')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.mobile_phone" name="mobile_phone"
                            :label="__('forms.mobile-phone')"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.viber" name="viber" :label="__('forms.viber')"/>
            </div>

            <div class="col-md-6 col-12"></div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.password" type="password" rules="required" name="password"
                            :label="__('forms.password')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.password_confirmation" type="password" rules="required"
                            name="password_confirmation" :label="__('forms.password-confirmation')"/>
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
