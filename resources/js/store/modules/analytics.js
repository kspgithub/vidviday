export default {
    namespaced: true,
    state() {
        return {
            utm: {
                utm_campaign: '',
                utm_content: '',
                utm_medium: '',
                utm_source: '',
                utm_term: '',
            }
        }
    },
    mutations: {
        SET_UTM_FIELDS(state, value) {
            Object.assign(state.utm, value);
        },
    },

}
