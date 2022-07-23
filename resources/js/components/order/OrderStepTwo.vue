<template>
    <div class="tab" :class="{active: active}">
        <order-tour-participants/>
        <hr class="my-15 my-lg-20 my-xl-40">
        <order-accommodation v-if="tour.active_tabs.indexOf('accommodation') > -1"/>
    </div>
</template>

<script>
import {computed} from "vue";
import {useStore} from "vuex";
import OrderParticipant from "./OrderParticipant";
import {useDebounceFormDataProperty, useFormDataProperty} from "../../store/composables/useFormData";
import FormInput from "../form/FormInput";
import FormNumberInput from "../form/FormNumberInput";
import FormCheckbox from "../form/FormCheckbox";
import FormTextarea from "../form/FormTextarea";
import SlideUpDown from 'vue3-slide-up-down';
import OrderTourParticipants from "./OrderTourParticipants";
import OrderAccommodation from "./OrderAccommodation";

export default {
    name: "OrderStepTwo",
    components: {
        OrderAccommodation,
        OrderTourParticipants,
    },
    props: {
        active: Boolean,
        tour: Object,
    },
    setup() {


        return {}
    }
}
</script>

<style scoped>

</style>
