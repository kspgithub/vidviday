<template>
    <div v-observe-visibility="visibilityChanged">
        <div class="spacer-xs"></div>
        <slide-more
            v-if="isVisible"
            :title="__('order-section.comment.title')"
            :sub-title="__('order-section.comment.sub-title')"
            :open="true"
        >
            <form-textarea v-model="comment" name="comment" :label="__('order-section.comment.label')" />
        </slide-more>
    </div>
</template>

<script>
import SlideMore from '../common/SlideMore'
import { useDebounceFormDataProperty } from '../../store/composables/useFormData'
import FormTextarea from '../form/FormTextarea'
import { ref } from 'vue'

export default {
    name: 'OrderComment',
    components: { FormTextarea, SlideMore },
    setup() {
        const isVisible = ref(false)

        const visibilityChanged = visible => {
            isVisible.value = visible
        }

        return {
            isVisible,
            visibilityChanged,
            comment: useDebounceFormDataProperty('orderTour', 'comment'),
        }
    },
}
</script>

<style scoped></style>
