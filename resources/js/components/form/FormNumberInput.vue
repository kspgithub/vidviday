<template>
    <div class="number-input">
        <div class="number-input-btns">
            <button type="button" class="decrement" :disabled="disabled" @click.prevent="decrement()"></button>
            <input type="number" :value="disabled ? 0 : modelValue" readonly required>
            <button type="button" class="increment" :disabled="disabled" @click.prevent="increment()"></button>
        </div>
    </div>
</template>

<script>
import {computed} from "vue";

export default {
    name: "FormNumberInput",
    props: {
        modelValue: Number,
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
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {


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
        }
    }
}
</script>

<style scoped>

</style>
