<template>
    <div>
        <span class="text-sm">{{ __('order-section.program.title') }}</span>
        <div>
            <label class="radio">
                <input v-model="program_type" type="radio" name="program_type" :value="0" />
                <span>{{ __('order-section.program.type-exists') }}</span>
            </label>

            <label class="radio">
                <input v-model="program_type" type="radio" name="program_type" :value="1" />
                <span>{{ __('order-section.program.type-make') }}р</span>
            </label>
        </div>
    </div>
</template>

<script>
import { useStore } from 'vuex'
import { computed } from 'vue'

export default {
    name: 'OrderProgramType',
    setup() {
        const store = useStore()
        const program_type = computed({
            get: () => store.state.orderTour.formData.program_type,
            set: val => store.commit('orderTour/UPDATE_FORM_DATA', { program_type: val }),
        })

        return {
            program_type,
        }
    },
}
</script>

<style scoped></style>
