<template>
    <div>
        TestComponent {{ name }}
    </div>
</template>

<script setup>
const props = defineProps({
    name: {
        type: String,
        default: 'Default',
    },
})
</script>
