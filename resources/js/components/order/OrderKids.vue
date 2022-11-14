<template>
    <div>
        <slide-up-down :model-value="show" :duration="300">
            <span class="text text-medium title inline">{{ __('order-section.kids.question') }}</span>
            <form-checkbox v-model="children" name="children" :label="__('forms.yes')" />
            <div class="text">
                <p v-for="chDiscount in childrenDiscounts">{{ chDiscount.title['uk'] }}</p>
            </div>
        </slide-up-down>
        <div class="my-20"></div>
        <slide-up-down :model-value="show && children === 1" :duration="300" class="order-children-input">
            <div class="mb-10">
                <form-number-input
                    v-model="children_young"
                    :min="0"
                    name="children_young"
                    :title="young_title"
                    :suffix="__('order-section.kids.with-place')"
                />
            </div>
            <div class="mb-10">
                <form-number-input
                    v-model="without_place_count"
                    :min="0"
                    name="without_place_count"
                    :title="__('order-section.kids.up-6')"
                    :suffix="__('order-section.kids.without-place')"
                />
            </div>

            <div class="mb-10">
                <form-number-input v-model="children_older" :min="0" name="children_older" :title="older_title" />
            </div>
        </slide-up-down>
    </div>
</template>

<script>
import SlideUpDown from 'vue3-slide-up-down'
import FormCheckbox from '../form/FormCheckbox'
import FormNumberInput from '../form/FormNumberInput'
import { useStore } from 'vuex'
import { useFormDataProperty } from '../../store/composables/useFormData'
import { computed, onMounted, watch } from 'vue'
import { __ } from '../../i18n/lang'

export default {
    name: 'OrderKids',
    components: { FormNumberInput, FormCheckbox, SlideUpDown },
    props: {
        show: Boolean,
    },
    setup() {
        const store = useStore()
        const childrenDiscounts = computed(() => store.getters['orderTour/childrenDiscounts'])
        const young_title = computed(() => {
            const discount = childrenDiscounts.value.find(d => d.category === 'children_young')
            return discount && discount.age_limit
                ? __('order-section.kids.up-count').replace(':up', discount.age_end)
                : __('order-section.kids.up-6')
        })

        const older_title = computed(() => {
            const discount = childrenDiscounts.value.find(d => d.category === 'children_older')
            return discount && discount.age_limit
                ? __('order-section.kids.from-to').replace(':from', discount.age_start).replace(':to', discount.age_end)
                : __('order-section.kids.from-6-to-12')
        })

        const children_young = computed({
            get() {
                return store.state.orderTour.formData.children_young
            },
            set(value) {
                store.commit('orderTour/UPDATE_FORM_DATA', { children_young: value })
            },
        })

        const without_place_count = computed({
            get() {
                return store.state.orderTour.formData.without_place_count
            },
            set(value) {
                store.commit('orderTour/UPDATE_FORM_DATA', { without_place_count: value })
            },
        })

        return {
            without_place: useFormDataProperty('orderTour', 'without_place'),
            without_place_count: without_place_count,
            children: useFormDataProperty('orderTour', 'children'),
            children_young: children_young,
            young_title,
            children_older: useFormDataProperty('orderTour', 'children_older'),
            older_title,
            childrenDiscounts,
        }
    },
}
</script>

<style scoped></style>
