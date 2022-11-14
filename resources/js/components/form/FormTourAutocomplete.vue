<template>
    <form-autocomplete
        ref="tourSelectRef"
        v-model.number="innerValue"
        :name="name"
        :placeholder="placeholder"
        :search="true"
        :rules="rules"
        :title-field="optionTitle"
        @search="searchTours"
    >
        <option :value="0" :selected="innerValue === 0" disabled>{{ __('forms.select-from-list') }}</option>
        <option v-for="option in tours" :value="option.id">{{ option[optionTitle] }}</option>
    </form-autocomplete>
</template>

<script>
import FormAutocomplete from './FormAutocomplete'
import { computed, nextTick, onMounted, ref, watch } from 'vue'
import { autocompleteTours } from '../../services/tour-service'

export default {
    name: 'FormTourAutocomplete',
    components: { FormAutocomplete },
    props: {
        modelValue: Number,
        name: {
            type: String,
            default: 'tour_id',
        },
        tour: Object,
        placeholder: {
            type: String,
            default: 'Введіть назву тура',
        },
        rules: {
            type: [String, Object],
            default: '',
        },
        optionTitle: {
            type: String,
            default: 'title',
        },
    },
    emits: ['update:modelValue', 'select'],
    setup(props, { emit }) {
        const tourSelectRef = ref(null)

        const tour = ref(props.tour)
        const tours = ref([])

        const innerValue = computed({
            get: () => props.modelValue,
            set: value => {
                const tourItem = tours.value.find(t => t.id === parseInt(value))

                emit('update:modelValue', value)
                emit('select', tourItem)
            },
        })

        const searchTours = async (q = '') => {
            const items = await autocompleteTours(q)
            let tourItems = items || []
            if (tour.value) {
                tourItems = [tour.value, ...tourItems.filter(it => it.id !== parseInt(tour.value.id))]
            }
            tours.value = tourItems
            await nextTick(() => {
                if (tourSelectRef.value) {
                    tourSelectRef.value.update(tours.value)
                }
            })
        }

        onMounted(() => {
            if (tourSelectRef.value) {
                tourSelectRef.value.update(tours.value)
            }
        })

        searchTours()

        return {
            tourSelectRef,
            innerValue,
            tour,
            tours,
            searchTours,
        }
    },
}
</script>

<style scoped></style>
