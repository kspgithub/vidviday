<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()" :class="{active: recording}">
        <div class="popup-align">
            <div class="img mic-icon" @click="startRecording()">
                <img src="/icon/big-mic.svg" alt="big mic">
            </div>
            <div class="text-center">
                <span class="h2 title text-medium">
                    {{ searchText ? searchText : 'Проговоріть фразу для пошуку' }}
                </span>
            </div>
            <div class="voice-search-dots">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="spacer-xs"></div>
            <div class="btn-close" @click.prevent.stop="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>
</template>

<script>
import Popup from "../popup/Popup";
import {computed, nextTick, ref, watch} from "vue";
import {useStore} from "vuex";

export default {
    name: "HeaderVoicePopup",
    components: {Popup},
    setup() {
        const store = useStore();
        const popupOpen = computed(() => store.state.headerSearch.popupOpen);

        const searchText = computed({
            get: () => store.state.headerSearch.searchText,
            set: (val) => store.commit('headerSearch/SET_SEARCH_TEXT', val)
        });

        const recording = computed({
            get: () => store.state.headerSearch.recording,
            set: (val) => store.commit('headerSearch/SET_RECORDING', val)
        });

        store.dispatch('headerSearch/initVoiceSearch');

        const closePopup = () => {
            store.dispatch('headerSearch/stopVoice');
            store.commit('headerSearch/SET_POPUP_OPEN', false);
        }

        const startRecording = () => {
            store.dispatch('headerSearch/startVoice');
        }


        return {
            searchText,
            startRecording,
            recording,
            popupOpen,
            closePopup,
        }
    }
}
</script>

<style scoped>

</style>
