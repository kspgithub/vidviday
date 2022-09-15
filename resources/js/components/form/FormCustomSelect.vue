<template>
    <select :id="$attrs.id" class="custom-select" :class="{'vue-select': vueSelect}" :name="name" :data-search="search"
            ref="inputRef"
            :data-search-text="searchText">
        <option value="" :selected="!modelValue" disabled>{{ placeholder }}</option>

        <slot/>

    </select>
</template>

<script>
import useFormField from "./composables/useFormField";
import { onMounted, onUnmounted, ref } from "vue";

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
        vueSelect: {
            type: Boolean,
            default: false,
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const field = useFormField(props, emit);
        const {inputRef} = field;

        onMounted(() => {
            inputRef.value.addEventListener('sumo:change', (event) => {
                emit('update:modelValue', event.target.value);

                let option = $(inputRef.value).closest('.SumoSelect').find('.opt.selected');
                let label = $(inputRef.value).next('.CaptionCont')

                if(option.length && label.length) {
                    $(label).find('span').html($(option).html())
                }
            })
            inputRef.value.addEventListener('sumo:opened', (event) => {
                //console.log('sumo:opened');
            })
        })

        onUnmounted(() => {
            if (inputRef.value && $(inputRef.value)[0].sumo) {
                $(inputRef.value)[0].sumo.unload();
            }
        })

        const update = (items) => {

            if($(inputRef.value)[0].sumo) {

                $(inputRef.value)[0].sumo.reload();

                $(inputRef.value).each(function () {
                    let option = $(this).closest('.SumoSelect').find('.opt');

                    $(option).each(function () {
                        let img = $(this).closest('.SumoSelect').find('option').eq($(this).index()).data('img');

                        if (img && !$(this).find('img').length) {
                            $(this).prepend('<img src="' + img + '">');
                        }
                    });
                });
            }
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
