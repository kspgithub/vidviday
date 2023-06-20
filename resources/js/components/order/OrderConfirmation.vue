<template>
    <div>
        <h2 class="h3">{{ __('order-section.confirmation.question') }}</h2>
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
                                :label="__('forms.your-email')"/>

                    <form-input v-if="conf.value === 2" v-model="viber" name="confirmation_viber"
                                :rules="confirmation_type === 2 ? 'required|tel' : ''"
                                :label="__('forms.viber')"/>

                    <form-input v-if="conf.value === 3" v-model="phone" name="confirmation_phone"
                                :rules="confirmation_type === 3 ? 'required|tel' : ''"
                                :label="__('forms.your-phone')"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useDebounceFormDataProperty, useFormDataProperty} from "../../store/composables/useFormData";
import {useStore} from "vuex";
import {computed, ref, watch} from "vue";
import FormRadio from "../form/FormRadio";
import FormInput from "../form/FormInput";

export default {
  name: "OrderConfirmation",
  components: { FormInput, FormRadio },
  setup() {
    const store = useStore();

    const email = ref(store.state.orderTour.formData.email);
    const viber = ref(store.state.orderTour.formData.viber);
    const phone = ref(store.state.orderTour.formData.phone);

    watch(
      () => store.state.orderTour.formData,
      (newValue) => {
        email.value = newValue.email;
        viber.value = newValue.viber;
        phone.value = newValue.phone;
      }
    );

    watch(email, (newValue) => {
      store.state.orderTour.formData.confirmation_email = newValue;
    });
    watch(viber, (newValue) => {
      store.state.orderTour.formData.confirmation_viber = newValue;
    });
    watch(phone, (newValue) => {
      store.state.orderTour.formData.confirmation_phone = newValue;
    });

    const confirmationTypes = computed(() => store.state.orderTour.confirmationTypes);
    const confirmation_type = useFormDataProperty("orderTour", "confirmation_type");

    return {
      email,
      viber,
      phone,
      confirmationTypes,
      confirmation_type,
    };
  },
};

</script>

<style scoped>

</style>
