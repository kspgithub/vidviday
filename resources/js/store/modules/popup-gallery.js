export default {
    namespaced: true,
    state() {
        return {
            media: [],
            active: false,
            currentSlide: 0,
        }
    },
    mutations: {
        SET_MEDIA(state, value) {
            state.media = value
        },
        SET_ACTIVE(state, value) {
            state.active = value
        },
        SET_CURRENT_SLIDE(state, value) {
            state.currentSlide = value
        },
    },
}
