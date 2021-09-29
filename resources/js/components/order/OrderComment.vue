<template>
    <div>
        <div class="spacer-xs"></div>
        <slide-more title="Примітки" sub-title="Додаткові побажання або запитання щодо туру" :open="true">
            <form-textarea v-model="comment" name="comment" label="Текст примітки"/>
        </slide-more>
    </div>

</template>

<script>
import SlideMore from "../common/SlideMore";
import {useDebounceFormDataProperty} from "../../store/composables/useFormData";
import FormTextarea from "../form/FormTextarea";

export default {
    name: "OrderComment",
    components: {FormTextarea, SlideMore},
    setup() {
        return {
            comment: useDebounceFormDataProperty('orderTour', 'comment'),
        }
    }
}
</script>

<style scoped>

</style>
