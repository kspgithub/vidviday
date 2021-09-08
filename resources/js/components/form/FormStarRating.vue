<template>
    <div class="stars select-stars rating-picker">
        <i class="select-icon icon-star-empty" @click.prevent="setValue(1)" :class="{active: modelValue >= 1}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="setValue(2)" :class="{active: modelValue >= 2}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="setValue(3)" :class="{active: modelValue >= 3}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="setValue(4)" :class="{active: modelValue >= 4}"></i>
        <i class="select-icon icon-star-empty" @click.prevent="setValue(5)" :class="{active: modelValue >= 5}"></i>
        <input type="hidden" :value="modelValue" :name="name">
    </div>
</template>

<script>
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
        }
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const setValue = (val) => {
            emit('update:modelValue', val);
        }

        return {
            setValue,
        }
    }
}
</script>

<style scoped>

</style>
