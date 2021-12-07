<template>
    <select class="custom-select" :name="name" :data-search="search"
            ref="inputRef"
            :data-search-text="searchText">
        <option value="" :selected="!modelValue" disabled>{{ placeholder }}</option>

        <slot/>

    </select>
</template>

<script>
import useFormField from "./composables/useFormField";
import {onMounted} from "vue";

export default {
    name: "FormCustomSelect",
    props: {
        modelValue: null,
        name: {
            type: String,
            default: '',
        },
        search: {
            type: Boolean,
            default: false
        },
        searchText: {
            type: String,
            default: ''
        },
        placeholder: {
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
        const {inputRef} = field;
        onMounted(() => {
            inputRef.value.addEventListener('sumo:change', (event) => {
                emit('update:modelValue', event.target.value);
            })
            inputRef.value.addEventListener('sumo:opened', (event) => {
                //console.log('sumo:opened');
            })
        })

        const update = () => {
            $(inputRef.value)[0].sumo.reload();
            //console.log($(inputRef.value)[0].sumo);
        }

        return {
            ...field,
            update,
        }
    }
}
</script>

<style scoped>

</style>
