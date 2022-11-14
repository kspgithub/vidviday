<template>
    <div>
        <span class="text text-sm">
            <b>{{ __('order-section.tour') }}*</b>
        </span>
        <form-autocomplete
            ref="tourSelectRef"
            v-model="tourId"
            name="tour_id"
            :placeholder="__('order-section.tour-placeholder')"
            search
            rules="required"
            @search="searchTours"
        >
            <option :value="0" :selected="tourId === 0" disabled>{{ __('order-section.tour-placeholder') }}</option>
            <option v-for="option in tours" :value="option.id">{{ option.title }}</option>
        </form-autocomplete>
    </div>
</template>

<script>
import { computed, ref } from 'vue'
import FormAutocomplete from '../form/FormAutocomplete'
import { autocompleteTours } from '../../services/tour-service'
import FormCustomSelect from '../form/FormCustomSelect'
import { useStore } from 'vuex'

export default {
    name: 'OrderTourSelector',
    components: { FormCustomSelect, FormAutocomplete },
    setup() {
        const store = useStore()
        const tours = ref([])
        const tourSelectRef = ref(null)

        const tourId = computed({
            get: () => store.state.orderTour.formData.tour_id,
            set: async val => {
                const tour = tours.value.find(t => t.id === parseInt(val))
                store.commit('orderTour/SET_TOUR', tour)
                await store.dispatch('orderTour/fetchSchedules', val || 0)
            },
        })

        const searchTours = async (q = '') => {
            const items = await autocompleteTours(q, q.length > 0 ? 50 : 1000)
            tours.value = items || []
            tourSelectRef.value.update(tours.value)
        }

        searchTours()

        return {
            tours,
            tourSelectRef,
            searchTours,
            tourId,
        }
    },
}
</script>

<style scoped></style>
