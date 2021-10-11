<template>
    <div class="seo-text load-more-wrapp vue-load-more">
        <slide-up-down v-model="isActive" :duration="300" :min-height="125" class="more-info active">
            <div class="text text-md">
                <slot/>
            </div>
        </slide-up-down>
        <div class="spacer-xs"></div>
        <div class="text-right">
            <div class="show-more-btn" @click.prevent.stop="toggle()">
                <span v-if="!isActive">{{ __('Read more') }}</span>
                <span v-if="isActive">{{ __('Hide text') }}</span>

            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import SlideUpDown from "./SlideUpDown";

export default {
    name: "ShowMoreText",
    components: {SlideUpDown},
    props: {
        active: Boolean,
    },
    setup(props) {
        const isActive = ref(!!props.active);

        const toggle = () => {
            isActive.value = !isActive.value;
        }

        return {
            toggle,
            isActive,
        }
    }
}
</script>

<style scoped>

</style>
