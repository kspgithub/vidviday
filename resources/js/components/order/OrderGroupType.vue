<template>
    <div class="col-12">
        <span class="text-sm">
            {{ __('order-section.group.title') }}:
            <span class="tooltip-auto">
            <tooltip><span v-html="__('order-section.group.tooltip')"></span></tooltip>
            </span>
        </span>

        <div>
            <label class="radio">
                <input type="radio" name="group_type" :value="0" v-model="group_type">
                <span>{{ __('order-section.group.type-team') }}</span>
            </label>

            <label class="radio">
                <input type="radio" name="group_type" :value="1" v-model="group_type">
                <span>{{ __('order-section.group.type-corporate') }}</span>
            </label>
        </div>
    </div>
</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import Tooltip from "../common/Tooltip";

export default {
    name: "OrderGroupType",
    components: {Tooltip},
    setup() {
        const store = useStore();
        const group_type = computed({
            get: () => store.state.orderTour.formData.group_type,
            set: (val) => store.commit('orderTour/UPDATE_FORM_DATA', {group_type: val})
        })

        return {
            group_type
        }
    }
}
</script>

<style scoped>

</style>
