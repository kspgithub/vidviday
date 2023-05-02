import {useStore} from "vuex";
import { computed, nextTick, ref } from "vue";

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
        const currentPos = document.documentElement.scrollTop;
        const newPage = currentPage.value + 1;
        const newParams = new URLSearchParams(window.location.search);
        newParams.set("page", newPage);
        history.pushState({}, "", "?" + newParams.toString());
        await store.dispatch("tourFilter/fetchTours", Object.assign(params.value, { page: newPage }));
    };

    const prevPage = async () => {
        if (fetchRequest.value || currentPage.value == 1) return;
        const currentPos = document.documentElement.scrollTop;
        const newPage = currentPage.value - 1;
        const newParams = new URLSearchParams(window.location.search);
        newParams.set("page", newPage);
        history.pushState({}, "", "?" + newParams.toString());
        await store.dispatch("tourFilter/fetchTours", Object.assign(params.value, { page: newPage }));
    };

    return {
        fetchRequest,
        tours,
        currentPage,
        lastPage,
        perPage,
        nextPage,
        prevPage,
    }
}

export default useTourView;
