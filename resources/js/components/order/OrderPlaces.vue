<template>
    <div class="col-md-6 col-12 mb-10">
        <span class="text-sm text-medium title">Кількість осіб*</span>
        <form-number-input v-model="places" :min="1" :max="maxPlaces" name="places"/>
    </div>
</template>

<script>
import FormNumberInput from "../form/FormNumberInput";
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    name: "OrderPlaces",
    components: {FormNumberInput},
    setup() {
        const store = useStore();
        const maxPlaces = computed(() => store.getters['orderTour/maxPlaces']);
        const places = computed({
            get: () => store.state.orderTour.formData.places,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {places: val})
        });
        return {
            places,
            maxPlaces,
        }
    }
}
</script>

<style scoped>

</style>
