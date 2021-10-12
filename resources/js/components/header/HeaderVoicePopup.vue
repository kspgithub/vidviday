<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">
            <div class="img mic-icon">
                <img src="/icon/big-mic.svg" alt="big mic">
            </div>
            <div class="text-center">
                <span class="h2 title text-medium">Проговоріть фразу для пошуку</span>
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
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    name: "HeaderVoicePopup",
    components: {Popup},
    setup() {
        const store = useStore();
        const popupOpen = computed(() => store.state.headerSearch.popupOpen);

        const closePopup = () => {
            store.commit('headerSearch/SET_POPUP_OPEN', false);
        }

        return {
            popupOpen,
            closePopup,
        }
    }
}
</script>

<style scoped>

</style>
