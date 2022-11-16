<template>
    <div class="tab" :class="{active: active}">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="form row">

                    <div class="col-12 mb-25">
                        <h2 class="h3">{{ __('order-section.tour-details') }}</h2>
                    </div>

                    <input type="hidden" name="group_type" value="1">

                    <order-tour-selector class="col-12  mt-5 mb-10" v-if="!tourSelected"/>

                    <order-departure class="col-md-6 col-12"/>

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
import OrderPlaces from "./OrderPlaces";
import OrderDeparture from "./OrderDeparture";


export default {
    name: "OrderStepOneCorp",
    components: {
        OrderDeparture,
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
        return {}
    }
}
</script>

<style scoped>

</style>
