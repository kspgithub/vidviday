<template>
    <label class="form-label" :data-tooltip="errorMessage" :class="{invalid: errorMessage, 'mb-0':inline}">
        <select :class="{'mb-0':inline}" ref="selectRef" :name="name" :multiple="multiple" v-model="value">
            <option v-for="option in options" :value="option.value || option.id">{{ option.text || option.title }}</option>
            <slot/>
        </select>
    </label>

</template>

<script>
import {useRequiredFormGroup} from "./composables/useFormField";
import {onMounted, ref} from "vue";
import {useField} from "vee-validate";

export default {
    name: "FormSumoSelect",
    props: {
        modelValue: null,
        name: String,
        label: String,
        options: Array,
        multiple: Boolean,
        search: Boolean,
        inline: Boolean,
        searchText: {
            type: String,
            default: 'Пошук...'
        },
        rules: {
            type: [String, Object],
            default: ''
        },

    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const selectRef = ref(null);
        let sumoSelect = null;
        const {required} = useRequiredFormGroup(props);

        const {value, errorMessage} = useField(props.name, props.rules, {
            initialValue: props.modelValue ? props.modelValue : (props.multiple ? [] : '')
        });


        onMounted(() => {
            $(selectRef.value).SumoSelect({
                search: props.search || false,
                searchText: props.searchText,
                placeholder: required ? props.label + ' *' : props.label,
            });

            sumoSelect = selectRef.value.sumo;

            $(selectRef.value).on('change', function () {
                const val = $(selectRef.value).val();
                value.value = val;
                emit('update:modelValue', val);
            });
        })
        return {
            selectRef,
            required,
            errorMessage,
            value,
        }
    }
}
</script>

<style scoped>

</style>
