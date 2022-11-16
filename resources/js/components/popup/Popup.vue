<template>
    <div class="popup-wrap" :class="{active: visible}">
        <div class="bg-layer"></div>
        <div class="popup-content vue-popup" :class="{active: visible}" ref="popupRef">
            <div class="layer-close" @click.stop="hide()"></div>

            <div class="popup-container" :class="size">

                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
import {ref, watch} from "vue";

export default {
    name: "Popup",
    props: {
        active: {
            type: Boolean,
            default: false,
        },
        size: {
            type: String,
            default: ''
        }
    },
    emits: ['hide'],
    setup(props, {emit}) {

        const popupRef = ref(null);
        const visible = ref(props.active);

        const hide = () => {
            visible.value = false;
            emit('hide');
        }

        watch(() => props.active, () => {
            if (props.active !== visible.value) {
                visible.value = props.active;
            }
            if (props.active) {
                window.removeScroll();

            } else {
                window.addScroll();
            }
        })

        return {
            popupRef,
            hide,
            visible,
        }
    }
}
</script>

<style scoped>

</style>
