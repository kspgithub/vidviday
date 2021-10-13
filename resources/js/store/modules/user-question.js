import axios from "axios";
import {getError} from "../../services/api";
import toast from "../../libs/toast";

export default {
    namespaced: true,
    state() {
        return {
            active: false,
            request: false,
            popupThanksOpen: false,
            popupCallOpen: false,
            popupMailOpen: false,
            thanksData: {
                title: 'Дякуємо за повідомлення',
                message: 'Ми передзвонимо у обраний Вами час',
            }
        }
    },
    mutations: {
        SET_ACTIVE(state, value) {
            state.active = value;
        },
        SET_REQUEST(state, value) {
            state.request = value;
        },
        SET_POPUP_MAIL_OPEN(state, value) {
            state.popupMailOpen = value;
        },
        SET_POPUP_CALL_OPEN(state, value) {
            state.popupCallOpen = value;
        },
        SET_POPUP_THANKS_OPEN(state, value) {
            state.popupThanksOpen = value;
        },
        SET_THANKS_DATA(state, data = {}) {
            Object.assign(state.thanksData, data);
        },
    },
    actions: {
        async send({commit}, data) {
            commit('SET_REQUEST', true);
            const response = await axios.post('/api/user/feedback', data).catch(error => {
                if (!axios.isCancel(error)) {
                    const message = getError(error);
                    toast.error(message);
                }
            })
            commit('SET_REQUEST', false);
            return response;
        },
        showThanks({commit}, data = {}) {
            commit('SET_THANKS_DATA', data);
            commit('SET_POPUP_THANKS_OPEN', true);
        }
    }
}
