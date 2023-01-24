<template>
    <div>
        <h2 class="h3">{{ __('order-section.contact.title') }}</h2>
        <div class="spacer-xs"></div>
        <div class="form row">
            <div class="col-md-6 col-12">
                <form-input :label="__('forms.your-name')" name="first_name" v-model="first_name" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input :label="__('forms.your-last-name')" name="last_name" v-model="last_name" rules="required"/>
            </div>

            <div class="col-md-6 col-12">
                <form-phone :label="__('forms.phone-number')" name="phone" id="order-phone" v-model="phone"
                            rules="required|tel"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input :label="__('forms.email')" name="email" id="order-email" v-model="email"
                            rules="required|email"/>
            </div>

            <div class="col-md-6 col-12" v-if="isTourAgent">
                <form-input :label="__('forms.travel-agency')" name="company" v-model="company"/>
            </div>

            <div class="col-md-6 col-12" v-if="group_type === 1">
                <form-input :label="__('forms.organization')" name="company" v-model="company"/>
            </div>

            <div class="col-md-6 col-12">
                <form-input :label="__('forms.viber')" name="viber" v-model="viber"/>
            </div>
        </div>
    </div>
</template>

<script>
import {useFormDataProperty} from "../../store/composables/useFormData";
import {computed} from "vue";
import {useStore} from "vuex";
import FormInput from "../form/FormInput";
import FormPhone from "../form/FormPhone";

export default {
    name: "OrderContact",
    components: {FormPhone, FormInput},
    setup() {
        const store = useStore();
        return {
            first_name: useFormDataProperty('orderTour', 'first_name'),
            last_name: useFormDataProperty('orderTour', 'last_name'),
            email: useFormDataProperty('orderTour', 'email'),
            phone: useFormDataProperty('orderTour', 'phone'),
            company: useFormDataProperty('orderTour', 'company'),
            viber: useFormDataProperty('orderTour', 'viber'),
            group_type: useFormDataProperty('orderTour', 'group_type'),
            isTourAgent: computed(() => store.getters['orderTour/isTourAgent']),
        }
    }
}
</script>

<style scoped>

</style>
