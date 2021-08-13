import {useStore} from "vuex";
import {computed} from "vue";


export const useTourView = () => {
    const store = useStore();
    const fetchRequest = computed(() => store.state.tourFilter.fetchRequest);

    const currentPage = computed(() => store.state.tourFilter.pagination.current_page);
    const lastPage = computed(() => store.state.tourFilter.pagination.last_page);
    const perPage = computed(() => store.state.tourFilter.pagination.per_page);

    const tours = computed(() => store.state.tourFilter.tours);

    const params = computed(() => store.getters['tourFilter/formData']);

    const nextPage = async () => {
        if (fetchRequest.value || currentPage.value >= lastPage.value) return;
        await store.dispatch('tourFilter/fetchTours', Object.assign(params, {page: currentPage.value + 1}));
    }

    return {
        fetchRequest,
        tours,
        currentPage,
        lastPage,
        perPage,
        nextPage,
    }
}

export default useTourView;
