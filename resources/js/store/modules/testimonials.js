export default {
    namespaced: true,
    state() {
        return {
            request: false,
            url: '',
            items: [],
            popupOpen: false,
            parentId: 0,
            tour: null,
            currentPage: 1,
            lastPage: 1,
            callback: false,
        }
    },
    mutations: {
        SET_URL(state, value) {
            state.url = value
        },
        SET_REQUEST(state, value) {
            state.request = value
        },
        SET_TESTIMONIALS(state, value) {
            state.items = value
        },
        PUSH_TESTIMONIAL(state, value) {
            state.items.push(value)
        },
        SET_POPUP_OPEN(state, value) {
            state.popupOpen = value
        },
        SET_PARENT_ID(state, value) {
            state.parentId = value
        },
        SET_TOUR(state, value) {
            state.tour = value
        },
        SET_CURRENT_PAGE(state, value) {
            state.currentPage = value
        },
        SET_LAST_PAGE(state, value) {
            state.lastPage = value
        },
        SET_CALLBACK(state, value) {
            state.callback = value
        },
    },
    actions: {
        openPopup({ commit }, parentId = 0) {
            commit('SET_PARENT_ID', parentId)
            commit('SET_POPUP_OPEN', true)
        },
        async loadItems({ commit, state }) {
            commit('SET_REQUEST', true)
            const { data: response } = await axios.get(state.url, {
                params: {
                    page: state.currentPage,
                },
            })
            if (response) {
                const items = response.current_page > 1 ? [...state.items, ...response.data] : response.data
                commit('SET_TESTIMONIALS', items)
                commit('SET_CURRENT_PAGE', response.current_page)
                commit('SET_LAST_PAGE', response.last_page)
            }

            commit('SET_REQUEST', false)
        },

        async loadMore({ commit, state, dispatch }) {
            commit('SET_CURRENT_PAGE', state.currentPage + 1)
            await dispatch('loadItems')
        },

        async answer({ commit, state }, payload) {
            commit('SET_REQUEST', true)
            const { data: response } = await axios.patch(state.url + '/answer', payload).catch(error => {
                console.log(error)
            })
            commit('SET_REQUEST', false)
            return response
        },

        async children({ commit, state }, id) {
            commit('SET_REQUEST', true)
            const { data: response } = await axios.get(state.url + '/' + id + '/children')
            commit('SET_REQUEST', false)
            return response
        },

        async callback({ commit, state }, data) {
            let response = typeof state.callback === 'function' && state.callback(data)
            commit('SET_CALLBACK', false)
            return response
        },
    },
}
