<template>
    <div :class="'label-' + idx" :style="{ 'background-color': badge.color }" class="label">{{ title }}</div>
</template>

<script>
import { useLocalizedProperty } from '../../composables/useLocalizedProperty'

export default {
    name: 'TourBadge',
    props: {
        badge: Object,
        idx: Number,
    },
    setup({ badge }) {
        const title = useLocalizedProperty(badge, 'title')
        return {
            title,
        }
    },
}
</script>

<style scoped></style>
