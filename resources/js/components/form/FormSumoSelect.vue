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
import {onMounted, ref, watch} from "vue";
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

        watch(() => props.options, () => {
            $(selectRef.value)[0].sumo.removeAll()
            let previousVal = $(selectRef.value).val()
            props.options.forEach(function(element, key) {
                $(selectRef.value)[0].sumo.add(element.value)
                if(element.value == value.value) {
                    $(selectRef.value)[0].sumo.selectItem(key + 1);
                }
            })
            if(previousVal) {
                $(selectRef.value)[0].sumo.remove(0);
            }
            if(!value.value) {
                $(selectRef.value)[0].sumo.caption.html(required ? props.label + ' *' : props.label)
            }
        });

        onMounted(() => {
            $(selectRef.value).SumoSelect({
                search: props.search || false,
                searchText: props.searchText,
                placeholder: required ? props.label + ' *' : props.label,
                floatWidth: 0,
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
