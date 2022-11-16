<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()" :class="{active: recording}">
        <div class="popup-align">
            <div class="img mic-icon" @click="startRecording()">
                <img src="/icon/big-mic.svg" alt="big mic">
            </div>
            <div class="text-center">
                <span class="h2 title text-medium">
                    {{ searchText ? searchText : __('header-section.search-phrase') }}
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
import useVoiceSearch from "./useVoiceSearch";

export default {
    name: "HeaderVoicePopup",
    components: {Popup},
    setup() {

        return {
            ...useVoiceSearch()
        }
    }
}
</script>

<style scoped>

</style>
