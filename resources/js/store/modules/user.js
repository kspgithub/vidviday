import { fetchProfile, fetchFavourites, toggleFavourite } from '../../services/user-service'

export default {
    namespaced: true,
    state() {
        return {
            loggedIn: false,
            currentUser: null,
            favourites: [],
        }
    },
    mutations: {
        SET_PROFILE(state, value) {
            state.currentUser = value
        },
        SET_FAVOURITES(state, value) {
            state.favourites = value
        },
    },
    getters: {
        inFavourites: state => id => {
            return state.favourites.indexOf(id) !== -1
        },
        countFavourites: state => state.favourites.length,
        isTourAgent: state => {
            return state.currentUser && !!state.currentUser.roles.find(r => r.name === 'tour-agent')
        },
    },
    actions: {
        async loadProfile({ commit }) {
            const data = await fetchProfile()
            commit('SET_PROFILE', data)
        },
        async loadFavourites({ commit }) {
            const data = await fetchFavourites()
            commit('SET_FAVOURITES', data)
        },
        async toggleFavourite({ commit }, id) {
            const data = await toggleFavourite(id)
            commit('SET_FAVOURITES', data)
        },
    },
}
