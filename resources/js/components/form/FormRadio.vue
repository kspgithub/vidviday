<template>
    <label class="radio" :class="{active: modelValue === value}">
        <input type="radio"
               :value="value"
               :checked="modelValue === value"
               :name="name"
               @change="change"
        >
        <span v-html="label"></span>
    </label>
</template>

<script>

export default {
    name: "FormRadio",
    props: {
        modelValue: null,
        value: null,
        name: String,
        label: String,
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const change = (event) => {
            if (event.target.checked) {
                emit('update:modelValue', props.value);
            }
        }
        return {
            change,
        }
    }
}
</script>

<style scoped>

</style>
