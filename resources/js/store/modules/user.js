import {fetchProfile} from "../../services/user-service";

export default {
    namespaced: true,
    state() {
        return {
            loggedIn: false,
            currentUser: null,
        }
    },
    mutations: {
        SET_PROFILE(state, value) {
            state.currentUser = value;
        },
    },
    actions: {
        async loadProfile({commit}) {
            const data = await fetchProfile();
            commit('SET_PROFILE', data);
        }
    }
}
