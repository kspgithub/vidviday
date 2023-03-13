<template>
    <label class="checkbox vue-checkbox" :data-tooltip="errorMessage" :class="{invalid: errorMessage, active: innerValue === trueValue}">
        <input type="checkbox"
               v-model="innerValue"
               :true-value="trueValue"
               :false-value="falseValue"
               required>
        <span>{{ label }}</span>
        <input type="hidden" :name="name" :value="innerValue">
        <em class="text">
            <a href="/terms" target="_blank">&nbsp;{{ __('order-section.booking-rules') }}</a>
        </em>
    </label>
</template>

<script>
import {computed} from "vue";
import useFormField from "./composables/useFormField";

export default {
    name: "FormCheckbox",
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
        rules: {
            type: [String, Object],
            default: ''
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const {errorMessage} = useFormField(props, emit);
        const innerValue = computed({
            get() {
                return props.modelValue;
            },
            set(val) {
                emit('update:modelValue', val);
            }
        })
        return {
            innerValue,
            errorMessage,
        }
    }

}
</script>

<style scoped>

</style>
