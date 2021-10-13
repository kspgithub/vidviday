<template>
    <div class="contacts-block">
        <span class="text-md">Питання? Скарги? Пропозиції?</span>
        <form action="/" @submit="submitForm" method="POST">

            <form-input name="name" id="name_feedback" v-model="data.name" rules="required" label="Ваше ім’я"/>
            <form-input name="email" id="email_feedback" v-model="data.email" label="Email"
                        rules="required|email"/>
            <form-textarea name="comment" id="comment_feedback" v-model="data.comment"
                           label="Ваше питання, скарга чи пропозиція"
                           rules="required"/>
            <button type="submit" class="btn type-2 btn-block" :disabled="request">Надіслати повідомлення</button>
        </form>
    </div>
</template>

<script>
import FormInput from "../form/FormInput";
import FormTextarea from "../form/FormTextarea";
import {useStore} from "vuex";
import {computed, reactive, ref} from "vue";
import {useForm} from "vee-validate";
import toast from "../../libs/toast";

export default {
    name: "FeedbackForm",
    components: {FormTextarea, FormInput},
    props: {
        user: Object,
    },
    setup(props) {
        const store = useStore();
        const request = ref(false);

        const {validate, errors, values} = useForm({
            validationSchema: {
                name: 'required',
                email: 'required|email',
                comment: 'required',
            },
        });

        const data = reactive({
            type: 2,
            name: props.user && props.user.first_name ? props.user.first_name + ' ' + props.user.last_name : '',
            email: props.user && props.user.email ? props.user.email : '',
            comment: '',
        });

        const submitForm = async (event) => {
            event.preventDefault();
            const result = await validate();
            if (!result.valid) {
                console.log(errors);
            } else {
                request.value = true;
                const response = await store.dispatch('userQuestion/send', data);

                if (response.data) {
                    if (response.data.result === 'success') {
                        data.comment = '';
                        data.name = '';
                        data.email = '';
                        await store.dispatch('userQuestion/showThanks', {
                            title: 'Дякуємо за повідомлення',
                            message: 'ми відповімо вам найближчим часом'
                        })
                    } else {
                        toast.error(response.data.message);
                        request.value = false;
                    }

                }


            }
        }

        return {
            data,
            request,

            submitForm,
        }
    }
}
</script>

<style scoped>

</style>
