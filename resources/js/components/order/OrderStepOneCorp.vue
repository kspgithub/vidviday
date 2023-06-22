<template>
    <div class="tab" :class="{active: active}">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="form row">

                    <div class="col-12 mb-25">
                        <h2 class="h3">{{ __('order-section.tour-details') }}</h2>
                    </div>

                    <input type="hidden" name="group_type" value="1">

                    <order-program-type сlass="col-12" v-if="!tourSelected"/>

                    <order-tour-selector class="col-12 mt-5 mb-10"
                                         v-if="!tourSelected && (program_type === 0)"/>

                    <order-tour-plan class="col-12 mb-10"
                                     v-if="!tourSelected && program_type === 1 "/>

                    

                   <!--  <order-departure class="col-md-6 col-12" v-if="!tourSelected && (program_type === 0)"/> -->

                    <order-tour-dates class="col-12 mb-10" />

                    <order-places class="col-12 mb-10"/>

                    <order-contact class="col-12 mt-30"/>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

import OrderContact from "./OrderContact";
import OrderTourSelector from "./OrderTourSelector";
import OrderTourDates from "./OrderTourDates";
import OrderPlaces from "./OrderPlaces";
import OrderDeparture from "./OrderDeparture";
import OrderProgramType from './OrderProgramType.vue'
import { computed } from 'vue'
import { useStore } from 'vuex'
import OrderTourPlan from './OrderTourPlan.vue'


export default {
    name: "OrderStepOneCorp",
    components: {
        OrderTourPlan,
        OrderProgramType,
        OrderDeparture,
        OrderTourDates,
        OrderPlaces,
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
        orderCorporate: {
            type: Boolean,
            default() {
                return false;
            }
        },
    },
    setup() {

        const store = useStore();

        const program_type = computed(() => store.state.orderTour.formData.program_type);

        return {
            program_type,
        }
    }
}
</script>

<style scoped>

</style>
