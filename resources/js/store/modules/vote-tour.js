const DEFAULT_VALUES = {
    tour_id: 0,
    user_id: null,
    first_name: '',
    last_name: '',
    phone: '',
    email: '',
    comment: '',
}

export default {
    namespaced: true,
    state() {
        return {
            popupOpen: false,
            tour: null,
            user: null,
            formData: { ...DEFAULT_VALUES },
        }
    },
    mutations: {
        INIT(state, payload) {
            state.user = payload.user || null
        },
        SET_TOUR(state, value) {
            state.tour = value
            Object.assign(state.formData, { tour_id: value ? value.id : 0 })
        },
        SET_USER(state, value) {
            state.user = value

            if (value.id) {
                state.formData.user_id = value.id
                state.formData.first_name = value.first_name
                state.formData.last_name = value.last_name
                state.formData.email = value.email
                state.formData.phone = value.mobile_phone
            }
        },
        SET_POPUP_OPEN(state, value) {
            state.popupOpen = value
        },
        UPDATE_FORM_DATA(state, value) {
            state.formData = { ...state.formData, ...value }
        },
    },
    getters: {
        votingData: state => {
            return {
                first_name: state.formData.first_name,
                last_name: state.formData.last_name,
                email: state.formData.email,
                phone: state.formData.phone,
                tour_id: state.formData.tour_id,
                user_id: state.formData.user_id,
                comment: state.formData.comment,
            }
        },
    },
    actions: {
        clearForm({ commit }) {
            commit('UPDATE_FORM_DATA', { ...DEFAULT_VALUES })
        },
    },
}
