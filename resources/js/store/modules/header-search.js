import {autocompleteTours} from "../../services/tour-service";

export default {
    namespaced: true,
    state() {
        return {
            tours: [],
            active: false,
            request: false,
            popupOpen: false,
            searchText: '',
        }
    },
    mutations: {
        SET_TOURS(state, value) {
            state.tours = value;
        },
        SET_ACTIVE(state, value) {
            state.active = value;
        },
        SET_REQUEST(state, value) {
            state.request = value;
        },
        SET_POPUP_OPEN(state, value) {
            state.popupOpen = value;
        },
        SET_SEARCH_TEXT(state, value) {
            state.searchText = value;
        },
    },
    actions: {
        async searchTours({commit, state}) {
            commit('SET_REQUEST', true)
            commit('SET_TOURS', []);
            if (state.searchText.length > 2) {
                const response = await autocompleteTours(state.searchText);
                if (response) {
                    commit('SET_TOURS', response);
                }
            }
            commit('SET_REQUEST', false)
        }
    }
}
