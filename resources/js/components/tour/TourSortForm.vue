<template>


    <div class="filter-result-bar">
        <span class="title h3 only-desktop">Доступно {{ total }} турів</span>
        <label class="only-desktop">
            <span class="text">Показати тури</span>
            <form-sumo-select v-model.number="pagination" :options="options.pagination" inline/>
        </label>
        <label>
            <span class="text">Сортувати за</span>
            <form-sumo-select v-model="sorting" :options="options.sorting" inline/>
        </label>
    </div>

</template>

<script>
import {useStore} from "vuex";
import {computed, nextTick} from "vue";
import FormSelect from "../form/FormSelect";
import * as urlUtils from "../../utils/url";
import FormSumoSelect from "../form/FormSumoSelect";

export default {
    name: "TourSortForm",
    components: {FormSumoSelect, FormSelect},
    setup() {
        const store = useStore();
        const options = computed(() => store.state.tourFilter.options);
        const total = computed(() => store.state.tourFilter.pagination.total);

        const pagination = computed({
            get() {
                return store.state.tourFilter.pagination.per_page
            },
            set(value) {
                store.commit('tourFilter/SET_PER_PAGE', value);
                nextTick(() => {
                    store.dispatch('tourFilter/submit');
                })
            }
        });
        const sorting = computed({
            get() {
                return store.state.tourFilter.sorting.sortBy + '-' + store.state.tourFilter.sorting.sortDirection;
            },
            set(value) {
                const values = value.split('-');
                store.commit('tourFilter/SET_SORTING', {
                    sortBy: values[0] || 'price',
                    sortDirection: values[1] || 'desc'
                });

                nextTick(() => {
                    store.dispatch('tourFilter/submit');
                })
            }
        });

        return {
            options,
            pagination,
            sorting,
            total,
        }
    }
}
</script>

<style scoped>

</style>
