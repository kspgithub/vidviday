<template>
    <div>
        <div class="text text-sm title">
            <b>{{ __('order-section.details.plan') }}*</b>
        </div>
        <form-textarea v-model="tour_plan" name="tour_plan"
                       :placeholder="__('order-section.details.plan-placeholder')"/>
    </div>
</template>

<script>
import FormTextarea from "../form/FormTextarea";
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: "OrderTourPlan",
    components: {FormTextarea},
    setup() {
        const store = useStore();
        const tour_plan = computed({
            get: () => store.state.orderTour.formData.tour_plan,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {tour_plan: val})
        })

        return {
            tour_plan
        }
    }
}
</script>

<style scoped>

</style>
