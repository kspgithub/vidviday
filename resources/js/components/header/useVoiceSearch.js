import { useStore } from 'vuex'
import { computed } from 'vue'

export default () => {
    const store = useStore()
    const popupOpen = computed(() => store.state.headerSearch.popupOpen)

    const searchText = computed({
        get: () => store.state.headerSearch.searchText,
        set: val => store.commit('headerSearch/SET_SEARCH_TEXT', val),
    })

    const recording = computed({
        get: () => store.state.headerSearch.recording,
        set: val => store.commit('headerSearch/SET_RECORDING', val),
    })

    store.dispatch('headerSearch/initVoiceSearch')

    const closePopup = () => {
        store.dispatch('headerSearch/stopVoice')
        store.commit('headerSearch/SET_POPUP_OPEN', false)
    }

    const startRecording = () => {
        store.dispatch('headerSearch/startVoice')
    }

    return {
        searchText,
        startRecording,
        recording,
        popupOpen,
        closePopup,
    }
}
