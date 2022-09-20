<template>
    <div class="vacancy-form">
        <span class="h3">{{ formTitle || __('common.vacancy.form-title') }}</span>
        <div class="spacer-xs"></div>
        <div class="text">
            <p>{{ formSubTitle || __('common.vacancy.form-sub-title') }}</p>
        </div>
        <div class="spacer-xs"></div>
        <form @submit="onSubmit" :action="action" method="POST">
            <form-csrf/>
            <form-input name="first_name" v-model="data.first_name" :label="__('forms.your-name')"/>
            <form-input name="last_name" v-model="data.last_name" :label="__('forms.your-last-name')"/>
            <form-input name="phone" id="vacancy_phone" v-model="data.phone"
                        :label="__('forms.your-phone')"
                        mask="+38 (999) 999-99-99"
            />
            <form-input name="email" id="vacancy_email" v-model="data.email"
                        :label="__('forms.email')"/>
            <form-textarea name="comment" id="vacancy_comment" v-model="data.comment"
                           :label="__('forms.your-comment')"/>
            <form-file name="attachment" v-model="data.attachment" :label="__('common.vacancy.attach-resume')"
                       accept="pdf,doc,docx"/>
            <utm-fields/>
            <button class="btn type-1 btn-block" :disabled="submitted">
                {{ __('common.vacancy.send-resume') }}
            </button>
        </form>
    </div>
</template>

<script>
import FormCsrf from "../form/FormCsrf";
import FormInput from "../form/FormInput";
import {computed, reactive, ref} from "vue";
import FormTextarea from "../form/FormTextarea";
import FormFile from "../form/FormFile";
import UtmFields from "../common/UtmFields";
import {useForm} from "vee-validate";
import {useStore} from "vuex";
import axios from "axios";
import {getError} from "../../services/api";
import toast from "../../libs/toast";

export default {
    name: "VacancyForm",
    components: {UtmFields, FormFile, FormTextarea, FormInput, FormCsrf},
    props: {
        action: {
            type: String,
            default: '/api/user/feedback'
        },
        formTitle: {
            type: String,
        },
        formSubTitle: {
            type: String,
        },
    },
    setup(props) {
        const store = useStore();
        const submitted = ref(false);

        const defaultData = {
            type: 3,
            first_name: '',
            last_name: '',
            phone: '',
            email: '',
            comment: '',
            attachment: null,
        }

        const data = reactive({
            ...defaultData
        });

        const resetForm = () => {

            Object.assign(data, {
                ...defaultData
            })
        }

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'required|tel',
                email: 'required|email',
                attachment: 'size:1024|ext:pdf,doc,docx',
            }
        })

        const utmFields = computed(() => store.state.analytics.utm);

        const onSubmit = async (evt) => {
            evt.preventDefault();
            const result = await validate();
            if (result.valid) {
                submitted.value = true;

                const formData = new FormData();
                formData.append('name', data.last_name + ' ' + data.first_name);
                for (let key in data) {
                    if (key !== 'first_name' && key !== 'last_name') {
                        formData.append(key, data[key]);
                    }

                }
                for (let key in utmFields.value) {
                    formData.append(key, utmFields.value[key]);
                }

                const response = await axios.post(props.action, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .catch(error => {
                        if (!axios.isCancel(error)) {
                            const message = getError(error);
                            toast.error(message);
                            submitted.value = false;
                        }
                    });


                if (response?.data) {
                    if (response.data.result === 'success') {
                        resetForm()

                        await store.dispatch('userQuestion/showThanks', {
                            title: response.data.message
                        })
                    } else {
                        toast.error(response.data.message);
                        submitted.value = false;
                    }

                }

            } else {
                console.log(errors.value);
            }
        }

        return {
            data,
            submitted,
            onSubmit,
            resetForm,
        }
    }
}
</script>

<style scoped>

</style>
