<template>
    <div class="tab" :class="{active: active}">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="form row">
                    <div class="col-12 mb-25">
                        <h2 class="h3">{{ __('order-section.tour-details') }}</h2>
                    </div>

                    <order-group-type class="col-12" v-if="!tourSelected || schedules.length > 0"/>

                    <order-program-type сlass="col-12" v-if="!tourSelected && group_type === 1"/>

                    <order-tour-selector class="col-12 mt-5 mb-10"
                                         v-if="!tourSelected && (group_type === 0 || program_type === 0)"/>

                    <order-tour-plan class="col-12 mb-10"
                                     v-if="!tourSelected && group_type === 1 && program_type === 1 "/>

                    <order-tour-departure class="col-md-6 col-12 mb-10" v-if="tourSelected || group_type === 0"/>

                    <order-tour-dates class="col-12 mb-10" v-if="/*!tourSelected && */group_type === 1"/>

                    <order-places class="col-md-6 col-12 mb-10"/>

                    <order-kids class="col-12" :show="showChildren"/>

                    <transition name="fade">
                        <order-total class="col-12" v-if="group_type === 0"/>
                    </transition>


                    <order-contact class="col-12 mt-15 mt-xl-40"/>

                    <order-additional class="col-12" :show="group_type === 0"/>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useStore} from "vuex";

import {computed} from "vue";


import OrderContact from "./OrderContact";
import OrderTourSelector from "./OrderTourSelector";
import OrderTourDeparture from "./OrderTourDeparture";
import OrderTourDates from "./OrderTourDates";
import OrderProgramType from "./OrderProgramType";
import OrderGroupType from "./OrderGroupType";
import OrderProgramPlan from "./OrderTourPlan";
import OrderTourPlan from "./OrderTourPlan";
import OrderPlaces from "./OrderPlaces";
import OrderKids from "./OrderKids";
import OrderTotal from "./OrderTotal";
import OrderAdditional from "./OrderAdditional";

export default {
    name: "OrderStepOne",
    components: {
        OrderAdditional,
        OrderTotal,
        OrderKids,
        OrderPlaces,
        OrderTourPlan,
        OrderProgramPlan,
        OrderGroupType,
        OrderProgramType,
        OrderTourDates,
        OrderTourDeparture,
        OrderTourSelector,
        OrderContact,
    },
    props: {
        active: Boolean,
        tourSelected: {
            type: Boolean,
            default() {
                return false;
            }
        },
    },
    setup(props) {
        const store = useStore();


        const schedules = computed(() => store.state.orderTour.schedules);
        const program_type = computed(() => store.state.orderTour.formData.program_type);
        const group_type = computed(() => store.state.orderTour.formData.group_type);
        const showChildren = computed(() => group_type.value === 0)
        const isTourAgent = computed(() => store.getters['orderTour/isTourAgent'])


        return {
            schedules,
            group_type,
            program_type,
            showChildren,
            isTourAgent,
        }
    }
}
</script>

<style scoped>

</style>
