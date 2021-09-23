<template>
    <div>
        <h2 class="h3">Чи Вам буде потрібен Акт виконаних робіт після завершення туру?</h2>
        <div class="spacer-xs"></div>
        <form-checkbox class="small" label="Так, потрібен" name="act_is_needed" v-model="act_is_needed"/>
        <div class="spacer-xs"></div>
    </div>
</template>

<script>
import FormCheckbox from "../form/FormCheckbox";
import {useFormDataProperty} from "../../store/composables/useFormData";

export default {
    name: "OrderAct",
    components: {FormCheckbox},
    setup() {
        return {
            act_is_needed: useFormDataProperty('orderTour', 'act_is_needed'),
        }
    }
}
</script>

<style scoped>

</style>
