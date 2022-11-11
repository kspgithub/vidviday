<template>
    <label class="checkbox vue-checkbox" :class="{ active: innerValue === trueValue }">
        <input v-model="innerValue" type="checkbox" :true-value="trueValue" :false-value="falseValue" />
        <span>{{ label }}</span>
        <input type="hidden" :name="name" :value="innerValue" />
    </label>
</template>

<script>
import { computed } from 'vue'

export default {
    name: 'FormCheckbox',
    props: {
        modelValue: Number,
        name: String,
        label: String,
        trueValue: {
            default: 1,
        },
        falseValue: {
            default: 0,
        },
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const innerValue = computed({
            get() {
                return props.modelValue
            },
            set(val) {
                emit('update:modelValue', val)
            },
        })
        return {
            innerValue,
        }
    },
}
</script>

<style scoped></style>
