<template>
    <div class="row">
        <div class="col-lg-4 col-12">
            <span class="text text-sm title"><b>До якої дати надіслати пропозицію?*</b></span>
            <div class="single-datepicker">
                <form-datepicker name="offer_date" v-model="offer_date" rules="required"/>
            </div>
        </div>
    </div>
</template>

<script>
import FormDatepicker from "../form/FormDatepicker";
import {useFormDataProperty} from "../../store/composables/useFormData";

export default {
    name: "OrderOfferDate",
    components: {FormDatepicker},
    setup() {
        return {
            offer_date: useFormDataProperty('orderTour', 'offer_date'),
        }
    }
}
</script>

<style scoped>

</style>
