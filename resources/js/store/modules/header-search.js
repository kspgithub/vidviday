import {autocompleteSearch} from "../../services/search-service";

export default {
    namespaced: true,
    state() {
        return {
            recognition: null,
            recording: false,
            voiceBtn: false,
            tours: [],
            places: [],
            mobileActive: false,
            active: false,
            request: false,
            popupOpen: false,
            searchText: '',
        }
    },
    mutations: {
        SET_TOURS(state, value) {
            state.tours = value;
        },
        SET_PLACES(state, value) {
            state.places = value;
        },
        SET_ACTIVE(state, value) {
            state.active = value;
        },
        SET_MOBILE_ACTIVE(state, value) {
            state.mobileActive = value;
        },
        SET_REQUEST(state, value) {
            state.request = value;
        },
        SET_POPUP_OPEN(state, value) {
            state.popupOpen = value;
        },
        SET_SEARCH_TEXT(state, value) {
            state.searchText = value;
        },
        SET_RECOGNITION(state, value) {
            state.recognition = value;
        },
        SET_RECORDING(state, value) {
            state.recording = value;
        },
        SET_VOICE_BTN(state, value) {
            state.voiceBtn = value;
        },
    },
    getters: {
        voiceSupport: (state) => !!state.recognition,
    },
    actions: {
        async search({commit, state}) {
            commit('SET_REQUEST', true)
            commit('SET_TOURS', []);
            commit('SET_PLACES', []);
            if (state.searchText.length > 2) {
                const response = await autocompleteSearch(state.searchText);
                if (response) {
                    commit('SET_TOURS', response.tours);
                    commit('SET_PLACES', response.places);
                    commit('SET_ACTIVE', true)
                }
            }
            setTimeout(() => {
                commit('SET_REQUEST', false)
            }, 1000)
        },
        async initVoiceSearch({commit}) {
            if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                const rec = new SpeechRecognition();
                rec.interimResults = true;
                rec.lang = 'uk-UA';
                rec.onstart = (evt) => {
                    commit('SET_RECORDING', true);
                }
                rec.onend = (evt) => {
                    commit('SET_POPUP_OPEN', false);
                    commit('SET_RECORDING', false);
                }
                rec.onerror = (event) => {
                    console.log('onerror', event.error);
                    commit('SET_RECORDING', false);
                    commit('SET_POPUP_OPEN', false);
                    /* Revert input and icon CSS if no speech is detected */
                    if (event.error === 'no-speech') {
                        commit('SET_SEARCH_TEXT', '');
                    }
                }
                rec.onresult = function (evt) {
                    if (typeof (evt.results) == 'undefined') {
                        rec.onend = null;
                        rec.stop();
                        commit('SET_RECORDING', false);
                        return;
                    }
                    let speechOutput = Array.from(evt.results).map(function (result) {
                        return result[0]
                    }).map(function (result) {
                        return result.transcript
                    }).join('')
                    commit('SET_SEARCH_TEXT', speechOutput);
                };
                commit('SET_RECOGNITION', rec);
            }
        },
        async stopVoice({commit, state}) {
            if (state.recognition) {
                state.recognition.stop();
            }
            commit('SET_RECORDING', false);
        },
        async startVoice({commit, state}) {
            if (state.recognition) {
                state.recognition.start();
                commit('SET_RECORDING', true);
            }

        }
    }
}
