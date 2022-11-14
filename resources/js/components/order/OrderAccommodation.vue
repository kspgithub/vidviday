<template>
    <div>
        <h2 class="h3 mb-40">{{ __('order-section.accommodation.title') }}</h2>
        <div class="row mb-40">
            <div class="col-xl-9 col-12">
                <div class="text">
                    <p>{{ __('order-section.accommodation.description') }}</p>
                </div>
            </div>
        </div>

        <div v-for="room in rooms" class="apartment-option">
            <form-number-input
                :model-value="accommodation[room.slug_key] || 0"
                :name="'accommodation[' + room.slug_key + ']'"
                @update:model-value="updateAccommodation($event, room.slug_key)"
            />
            <span class="text">{{ room.title }} ({{ room.description }})</span>
        </div>

        <div class="checkbox-accordion">
            <form-checkbox
                v-model="accommodation.other"
                class="small"
                :model-value="accommodation.other || 0"
                name="accommodation[other]"
                :label="__('order-section.accommodation.other')"
                @update:model-value="updateAccommodation($event, 'other')"
            />

            <slide-up-down v-model="isOtherOpen" :duration="300" class="hidden-textarea d-block">
                <div class="spacer-xs"></div>
                <form-textarea
                    :model-value="accommodation.other_text || ''"
                    name="accommodation[other_text]"
                    :label="__('order-section.accommodation.other-label')"
                    @update:model-value="updateAccommodation($event, 'other_text')"
                />
            </slide-up-down>
        </div>
    </div>
</template>

<script>
import FormNumberInput from '../form/FormNumberInput'
import FormCheckbox from '../form/FormCheckbox'
import SlideUpDown from 'vue3-slide-up-down'
import FormTextarea from '../form/FormTextarea'
import { useStore } from 'vuex'
import { computed } from 'vue'

export default {
    name: 'OrderAccommodation',
    components: { FormTextarea, FormCheckbox, FormNumberInput, SlideUpDown },
    setup() {
        const store = useStore()

        const accommodation = computed(() => store.state.orderTour.formData.accommodation)
        const rooms = computed(() => store.state.orderTour.rooms)
        const isOtherOpen = computed(() => accommodation.value.other === 1)

        const updateAccommodation = (value, key) => {
            const accomm = accommodation.value
            accomm[key] = value || 0
            store.commit('orderTour/UPDATE_FORM_DATA', { accommodation: accomm })
        }

        return {
            rooms,
            accommodation,
            isOtherOpen,
            updateAccommodation,
        }
    },
}
</script>

<style scoped></style>
