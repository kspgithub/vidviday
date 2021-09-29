<template>
    <div class="col-12">
        <span class="text-sm">
            Тип групи: <tooltip>Тип групи</tooltip>
        </span>

        <div>
            <label class="radio">
                <input type="radio" name="group_type" :value="0" v-model="group_type">
                <span>Збірна група</span>
            </label>

            <label class="radio">
                <input type="radio" name="group_type" :value="1" v-model="group_type">
                <span>Корпоративна група</span>
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
