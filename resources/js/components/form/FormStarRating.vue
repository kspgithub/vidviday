<template>
    <div class="stars select-stars rating-picker" :class="{active: innerValue >= 1, invalid: errorMessage}">
        <i class="select-icon icon-star-empty" @click.prevent="innerValue = 1" :class="{active: innerValue === 1}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="innerValue = 2" :class="{active: innerValue === 2}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="innerValue = 3" :class="{active: innerValue === 3}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="innerValue = 4" :class="{active: innerValue === 4}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="innerValue = 5" :class="{active: innerValue === 5}"></i>
        <input type="hidden" v-model="innerValue" :name="name">
    </div>
</template>

<script>
import useFormField from "./composables/useFormField";

export default {
    name: "FormStarRating",
    props: {
        modelValue: {
            type: Number,
            default: 0
        },
        name: {
            type: String,
            default: 'rating'
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
