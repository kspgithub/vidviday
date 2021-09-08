<template>
    <form :action="action" class="row" method="POST" @submit.prevent="onSubmit()" v-show="!submitted">
        <div class="col-md-6 col-12">
            <label>
                <i>Прізвище*</i>
                <input v-model="data.last_name" type="text" name="last_name" required>
            </label>
        </div>

        <div class="col-md-6 col-12">
            <label>
                <i>Ім’я*</i>
                <input v-model="data.first_name" type="text" name="first_name" required>
            </label>
        </div>

        <div class="col-md-6 col-12">
            <label>
                <i>Email*</i>
                <input v-model="data.email" type="email" name="email" required>
            </label>
        </div>

        <div class="col-md-6 col-12">
            <label>
                <i>Телефон</i>
                <input v-model="data.phone" type="tel" name="phone">
            </label>
        </div>

        <div class="col-12">
            <label>
                <i>Ваш коментар*</i>
                <textarea v-model="data.text" name="text" required></textarea>
            </label>
            <button type="submit" class="btn type-1" :disabled="submitted">Надіслати</button>
        </div>
    </form>
</template>

<script>
import {reactive, ref} from "vue";
import {getError} from "../../services/api";
import toast from '../../libs/toast'

export default {
    name: "TourQuestionForm",
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
