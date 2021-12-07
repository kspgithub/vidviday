<template>
    <div class="number-input vue-number-input">
        <span class="text-sm text-medium title inline" v-if="title">{{ title }}</span>
        <div class="number-input-btns">
            <button type="button" class="decrement" :disabled="disabled" @click.prevent="decrement()"></button>
            <input type="number" :name="name" :value="disabled || !modelValue ? 0 : modelValue" readonly
                   :required="required">
            <button type="button" class="increment" :disabled="disabled" @click.prevent="increment()"></button>
        </div>
    </div>
</template>

<script>
import {computed} from "vue";
import useFormField from "./composables/useFormField";

export default {
    name: "FormNumberInput",
    props: {
        modelValue: Number,
        name: String,
        title: String,
        min: {
            type: Number,
            default: 0,
        },
        max: {
            type: Number,
            default: 999,
        },
        step: {
            type: Number,
            default: 1,
        },
        disabled: Boolean,
        rules: {
            type: [String, Object],
            default: ''
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const field = useFormField(props, emit);

        const decrement = () => {
            if (props.modelValue > props.min) {
                emit('update:modelValue', props.modelValue - props.step);
            }
        }

        const increment = () => {
            if (props.modelValue < props.max) {
                emit('update:modelValue', props.modelValue + props.step);
            }
        }

        return {
            decrement,
            increment,
            ...field
        }
    }
}
</script>

<style scoped>

</style>
