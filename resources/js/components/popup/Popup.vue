<template>
    <div class="popup-content vue-popup" :class="{active: visible}">
        <div class="layer-close" @click.stop="hide()"></div>

        <div class="popup-container" :class="size">

            <slot/>
        </div>
    </div>
</template>

<script>
import {ref, computed} from "vue";

export default {
    name: "Popup",
    props: {
        active: Boolean,
        size: {
            type: String,
            default: ''
        }
    },
    setup(props, {slots, emit}) {
        const visible = ref(props.active);

        const hide = () => {
            visible.value = false;
        }

        return {
            hide,
            visible,
        }
    }
}
</script>

<style scoped>

</style>
