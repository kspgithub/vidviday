<template>
    <div>
        <h2 class="h3">Як ви бажаєте отримати підтвердження?</h2>
        <div class="spacer-xxs"></div>
        <div>
            <div class="radio-accordion" v-for="(conf, idx) in confirmationTypes" :key="'conf-' + conf.value">
                <form-radio v-model="confirmation_type"
                            name="confirmation_type"
                            :value="conf.value"
                            :label="conf.text"/>
                <div class="radio-accordion-toggle"
                     :style="{display: confirmation_type === conf.value ? 'block' : 'none'}">

                    <form-input v-if="conf.value === 1" v-model="email" name="confirmation_email"
                                :rules="confirmation_type === 1 ? 'required|email' : ''"
                                label="Ваш email"/>

                    <form-input v-if="conf.value === 2" v-model="viber" name="confirmation_viber"
                                :rules="confirmation_type === 2 ? 'required|tel' : ''"
                                label="Ваш номер"/>

                    <form-input v-if="conf.value === 3" v-model="phone" name="confirmation_phone"
                                :rules="confirmation_type === 3 ? 'required|tel' : ''"
                                label="Ваш номер"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useDebounceFormDataProperty, useFormDataProperty} from "../../store/composables/useFormData";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import FormRadio from "../form/FormRadio";
import FormInput from "../form/FormInput";

export default {
    name: "OrderConfirmation",
    components: {FormInput, FormRadio},
    setup() {
        const store = useStore();
        const confirmationTypes = computed(() => store.state.orderTour.confirmationTypes);
        const confirmation_type = useFormDataProperty('orderTour', 'confirmation_type');
        const email = useDebounceFormDataProperty('orderTour', 'confirmation_email');
        const viber = useDebounceFormDataProperty('orderTour', 'confirmation_viber');
        const phone = useDebounceFormDataProperty('orderTour', 'confirmation_phone');

        return {
            email,
            viber,
            phone,
            confirmationTypes,
            confirmation_type,
        }
    }
}
</script>

<style scoped>

</style>
