<template>
    <div class="tab active">
        <div class="text-center">
            <h2 class="h1"><b>{{ __('auth.registration-new') }} <span>{{ __('auth.tour-agent') }}</span></b></h2>
            <span class="text">
                {{ __('auth.have-account') }}
                <a href="/auth/login" class="open-popup" data-rel="login-popup">{{ __('auth.entrance') }}</a>
            </span>
            <div class="spacer-xs"></div>
        </div>
        <div class="form row">
            <input type="hidden" name="role" value="tour-agent"/>

            <button v-if="$isDev" @click.prevent="fillForm">fill</button>

            <div class="col-12">
                <span class="h3">{{ __('auth.travel-agency-info') }}</span>
                <div class="spacer-xs"></div>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.company" rules="required" name="company"
                            :label="__('forms.travel-agency-name')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.address" name="address" :label="__('forms.office-address')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.position" name="position" :label="__('forms.position')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.work_email" name="work_email" :label="__('forms.work-email')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.website" name="website" :label="__('forms.website')"/>
            </div>

            <div class="col-12">
                <div class="spacer-xs"></div>
                <span class="h3">{{ __('auth.personal-information') }}</span>
                <div class="spacer-xs"></div>
            </div>

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
                    <form-datepicker v-model="data.birthday" name="birthday" :label="__('forms.birthday')"/>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.email" rules="required|email" name="email" id="touragent-email"
                            :label="__('forms.email')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.mobile_phone" rules="required|tel" name="mobile_phone"
                            :label="__('forms.mobile-phone')"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.work_phone" rules="tel" name="work_phone" :label="__('forms.work-phone')"
                            mask="+38 (099) 999-99-99"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="data.viber" name="viber" :label="__('forms.viber')">
                    <tooltip variant="light" class="text-center">
                        <span v-html="__('auth.agency-phone-tooltip')"></span>
                    </tooltip>
                </form-input>
            </div>


            <div class="col-md-6 col-12">
                <form-input type="password" rules="required" name="password" :label="__('forms.password')"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input type="password" rules="required" name="password_confirmation"
                            :label="__('forms.password-confirmation')"/>
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

        const fillForm = () => {
            data.first_name = 'fsdfsdfsd'
            data.last_name = 'fsdfsdfsd'
            data.middle_name = 'fsdfsdfsd'
            data.birthday = '01.01.2020'
            data.email = 'maksym.shekhovtsev@gmail.com'
            data.mobile_phone = '+380345436576'
            data.password = 'secret12345'
            data.password_confirmation = 'secret12345'
            data.company = 'fsdfsdfsd'
            data.address = 'fsdfsdfsd'
            data.position = 'fsdfsdfsd'
            data.website = 'fsdfsdfsd'
            data.work_phone = '+380345436576'
            data.work_email = 'fsdfds@fsdfs.fsdfds'
        }

        return {
            data,
            fillForm,
        }
    }
}
</script>

<style scoped>

</style>
