<template>
    <input type="hidden" :name="name" :value="token">
</template>

<script>
import { onMounted, ref } from "vue";

export default {
    name: "FormCsrf",
    props: {
        name: {
            type: String,
            default: '_token'
        }
    },
    setup() {
        const token = ref('')

        onMounted(() => {
            token.value = typeof document !== 'undefined' ? document.head.querySelector('meta[name="csrf-token"]')?.content : ''
        })
        return {
            token
        }
    }

}
</script>

<style scoped>

</style>
