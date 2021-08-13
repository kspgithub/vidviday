import toursService from "../../services/tour-service";

export default {
    namespaced: true,
    state() {
        return {
            fetchRequest: false,
            viewType: 'gallery',
            options: {
                date_from: "",
                date_to: "",
                duration_from: 0,
                duration_to: 10,
                price_from: 0,
                price_to: 10000,
                directions: [],
                subjects: [],
                types: [],
                pagination: [],
                sorting: [],
            },
            formData: {
                q: '',
                date_from: '',
                date_to: '',
                duration: [0, 14],
                price: [0, 10000],
                direction: 0,
                type: 0,
                subject: 0,

            },
            pagination: {
                current_page: 1,
                per_page: 12,
                last_page: 1,
                total: 0,

            },
            sorting: {
                sortBy: 'price',
                sortDirection: 'asc',
            },
            tours: []
        }
    },
    mutations: {
        SET_VIEW_TYPE(state, value) {
            state.viewType = value;
        },
        SET_FETCH_REQUEST(state, value) {
            state.fetchRequest = value;
        },
        SET_OPTIONS(state, value) {
            Object.assign(state.options, value);
        },
        UPDATE_FORM_DATA(state, value) {
            Object.assign(state.formData, value);
        },
        SET_PAGINATION(state, value) {
            Object.assign(state.pagination, value);
        },
        SET_PAGE(state, value) {
            Object.assign(state.pagination, {current_page: value || 1});
        },
        SET_PER_PAGE(state, value) {
            Object.assign(state.pagination, {per_page: value || 12});
        },
        SET_SORTING(state, value) {
            Object.assign(state.sorting, value);
        },
        SET_TOURS(state, value) {
            state.tours = value;
        },
        ADD_TOURS(state, value) {
            state.tours = [...state.tours, ...value];
        },
    },
    getters: {
        formData: (state) => {

            return {
                q: state.formData.q,
                date_from: state.formData.date_from,
                date_to: state.formData.date_to,
                duration_from: state.formData.duration[0],
                duration_to: state.formData.duration[1],
                price_from: state.formData.price[0],
                price_to: state.formData.price[1],
                direction: state.formData.direction,
                type: state.formData.type,
                subject: state.formData.subject,
                page: state.pagination.current_page,
                per_page: state.pagination.per_page,
                sort_by: state.sorting.sortBy,
                sort_dir: state.sorting.sortDirection,
                view: state.viewType,
            }
        },
        filterData: (state) => {
            return {
                q: state.formData.q,
                date_from: state.formData.date_from,
                date_to: state.formData.date_to,
                duration_from: state.formData.duration[0],
                duration_to: state.formData.duration[1],
                price_from: state.formData.price[0],
                price_to: state.formData.price[1],
                direction: state.formData.direction,
                type: state.formData.type,
                subject: state.formData.subject,
            }
        }
    },
    actions: {
        async clearFilter({commit, state}) {
            commit('UPDATE_FORM_DATA', {
                q: '',
                date_from: '',
                date_to: '',
                duration: [0, state.options.duration_to],
                price: [0, state.options.price_to],
                direction: 0,
                type: 0,
                subject: 0,

            });
            commit('SET_PAGE', 1);
        },
        async fetchTours({commit}, params = {}) {
            commit('SET_FETCH_REQUEST', true);
            const response = await toursService.fetchTours(params);

            if (response) {
                if (params && params.page > 1) {
                    commit('ADD_TOURS', response.data);
                } else {
                    commit('SET_TOURS', response.data);
                }

                commit('SET_PAGINATION', {
                    current_page: response.current_page,
                    per_page: response.per_page,
                    last_page: response.last_page,
                    total: response.total,
                });
                commit('SET_FETCH_REQUEST', false);
            } else {

            }

        }
    }
}
