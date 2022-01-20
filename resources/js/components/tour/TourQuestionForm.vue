<template>
    <form :action="action" class="row" method="POST" @submit.prevent="onSubmit()" v-show="!submitted">
        <div class="col-md-6 col-12">

            <form-input name="last_name" id="tq_last_name" v-model="data.last_name" rules="required"
                        :label="__('forms.last-name')"/>

        </div>

        <div class="col-md-6 col-12">
            <form-input name="first_name" id="tq_first_name" v-model="data.first_name" rules="required"
                        :label="__('forms.name')"/>
        </div>

        <div class="col-md-6 col-12">
            <form-input name="email" id="tq_email" v-model="data.email" rules="required"
                        :label="__('forms.email')"/>
        </div>

        <div class="col-md-6 col-12">
            <form-input name="phone" id="tq_phone" v-model="data.phone" :label="__('forms.phone')"/>
        </div>

        <div class="col-12">

            <form-textarea name="text" id="tt_text" v-model="data.text" class="smile"
                           :label="__('forms.your-comment')"
                           rules="required"
                           :tooltip="__('forms.required')"/>

            <button type="submit" class="btn type-1" :disabled="submitted">
                {{ __('forms.send') }}
            </button>
        </div>
    </form>
</template>

<script>
import {reactive, ref} from "vue";
import {getError} from "../../services/api";
import toast from '../../libs/toast'
import FormInput from "../form/FormInput";

export default {
    name: "TourQuestionForm",
    components: {FormInput},
    props: {
        action: String,
    },
    setup(props) {
        const submitted = ref(false);

        const data = reactive({
            first_name: '',
            last_name: '',
            phone: '',
            email: '',
            text: '',
        });

        const onSubmit = async () => {
            submitted.value = true;
            const response = await axios.post(props.action, data)
                .catch(error => {
                    const message = getError(error);
                    toast.error(message);
                });


            if (response.result === 'success') {
                if (window._functions) {
                    window._functions.showPopup('thanks-popup');
                } else {
                    toast.success(response.message);
                }
            }
        }

        return {
            data,
            submitted,
            onSubmit
        }
    }
}
</script>

<style scoped>

</style>
