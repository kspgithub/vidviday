<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">
            <div class="img done">
                <img src="/icon/done.svg" alt="done">
            </div>
            <div class="text-center">
                <div class="spacer-xs"></div>
                <span class="h2 title text-medium">{{ data.title || __('popup.thanks-message') }}</span>
                <br>
                <span class="text" v-if="data.message">{{ data.message }}</span>
                <div class="spacer-xs"></div>
                <span class="btn type-1 close-popup" @click.prevent.stop="closePopup()">
                    {{ __('popup.return') }}
                </span>
            </div>
            <div class="btn-close" @click.prevent.stop="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>
</template>

<script>
import Popup from "./Popup";
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    name: "PopupThanks",
    components: {Popup},
    setup() {
        const store = useStore();
        const popupOpen = computed(() => store.state.userQuestion.popupThanksOpen);
        const data = computed(() => store.state.userQuestion.thanksData);
        const closePopup = () => store.commit('userQuestion/SET_POPUP_THANKS_OPEN', false);
        return {
            data,
            popupOpen,
            closePopup,
        }
    }
}
</script>

<style scoped>

</style>
