<template>
    <div class="datepicker-input datepicker-dropdown" :class="{open: open, invalid: errorMessage}">
        <input :name="name" :value="modelValue" type="hidden">
        <span :title="current ? current.text : ''" class="datepicker-placeholder" @click="open = !open"
              :data-tooltip="errorMessage">
            {{ current ? current.text : label }}
        </span>
        <ul class="datepicker-options">
            <li v-for="option in options"
                :class="{selected: option.value === modelValue}"
                class="opt"
                @click="change(option)"><label v-html="option.value === 0 ? 'Не вибрано' : option.text"></label>
            </li>
        </ul>
    </div>
</template>

<script>
import {computed, ref} from "vue";
import useFormField from "./composables/useFormField";

export default {
    name: "FormSelectEvent",
    props: {
        name: String,
        label: {
            type: String,
            default: ''
        },
        modelValue: null,
        options: Array,
        rules: {
            type: [String, Object],
            default: ''
        },
        preselect: {
            type: Boolean,
            default: true
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const field = useFormField(props, emit);

        const open = ref(false);

        const current = computed(() => {
            const option = props.options.find(o => o.value === props.modelValue);
            return option ? option : (props.preselect ? props.options[0] : null);
        })

        const change = (option) => {
            open.value = false;
            emit('update:modelValue', option.value)
        }

        const close = () => {
            if (open.value) {
                open.value = false;
            }

        }


        return {
            current,
            change,
            close,
            open,
            ...field,
        }
    }
}
</script>

<style scoped>

</style>
