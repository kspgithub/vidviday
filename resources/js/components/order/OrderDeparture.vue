<template>
    <div>
        <span class="text-sm text-medium title">Дата виїзду*</span>
        <div class="single-datepicker">
            <form-datepicker
                name="start_date"
                v-model="start_date"
            ></form-datepicker>
        </div>
    </div>
</template>

<script>
import FormDatepicker from "../form/FormDatepicker";
import {useFormDataProperty} from "../../store/composables/useFormData";

export default {
    name: "OrderDeparture",
    components: {FormDatepicker},
    setup() {
        return {
            start_date: useFormDataProperty('orderTour', 'start_date'),
        }
    }
}
</script>

<style scoped>

</style>
