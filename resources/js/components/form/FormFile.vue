<template>
    <label class="add-file">
        <span>{{ title }} <span v-if="required && title === label">*</span></span>
        <input ref="inputRef" type="file" :name="name" :accept="accept" @change="onChange" />
    </label>
</template>

<script>
import { ref, watch } from 'vue'
import { useRequiredFormGroup } from './composables/useFormField'

export default {
    name: 'FormFile',
    props: {
        modelValue: Object,
        label: String,
        name: String,
        rules: {
            type: [String, Object],
            default: '',
        },
        accept: {
            type: String,
            default: '.png,.jpg,.jpeg,.pdf,.doc,.docx',
        },
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const inputRef = ref(null)
        const { required } = useRequiredFormGroup(props)
        const title = ref(props.label)

        watch(props, val => {
            if (!val.modelValue) {
                title.value = props.label
            }
        })

        const onChange = async () => {
            if (inputRef.value.files.length) {
                const file = inputRef.value.files[0]
                console.log(file)
                title.value = file.name
                emit('update:modelValue', file)
            } else {
                title.value = props.label
                emit('update:modelValue', null)
            }
        }

        return {
            inputRef,
            required,
            onChange,
            title,
        }
    },
}
</script>

<style scoped></style>
