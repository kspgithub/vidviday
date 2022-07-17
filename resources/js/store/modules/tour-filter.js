import toursService from "../../services/tour-service";
import * as urlUtils from "../../utils/url";

export default {
    namespaced: true,
    state() {
        return {
            inFuture: true,
            bannerVisible: false,
            fetchRequest: false,
            viewType: 'gallery',
            requestTitle: '',
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
                places: [],
                landings: [],
                pagination: [],
                sorting: [],
            },
            formData: {
                q: '',
                date_from: '',
                date_to: '',
                duration: [0, 14],
                price: [0, 10000],
                direction: '',
                type: '',
                subject: '',
                place: '',
                landing: '',
                future: 1,
                lang: 'uk',
            },
            pagination: {
                current_page: 1,
                per_page: 12,
                last_page: 1,
                total: 0,

            },
            sorting: {
                sortBy: 'date',
                sortDirection: 'asc',
            },
            tours: [],
            popularTours: []
        }
    },
    mutations: {
        SET_BANNER_VISIBLE(state, value) {
            state.bannerVisible = value;
        },
        SET_VIEW_TYPE(state, value) {
            state.viewType = value;
        },
        SET_REQUEST_TITLE(state, value) {
            state.requestTitle = value;
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
            Object.assign(state.pagination, {current_page: 1});
        },
        SET_TOURS(state, value) {
            state.tours = value;
        },
        ADD_TOURS(state, value) {
            state.tours = [...state.tours, ...value];
        },
        SET_POPULAR_TOURS(state, value) {
            state.popularTours = value;
        },
    },
    getters: {
        //
        defaultData: (state) => {
            return {
                q: '',
                date_from: '',
                date_to: '',
                duration_from: 0,
                duration_to: state.options.duration_to,
                price_from: 0,
                price_to: state.options.price_to,
                direction: '',
                type: '',
                subject: '',
                place: '',
                landing: '',
                page: 1,
                future: 1,
                per_page: 12,
                sort_by: 'date',
                sort_dir: 'asc',
                view: 'gallery',
                lang: 'uk',
            }
        },
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
                future: state.formData.future,
                place: state.formData.place,
                landing: state.formData.landing,
                subject: state.formData.subject,
                page: state.pagination.current_page,
                per_page: state.pagination.per_page,
                sort_by: state.sorting.sortBy,
                sort_dir: state.sorting.sortDirection,
                lang: state.formData.lang,
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
                future: state.formData.future,
                subject: state.formData.subject,
                place: state.formData.place,
                landing: state.formData.landing,
            }
        }
    },
    actions: {
        initFilter({commit, state}) {
            const query = urlUtils.parseQuery();
            const formData = {
                q: query.q || '',
                date_from: query.date_from || '',
                date_to: query.date_to || '',
                duration: [
                    query.duration_from ? parseInt(query.duration_from) : 0,
                    query.duration_to ? parseInt(query.duration_to) : state.options.duration_to
                ],
                price: [
                    query.price_from ? parseInt(query.price_from) : 0,
                    query.price_to ? parseInt(query.price_to) : state.options.price_to
                ],
                direction: query.direction ? parseInt(query.direction) : '',
                type: query.type ? parseInt(query.type) : '',
                place: query.place ? parseInt(query.place) : '',
                landing: query.landing ? parseInt(query.landing) : '',
                subject: query.subject ? parseInt(query.subject) : '',
                lang: query.lang || document.documentElement.lang || 'uk',
            };
            commit('UPDATE_FORM_DATA', formData);

            const pagination = {
                current_page: query.page ? parseInt(query.page) : 1,
                per_page: query.per_page ? parseInt(query.per_page) : 12,
            };

            commit('SET_PAGINATION', pagination);

            const sorting = {
                sortBy: query.sort_by ? query.sort_by : 'date',
                sortDirection: query.sort_dir ? query.sort_dir : 'asc',
            }

            commit('SET_SORTING', sorting);
        },

        async clearFilter({commit, state}) {
            commit('UPDATE_FORM_DATA', {
                q: '',
                date_from: '',
                date_to: '',
                duration: [0, state.options.duration_to],
                price: [0, state.options.price_to],
                direction: '',
                type: '',
                subject: '',
                place: '',
                landing: '',
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
                    current_page: parseInt(response.current_page),
                    per_page: parseInt(response.per_page),
                    last_page: parseInt(response.last_page),
                    total: parseInt(response.total),
                });
                commit('SET_REQUEST_TITLE', response.request_title);
            }
            commit('SET_FETCH_REQUEST', false);
        },
        async fetchPopularTours({commit}) {

            const response = await toursService.fetchPopularTours();

            if (response) {
                commit('SET_POPULAR_TOURS', response);
            }
        },
        async submit({getters, dispatch}) {
            const path = document.location.pathname;
            const query = urlUtils.filterParams(getters.formData, getters.defaultData);

            urlUtils.updateUrl(path, query, true);
            await dispatch('fetchTours', getters.formData);
        }
    }
}
