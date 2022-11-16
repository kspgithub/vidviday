<template>
    <div>
        <div class="row mb-10">
            <div class="col-12">
                <span class="text-sm text-medium title">
                    {{
                        program_type === 1 ? __('order-section.details.departure-place-date') : __('order-section.details.departure-date')
                    }}*
                </span>
            </div>
            <div class="col-12 col-md-6">
                <form-input v-model="start_place" name="start_place"
                            :placeholder="__('order-section.details.specify-place') "/>
            </div>
            <div class="col-12 col-md-6">
                <div class="single-datepicker">
                    <form-datepicker
                        name="start_date"
                        v-model="start_date"
                        :min-date="minDate"
                        :max-date="startMaxDate"
                        :label="__('order-section.details.select-departure-date')"
                    ></form-datepicker>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <span class="text-sm text-medium title">
                    {{
                        program_type === 1 ? __('order-section.details.return-place-date') : __('order-section.details.return-date')
                    }}*
                </span>
            </div>
            <div class="col-12 col-md-6">
                <form-input v-model="end_place" name="end_place"
                            :placeholder="__('order-section.details.specify-place')"/>
            </div>
            <div class="col-12 col-md-6">
                <div class="single-datepicker">
                    <form-datepicker
                        name="end_date"
                        v-model="end_date"
                        :min-date="endMinDate"
                        :label="__('order-section.details.select-return-date')"
                    ></form-datepicker>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FormDatepicker from "../form/FormDatepicker";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import FormInput from "../form/FormInput";
import moment from "moment";

export default {
    name: "OrderTourDates",
    components: {FormInput, FormDatepicker},
    setup() {
        const store = useStore();
        store.commit('orderTour/UPDATE_FORM_DATA', {start_date: null, end_date: null});


        const program_type = computed(() => store.state.orderTour.formData.program_type);

        const start_place = computed({
            get: () => store.state.orderTour.formData.start_place,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {start_place: val})
        });

        const start_date = computed({
            get: () => store.state.orderTour.formData.start_date,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {start_date: val})
        });

        const end_date = computed({
            get: () => store.state.orderTour.formData.end_date,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {end_date: val})
        });

        const end_place = computed({
            get: () => store.state.orderTour.formData.end_place,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {end_place: val})
        });

        const minDate = ref(moment().add(1, "day").format('DD.MM.YYYY'));


        if (start_date.value && moment(start_date.value, 'DD.MM.YYYY').isBefore(moment())) {
            start_date.value = moment().add(1, "day").format('DD.MM.YYYY');
        }

        if (start_date.value && end_date.value && moment(end_date.value, 'DD.MM.YYYY').isBefore(moment(start_date.value, 'DD.MM.YYYY'))) {
            end_date.value = moment(start_date.value, 'DD.MM.YYYY').add(1, "day").format('DD.MM.YYYY');
        }


        const endMinDate = computed(() => {
            return start_date.value
                ? start_date.value
                : minDate.value;
        });

        const startMaxDate = computed(() => {
            return end_date.value
                ? end_date.value
                : '';
        });

        return {
            program_type,
            start_date,
            start_place,
            end_date,
            end_place,

            minDate,
            startMaxDate,
            endMinDate,
        }
    }
}
</script>

<style scoped>

</style>
