<template>
    <div>
        <span class="text text-sm">
            <b>{{ __('order-section.tour') }}*</b>
        </span>

        <form-autocomplete
            name="tour_id"
            :placeholder="__('order-section.tour-placeholder')"
            search
            ref="tourSelectRef"
            v-model="tourId"
            @search="searchTours"
            rules="required"
            :paginate="paginate"
        >
            <option :value="0" :selected="tourId === 0" disabled>{{ __('order-section.tour-placeholder') }}</option>
            <option v-for="option in tours" :data-img="option.main_image" :value="option.id"><img :src="option.main_image"  /> {{ option.title }} </option>
        </form-autocomplete>

    </div>
</template>

<script>

import { computed, ref, toRaw } from 'vue'
import FormAutocomplete from "../form/FormAutocomplete";
import {autocompleteTours} from "../../services/tour-service";
import FormCustomSelect from "../form/FormCustomSelect";
import {useStore} from "vuex";


export default {
    name: "OrderTourSelector",
    components: {FormCustomSelect, FormAutocomplete},
    setup() {
        const store = useStore();
        const tours = ref([]);
        const tourSelectRef = ref(null);
        const currentPage = ref(1);
        const paginate = ref(true);

        const tourId = computed({
            get: () => store.state.orderTour.formData.tour_id,
            set: async (val) => {
                const tour = tours.value.find(t => t.id === parseInt(val));
                const discounts = [...new Map([...tour.discounts, ...tour.tourDiscounts].map((item) => [item.id, item])).values()].map(d => toRaw(d));
                store.commit('orderTour/SET_TOUR', tour);
                store.commit('orderTour/SET_DISCOUNTS', discounts);
                await store.dispatch('orderTour/fetchSchedules', val || 0);
            }
        });

        const searchTours = async (q = '') => {
            const items = await autocompleteTours(q, 50, currentPage.value++);

            if(!items || !items.length) {
                paginate.value = false
            }

            tours.value = [...new Map([...tours.value, ...(items || [])].map((item) => [item.id, {...item, img: item.main_image}])).values()];

            if(tourSelectRef.value) {
                tourSelectRef.value.update(tours.value);
            }
        }

        searchTours();

        return {
            tours,
            tourSelectRef,
            searchTours,
            tourId,
            currentPage,
            paginate,
        }
    }
}
</script>

<style scoped>

</style>
