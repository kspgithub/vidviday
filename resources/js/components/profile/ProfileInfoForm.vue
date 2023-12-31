<template>
    <form @submit="onSubmit" :action="action" method="POST" enctype="multipart/form-data" class="tab active"
          autocomplete="off">
        <slot/>
        <div class="only-desktop-pad">
            <h1 class="h2">Особисті дані</h1>
            <hr>
        </div>
        <div class="row">
            <div class="col-xl-8 col-12">
                <div class="row">
                    <div class="col-12">
                        <span class="h4">Фото користувача</span>
                        <div class="spacer-xs"></div>
                        <form-avatar :avatar-url="user.avatar_url"/>
                        <div class="spacer-sm"></div>
                    </div>

                    <div class="col-12" v-if="user.role === 'tour-agent'">
                        <div class="row">
                            <div class="col-12">
                                <span class="h4">Дані турфірми</span>
                            </div>

                            <div class="col-md-6 col-12">
                                <form-input v-model="formData.company" label="Назва турфірми" name="company"/>
                            </div>

                            <div class="col-md-6 col-12">
                                <form-input v-model="formData.address" label="Адреса офісу" name="address"/>
                            </div>

                            <div class="col-md-6 col-12">
                                <form-input v-model="formData.website" label="Веб-сторінка" name="website"/>
                            </div>

                            <div class="col-md-6 col-12">
                                <form-input v-model="formData.position" label="Посада" name="position"/>
                            </div>

                            <div class="col-md-6 col-12">
                                <form-input v-model="formData.work_email" label="Електронна пошта фірми"
                                            name="work_email"/>
                            </div>

                        </div>
                        <div class="spacer-xs"></div>
                    </div>

                    <div class="col-12">
                        <span class="h4">Персональні дані</span>
                    </div>

                    <div class="col-md-6 col-12">
                        <form-input v-model="formData.last_name" :label="__('forms.last-name')" name="last_name"/>
                    </div>

                    <div class="col-md-6 col-12">
                        <form-input v-model="formData.first_name" :label="__('forms.name')" name="first_name"/>
                    </div>

                    <div class="col-md-6 col-12">
                        <form-input v-model="formData.middle_name" label="По-батькові" name="middle_name"/>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="single-datepicker">
                            <form-datepicker v-model="formData.birthday"
                                             label="Дата народження"
                                             name="birthday"
                                             :placeholder="__('forms.date-format')"
                            />
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <form-input v-model="formData.email" :label="__('forms.email')" name="email"
                                    id="profile-email"/>
                    </div>

                    <div class="col-md-6 col-12">
                        <form-phone v-model="formData.mobile_phone"
                                    label="Мобільний телефон"
                                    name="mobile_phone"
                        />
                    </div>

                    <div class="col-md-6 col-12">
                        <form-input v-model="formData.viber" :label="__('forms.viber')" name="viber">
                            <tooltip v-if="user.role === 'tour-agent'">Ваш номер буде додано до турагентської <br>Вайбер-розсилки
                                з акціями, новими
                                турами, даними <br>про наявність місць та іншою корисною інформацією
                            </tooltip>
                        </form-input>
                    </div>

                    <div class="col-12" v-if="user.provider">
                        <div class="spacer-xs"></div>
                        <span class="h4">{{ __('profile-section.registered_using') }}</span>
                    </div>


                    <div class="col-md-6 col-12" v-if="user.provider">
                        <template v-if="user.provider === 'google'">
                            <a href="#" class="btn type-1 btn-block btn-google">
                                <svg-icon icon="google"/>
                                Google
                            </a>
                        </template>

                        <template v-if="user.provider === 'facebook'">
                            <a href="#" class="btn type-1 btn-block btn-fb">
                                <svg-icon icon="facebook"/>
                                Facebook
                            </a>
                        </template>

                    </div>


                    <template v-if="!user.provider">


                        <div class="col-12">
                            <div class="spacer-xs"></div>
                            <span class="h4">Пароль</span>
                        </div>

                        <div class="col-md-6 col-12">
                            <form-input v-model="formData.current_password" type="password" label="Теперішній пароль"
                                        autocomplete="none"
                                        name="current_password"/>
                        </div>

                        <div class="col-md-6 col-12"></div>

                        <div class="col-md-6 col-12">
                            <form-input v-model="formData.new_password" type="password" label="Новий пароль"
                                        name="new_password"/>
                        </div>

                        <div class="col-md-6 col-12">
                            <form-input v-model="formData.password_confirmation" type="password"
                                        label="Повторіть пароль"
                                        name="password_confirmation"/>
                        </div>
                    </template>

                    <div class="col-12">
                        <div class="text-sm">{{ __('forms.required-fields') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row align-items-center">
            <div class="col-md-6 col-5">
                <seo-button code="profile.cancel" type="reset" class="btn btn-read-more text-bold" @click.prevent="resetForm">Скасувати</seo-button>
            </div>

            <div class="col-md-6 col-7 text-right">
                <seo-button code="profile.save" type="submit" class="btn type-1">Зберегти зміни</seo-button>
            </div>
        </div>
    </form>
</template>

<script>
import FormInput from '../form/FormInput'
import FormDatepicker from '../form/FormDatepicker'
import Tooltip from '../common/Tooltip'
import SvgIcon from '../svg/SvgIcon'
import FormAvatar from '../form/FormAvatar'
import { useForm } from 'vee-validate'
import { reactive } from 'vue'
import FormPhone from '../form/FormPhone'
import SeoButton from '../common/SeoButton.vue'
import { __ } from "../../i18n/lang";

export default {
    name: 'ProfileInfoForm',
    components: {SeoButton, FormPhone, FormAvatar, SvgIcon, Tooltip, FormDatepicker, FormInput},
    props: {
        action: String,
        user: Object,
    },
    setup({user}) {
        const formData = reactive({
            first_name: user.first_name || '',
            last_name: user.last_name || '',
            middle_name: user.middle_name || '',
            email: user.email || '',
            birthday: user.birthday || '',
            mobile_phone: user.mobile_phone || '',
            viber: user.viber || '',
            current_password: '',
            new_password: '',
            password_confirmation: '',
            company: user.company || '',
            address: user.address || '',
            website: user.website || '',
            position: user.position || '',
            work_email: user.work_email || '',
        })

        const validationSchema = {
            first_name: 'required',
            last_name: 'required',
            email: 'required|email',
            mobile_phone: 'required|tel',
            avatar_upload: 'mimes:image/jpeg,image/png',
            current_password: () => {
                return formData.new_password.length === 0 ? true : formData.current_password.length === 0 ? 'Введіть пароль' : true
            },
            password_confirmation: () => {
                return formData.new_password.length === 0 || formData.new_password === formData.password_confirmation
                    ? true : __('auth.password-confirm-fail')
            },
        }

        if (user.role === 'tour-agent') {
            Object.assign(validationSchema, {
                company: 'required',
                address: 'required',
                website: 'url',
                work_email: 'email',
            })
        }

        const {validate, errors} = useForm({
            validationSchema,
        })

        const onSubmit = async (event) => {
            const result = await validate()

            if (!result.valid) {
                event.preventDefault()
            }
        }

        const resetForm = async (event) => {
            formData.first_name = user.first_name || ''
            formData.last_name = user.last_name || ''
            formData.middle_name = user.middle_name || ''
            formData.email = user.email || ''
            formData.birthday = user.birthday || ''
            formData.mobile_phone = user.mobile_phone || ''
            formData.viber = user.viber || ''
            formData.current_password = ''
            formData.new_password = ''
            formData.password_confirmation = ''
            formData.company = user.company || ''
            formData.address = user.address || ''
            formData.website = user.website || ''
            formData.position = user.position || ''
            formData.work_email = user.work_email || ''
        }

        return {
            formData,
            onSubmit,
            resetForm,
        }
    },
}
</script>

<style scoped>

</style>
