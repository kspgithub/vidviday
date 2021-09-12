export default {
    namespaced: true,
    state() {
        return {
            testimonials: [],
            popupOpen: false,
            parentId: 0,
        }
    },
    mutations: {
        SET_TESTIMONIALS(state, value) {
            state.testimonials = value;
        },
        SET_POPUP_OPEN(state, value) {
            state.popupOpen = value;
        },
        SET_PARENT_ID(state, value) {
            state.parentId = value;
        },
    },
}
