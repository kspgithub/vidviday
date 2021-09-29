<template>
    <div>
        <span class="text-sm">
            Програма
        </span>
        <div>
            <label class="radio">
                <input type="radio" name="program_type" :value="0" v-model="program_type">
                <span>Обрати готовий тур</span>
            </label>

            <label class="radio">
                <input type="radio" name="program_type" :value="1" v-model="program_type">
                <span>Скласти тур</span>
            </label>
        </div>

    </div>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: "OrderProgramType",
    setup() {
        const store = useStore();
        const program_type = computed({
            get: () => store.state.orderTour.formData.program_type,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {program_type: val})
        })

        return {
            program_type
        }
    }
}
</script>

<style scoped>

</style>
