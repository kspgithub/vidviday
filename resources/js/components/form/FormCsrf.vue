<template>
    <input type="hidden" :name="name" :value="token">
</template>

<script>
export default {
    name: "FormCsrf",
    props: {
        name: {
            type: String,
            default: '_token'
        }
    },
    setup() {
        const token = document.head.querySelector('meta[name="csrf-token"]').content || '';
        return {
            token
        }
    }

}
</script>

<style scoped>

</style>
