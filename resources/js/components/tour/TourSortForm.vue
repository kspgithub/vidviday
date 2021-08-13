<template>


    <div class="filter-result-bar">
        <span class="title h3 only-desktop">Доступно {{ total }} турів</span>
        <label class="only-desktop">
            <span class="text">Показати тури</span>
            <form-select v-model="pagination" :options="options.pagination"/>
        </label>
        <label>
            <span class="text">Сортувати за</span>
            <form-select v-model="sorting" :options="options.sorting"/>
        </label>
    </div>

</template>

<script>
import {useStore} from "vuex";
import {computed} from "vue";
import FormSelect from "../form/FormSelect";

export default {
    name: "TourSortForm",
    components: {FormSelect},
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
