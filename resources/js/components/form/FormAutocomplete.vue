<template>
    <label :data-tooltip="errorMessage" :class="{invalid: errorMessage}">
        <select :id="$attrs.id" class="custom-select" :class="{'vue-select': vueSelect}" :name="name" ref="inputRef">
            <slot/>
        </select>
    </label>
</template>

<script>
import {onBeforeUnmount, onMounted, onUnmounted, ref, watch} from "vue";
import useFormField from "./composables/useFormField";


export default {
    name: "FormAutocomplete",
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
            default: ''
        },
        placeholder: {
            default: '',
        },
        idField: {
            type: String,
            default: 'id',
        },
        titleField: {
            type: String,
            default: 'title',
        },
        rules: {
            type: [String, Object],
            default: ''
        },
        vueSelect: {
            type: Boolean,
            default: true,
        },
    },
    emits: ['update:modelValue', 'search'],
    setup(props, {emit}) {
        const field = useFormField(props, emit);
        const {inputRef} = field;
        const sumo = ref(null);

        onMounted(() => {
            sumo.value = $(inputRef.value).SumoSelect({
                placeholder: props.placeholder,
                search: props.search,
                searchText: props.searchText,
                noMatch: 'Нічого не знайдено для "{0}"',

            }).sumo;

            if (sumo.value.ftxt) {
                sumo.value.ftxt.on('keyup', _.debounce((evt) => {
                    emit('search', evt.target.value);
                }, 300));
            }


            $(inputRef.value).on('change', (evt) => {
                emit('update:modelValue', parseInt(evt.target.value));
            });
        })

        onUnmounted(() => {
            if (sumo.value) {
                sumo.value.unload();
            }
        })

        const update = (items) => {

            if (sumo.value) {
                sumo.value.removeAll();
                items.forEach(it => {
                    if(it.img) {
                        sumo.value.add(it[props.idField], '<img src="' + it.img + '">' + it[props.titleField]);
                    } else {
                        sumo.value.add(it[props.idField], it[props.titleField]);
                    }
                })
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
