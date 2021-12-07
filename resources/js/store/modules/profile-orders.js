export default {
    namespaced: true,
    state() {
        return {
            order: null,
            request: false,
            popupOpen: false,

        }
    },
    mutations: {
        SET_ORDER(state, value) {
            state.order = value;
        },
        SET_REQUEST(state, value) {
            state.request = value;
        },
        SET_POPUP_OPEN(state, value) {
            state.popupOpen = value;
        },
    },
    actions: {
        async cancel({commit, state}) {
            commit('SET_REQUEST', true)


            commit('SET_REQUEST', false)
        }
    }
}
