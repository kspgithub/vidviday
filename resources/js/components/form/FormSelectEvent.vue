<template>
    <div class="datepicker-input" v-click-outside="close" :class="{open: open}">
        <input :name="name" :value="modelValue" type="hidden">
        <span :title="current.text" class="datepicker-placeholder" @click="open = !open">
                {{ current.text }}
            </span>
        <ul class="datepicker-options">
            <li v-for="option in options"
                :class="{selected: option.value === modelValue}"
                class="opt"
                @click="change(option)"><label>{{ option.value === 0 ? 'Не вибрано' : option.text }}</label>
            </li>
        </ul>
    </div>
</template>

<script>
import {computed, ref} from "vue";

export default {
    name: "FormSelectEvent",
    props: {
        name: String,
        modelValue: {
            type: [String, Number, Array, null]
        },
        options: Array,
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {

        const open = ref(false);

        const current = computed(() => {
            const option = props.options.find(o => o.value === props.modelValue);
            return option || props.options[0];
        })

        const change = (option) => {
            open.value = false;
            emit('update:modelValue', option.value)
        }

        const close = () => {
            open.value = false;
        }


        return {
            current,
            change,
            close,
            open,
        }
    }
}
</script>

<style scoped>

</style>
