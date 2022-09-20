<template>
    <label :data-tooltip="errorMessage" :class="{active: !!innerValue || focused, invalid: errorMessage}">
        <i>{{ label }} <span v-if="required">*</span></i>
        <textarea v-model="innerValue"
                  :name="name"
                  :id="id || name"
                  :required="required"
                  :placeholder="placeholder"
                  :rows="rows || 3"
                  @input="innerValue = $event.target.value"
        ></textarea>
    </label>
</template>

<script>

import useFormField from "./composables/useFormField";

export default {
    name: "FormTextarea",
    props: {
        modelValue: {
            type: [Number, String, null]
        },
        label: {
            type: String,
            default: '',
        },
        name: {
            type: String,
            default: '',
        },
        placeholder: {
            type: String,
            default: '',
        },
        id: {
            type: String,
            default: null,
        },
        rules: {
            type: [String, Object],
            default: ''
        },
        rows: [String, Number]
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const field = useFormField(props, emit);

        return {
            ...field,
        }
    }
}
</script>

<style scoped>

</style>
