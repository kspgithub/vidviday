<template>
    <div class="img-input-wrap">
        <div class="img">
            <img :src="preview" class="profile-avatar" alt="Avatar">
        </div>
        <label class="img-input avatar btn type-2">
            Змінити фото
            <input type="file" class="full-size" accept=".png,.jpg,.jpeg" :name="name" ref="inputRef"
                   @change="onChange">
        </label>
    </div>
</template>

<script>
import {ref} from "vue";

export default {
    name: "FormAvatar",
    props: {
        modelValue: null,
        avatarUrl: {
            type: String,
            default: '/icon/login.svg'
        },
        name: {
            type: String,
            default: 'avatar_upload',
        },
        rules: {
            type: [String, Object],
            default: ''
        },
    },
    emits: ['update:modelValue'],
    setup(props, {emit}) {
        const inputRef = ref(null);

        const preview = ref(props.avatarUrl);

        const clear = () => {
            inputRef.value.value = null;
            preview.value = props.avatarUrl;
        }

        const onChange = (evt) => {
            if (inputRef.value.files && inputRef.value.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.value = e.target.result;
                };
                reader.readAsDataURL(inputRef.value.files[0]);
            } else {
                preview.value = props.avatarUrl;
            }
        }

        return {
            preview,
            inputRef,
            clear,
            onChange,
        }
    }
}
</script>

<style scoped>

</style>
