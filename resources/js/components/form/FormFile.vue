<template>
    <div class="img-input-wrap text-center-xs">
        <div class="img-input doc tooltip-wrap">
            <div class="tooltip"><span class="text-medium">{{ fileTooltip }}:</span>
                <div class="text text-sm">
                    <ul>
                        <li>макс. розмір зображення {{ fileSize }}</li>
                    </ul>
                </div>
            </div>
            <input type="file" ref="inputRef" class="vue-action" :name="name" :accept="mapAccept" @change="onChange">
        </div>
        <span class="mx-15">{{ title }} <span v-if="required && title === label">*</span></span>
    </div>
</template>

<script>
import {computed, ref, watch} from "vue";
import {useRequiredFormGroup} from "./composables/useFormField";

export default {
    name: "FormFile",
    props: {
        modelValue: Object,
        label: String,
        name: String,
        fileTooltip: String,
        fileSize: String,
        rules: {
            type: [String, Object],
            default: ''
        },
        accept: {
            type: String,
            default: '.png,.jpg,.jpeg,.pdf,.doc,.docx'
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const inputRef = ref(null);
        const {required} = useRequiredFormGroup(props);
        const title = ref(props.label);

        watch(props, (val) => {
            if(!val.modelValue) {
                title.value = props.label;
            }
        })

        const onChange = async () => {
            if (inputRef.value.files.length) {
                const file = inputRef.value.files[0];
                // console.log(file);
                title.value = file.name;
                emit('update:modelValue', file);
            } else {
                title.value = props.label;
                emit('update:modelValue', null);
            }

        }

        const mapAccept = computed(() => {
            return props.accept.split(',').map(a => '.'+a)
        })

        return {
            inputRef,
            required,
            onChange,
            title,
            mapAccept,
        }
    }
}
</script>

<style scoped>

</style>
