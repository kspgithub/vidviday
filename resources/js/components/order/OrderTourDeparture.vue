<template>
    <div>
        <span class="text-sm text-medium title">{{ __('order-section.details.departure-date') }}*</span>
        <div class="single-datepicker">

            <div class="datepicker-input">
                <form-select
                    name="schedule_id"
                    :placeholder="__('forms.select-date')"
                    v-if="group_type === 0 && schedules.length > 0 && !request"
                    v-model.number="schedule_id" :options="departureOptions"
                    :preselect="false"
                    :label="__('order-section.details.select-date')+'*'"
                ></form-select>
            </div>

            <form-datepicker
                name="start_date"
                :placeholder="__('forms.select-date')"
                :label="__('order-section.details.select-date')+'*'"
                :disabled="!tour || request"
                v-if="group_type === 1 || schedules.length === 0 || request"
                v-model="start_date"
            ></form-datepicker>
        </div>
    </div>
</template>

<script>
import FormSelectEvent from '../form/FormSelectEvent'
import FormDatepicker from '../form/FormDatepicker'
import { useStore } from 'vuex'
import { computed } from 'vue'
import FormSelect from '../form/FormSelect'
import { __ } from '../../i18n/lang'

export default {
    name: 'OrderTourDeparture',
    components: {FormSelect, FormDatepicker, FormSelectEvent},
    setup() {
        const store = useStore()
        const tour = computed(() => store.state.orderTour.tour)
        const group_type = computed(() => store.state.orderTour.formData.group_type)

        const schedules = computed(() => store.state.orderTour.schedules)
        const request = computed(() => store.state.orderTour.fetchSchedulesRequest)

        const schedule_id = computed({
            get: () => store.state.orderTour.formData.schedule_id,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {schedule_id: val}),
        })

        const start_date = computed({
            get: () => store.state.orderTour.formData.start_date,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {start_date: val}),
        })

        const departureOptions = computed(() => {
            return [{id: 0, start_title: __('forms.select-date')}, ...schedules.value].map((sch) => {
                return {
                    value: sch.id,
                    text: sch.start_title,
                }
            })
        })

        return {
            tour,
            group_type,
            start_date,
            schedule_id,
            schedules,
            departureOptions,
            request,
        }

    },
}
</script>

<style scoped>

</style>
