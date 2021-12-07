export default {
    namespaced: true,
    state() {
        return {
            currentStep: 1,
            tour: null,
            paymentTypes: [],
            packings: [],
            formData: {
                first_name: '',
                last_name: '',
                phone: '',
                email: '',

                first_name_recipient: '',
                last_name_recipient: '',

                type: '',
                format: '',
                design: '',
                sum: null,
                tour_id: 0,
                places: 1,
                packing: null,
                packing_type: '',
                payment_type: 0,
                comment: ''
            }
        }
    },
    mutations: {
        SET_CURRENT_STEP(state, value) {
            state.currentStep = value;
        },
        UPDATE_FORM_DATA(state, value) {
            Object.assign(state.formData, value);
        },
        SET_TOUR(state, value) {
            state.tour = value;
        },
        SET_PACKINGS(state, value) {
            state.packings = value;
        },
        SET_PAYMENT_TYPES(state, value) {
            state.paymentTypes = value;
        }
    },
    actions: {
        setStep({commit}, step) {
            commit('SET_CURRENT_STEP', step);
        },
        nextStep({commit, state}) {
            commit('SET_CURRENT_STEP', state.currentStep + 1);
        },
        prevStep({commit, state}) {
            commit('SET_CURRENT_STEP', state.currentStep - 1);
        },
    },
    getters: {
        selectedPacking: (state) => state.packings.find(p => p.slug === state.formData.packing_type),
        totalPrice: (state, getters) => {
            let total = 0;
            if (state.formData.type === 'sum') {
                total += state.formData.sum || 0;
            }
            if (state.formData.type === 'tour' && state.tour) {
                total += ((state.tour.price || 0) + (state.tour.commission || 0)) * state.formData.places;
            }
            if (state.formData.packing === 1) {
                total += getters.selectedPacking ? getters.selectedPacking.price : 0;
            }
            return total;
        }
    }
}
