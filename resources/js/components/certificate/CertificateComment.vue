<template>
    <div v-observe-visibility="visibilityChanged">
        <div class="spacer-xs"></div>
        <slide-more v-if="isVisible" :title="__('certificate-section.notes')"
                    :sub-title="__('certificate-section.notes-sub-title')"
                    :open="true">
            <form-textarea v-model="comment" name="comment" id="certificate-comment"
                           :label="__('certificate-section.label')"/>
        </slide-more>
    </div>

</template>

<script>
import SlideMore from "../common/SlideMore";
import {useDebounceFormDataProperty} from "../../store/composables/useFormData";
import FormTextarea from "../form/FormTextarea";
import {ref} from "vue";

export default {
    name: "CertificateComment",
    components: {FormTextarea, SlideMore},
    setup() {
        const isVisible = ref(false);

        const visibilityChanged = (visible) => {
            isVisible.value = visible;
        }


        return {
            isVisible,
            visibilityChanged,
            comment: useDebounceFormDataProperty('orderCertificate', 'comment'),
        }
    }
}
</script>

<style scoped>

</style>
