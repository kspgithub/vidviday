<template>
    <div class="filter-result-bar">
        <span class="title h3 only-desktop">{{ searchTitle }} </span>
        <label class="only-desktop">
            <span class="text">{{ __('tours-section.show-tours') }}</span>
            <form-sumo-select v-model.number="pagination" :options="options.pagination" inline/>
        </label>
        <label>
            <span class="text">{{ __('tours-section.sort-by') }}</span>
            <form-sumo-select ref="sortSelectRef" v-model="sorting" :options="options.sorting" inline/>
        </label>
    </div>

</template>

<script>
import {useStore} from "vuex";
import { computed, nextTick, onMounted, ref } from "vue";
import FormSelect from "../form/FormSelect";
import FormSumoSelect from "../form/FormSumoSelect";
import {pluralizeValue} from "../../utils/string";
import {trans} from '../../i18n/lang';

export default {
    name: "TourSortForm",
    components: {FormSumoSelect, FormSelect},
    setup(props) {
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
                    sortBy: values[0] || 'date',
                    sortDirection: values[1] || 'asc'
                });

                nextTick(() => {
                    store.dispatch('tourFilter/submit');
                })
            }
        });

        const searchTitle = computed(() => {
            return trans('tours-section.available') + ' ' + pluralizeValue(total.value, trans('tours-section.one_tour'), trans('tours-section.two_tours'), trans('tours-section.many_tours'))
        });

        const sortSelectRef = ref(null)

        onMounted(() => {
            const SelectBox = $(sortSelectRef.value.$el).find('p.SelectBox')
            const options = SelectBox.next('.optWrapper').find('ul.options')
            SelectBox.css({width: options.width()})
        })

        return {
            searchTitle,
            options,
            pagination,
            sorting,
            total,
            sortSelectRef,
        }
    }
}
</script>

<style scoped>

</style>
