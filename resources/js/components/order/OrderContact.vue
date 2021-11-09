<template>
    <div>
        <h2 class="h3">Контактна особа</h2>
        <div class="spacer-xs"></div>
        <div class="form row">
            <div class="col-md-6 col-12">
                <form-input label="Ваше ім’я" name="first_name" v-model="first_name" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input label="Ваше прізвище" name="last_name" v-model="last_name" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input label="Номер телефону" name="phone" v-model="phone" mask="+38 (099) 999-99-99"
                            rules="required|tel"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input label="Email" name="email" v-model="email" rules="required|email"/>
            </div>

            <div class="col-md-6 col-12" v-if="isTourAgent">
                <form-input label="Турфірма" name="company" v-model="company"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input label="Viber" name="viber" v-model="viber"/>
            </div>
        </div>
    </div>
</template>

<script>
import {useFormDataProperty} from "../../store/composables/useFormData";
import {computed} from "vue";
import {useStore} from "vuex";
import FormInput from "../form/FormInput";

export default {
    name: "OrderContact",
    components: {FormInput},
    setup() {
        const store = useStore();
        return {
            first_name: useFormDataProperty('orderTour', 'first_name'),
            last_name: useFormDataProperty('orderTour', 'last_name'),
            email: useFormDataProperty('orderTour', 'email'),
            phone: useFormDataProperty('orderTour', 'phone'),
            company: useFormDataProperty('orderTour', 'company'),
            viber: useFormDataProperty('orderTour', 'viber'),
            isTourAgent: computed(() => store.getters['orderTour/isTourAgent']),
        }
    }
}
</script>

<style scoped>

</style>
