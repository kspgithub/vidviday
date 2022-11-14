<template>
    <div>
        <h2 class="h3">{{ __('order-section.contact.title') }}</h2>
        <div class="spacer-xs"></div>
        <div class="form row">
            <div class="col-md-6 col-12">
                <form-input v-model="first_name" :label="__('forms.your-name')" name="first_name" rules="required" />
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="last_name" :label="__('forms.your-last-name')" name="last_name" rules="required" />
            </div>

            <div class="col-md-6 col-12">
                <form-input
                    id="order-phone"
                    v-model="phone"
                    :label="__('forms.phone-number')"
                    name="phone"
                    mask="+38 (099) 999-99-99"
                    rules="required|tel"
                />
            </div>

            <div class="col-md-6 col-12">
                <form-input
                    id="order-email"
                    v-model="email"
                    :label="__('forms.email')"
                    name="email"
                    rules="required|email"
                />
            </div>

            <div v-if="isTourAgent" class="col-md-6 col-12">
                <form-input v-model="company" :label="__('forms.travel-agency')" name="company" />
            </div>

            <div class="col-md-6 col-12">
                <form-input v-model="viber" :label="__('forms.viber')" name="viber" />
            </div>
        </div>
    </div>
</template>

<script>
import { useFormDataProperty } from '../../store/composables/useFormData'
import { computed } from 'vue'
import { useStore } from 'vuex'
import FormInput from '../form/FormInput'

export default {
    name: 'OrderContact',
    components: { FormInput },
    setup() {
        const store = useStore()
        return {
            first_name: useFormDataProperty('orderTour', 'first_name'),
            last_name: useFormDataProperty('orderTour', 'last_name'),
            email: useFormDataProperty('orderTour', 'email'),
            phone: useFormDataProperty('orderTour', 'phone'),
            company: useFormDataProperty('orderTour', 'company'),
            viber: useFormDataProperty('orderTour', 'viber'),
            isTourAgent: computed(() => store.getters['orderTour/isTourAgent']),
        }
    },
}
</script>

<style scoped></style>
