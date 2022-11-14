<template>
    <div>TestComponent {{ name }}</div>
</template>

<script setup>
const props = defineProps({
    name: {
        type: String,
        default: 'Default',
    },
})

console.log(process.env)
console.log(process.env.__DATA__)
</script>
