<template>
    <label :data-tooltip="errorMessage" :class="{active: !!innerValue || focused, invalid: errorMessage}">
        <i>{{ label }} <span v-if="required">*</span></i>
        <input ref="inputRef"
               class="vue-input"
               @focus="onFocus"
               @blur="onBlur"
               :type="type" v-model="innerValue" :name="name" :id="id || name"
               :required="required">
    </label>
</template>

<script>
import useFormField from "./composables/useFormField";

export default {
    name: "FormInput",
    props: {
        modelValue: {
            type: [Number, String, null]
        },
        name: {
            type: String,
            default: '',
        },
        label: {
            type: String,
            default: '',
        },

        id: {
            type: String,
            default: null,
        },
        type: {
            type: String,
            default: "text",
            validator(value) {
                return [
                    "url",
                    "text",
                    "password",
                    "tel",
                    "search",
                    "number",
                    "email",
                ].includes(value);
            }
        },
        mask: {
            type: String,
            default: '',
        },
        rules: {
            type: [String, Object],
            default: ''
        },
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
