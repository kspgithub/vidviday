<template>
    <div class="seo-text load-more-wrapp vue-load-more">
        <div class="more-info active">
            <div class="text text-md">
                <slot />
            </div>
        </div>
        <div class="spacer-xs"></div>
        <div class="text-right">
            <div class="show-more-btn" :class="{ active: isActive }" @click.prevent.stop="toggle()">
                <span v-if="!isActive">{{ __('common.read-more') }}</span>
                <span v-if="isActive">{{ __('common.hide-text') }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import SlideUpDown from './SlideUpDown'

export default {
    name: 'ShowMoreText',
    components: { SlideUpDown },
    props: {
        active: Boolean,
        minHeight: {
            type: Number,
            default: 125,
        },
        duration: {
            type: Number,
            default: 500,
        },
    },
    setup(props) {
        const isActive = ref(!!props.active)

        const toggle = () => {
            isActive.value = !isActive.value
        }

        return {
            toggle,
            isActive,
        }
    },
}
</script>

<style scoped></style>
