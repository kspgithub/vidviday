<template>
    <div class="load-more-wrapp vue-load-more">
        <div class="text" :class="textSize" ref="textRef" v-observe-visibility="visibilityChanged" :style="style"
             @transitionend="onTransitionEnd()">
            <slot/>
        </div>
        <div v-if="spacer" :class="'spacer-' + spacer"></div>
        <div class="text-right" v-if="showBtn">
            <div class="show-more-btn" :class="{active: isActive}" @click.prevent.stop="toggle()">
                <span v-if="!isActive">{{ __('common.read-more') }}</span>
                <span v-if="isActive">{{ __('common.hide-text') }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import {onMounted, reactive, ref} from "vue";

export default {
    name: "MoreText",
    props: {
        active: Boolean,
        minHeight: {
            type: Number,
            default: 125
        },
        duration: {
            type: Number,
            default: 500,
        },
        spacer: {
            type: String,
            default: '',
        },
        textSize: {
            type: String,
            default: 'text-md',
        },
    },
    setup(props) {
        const inited = ref(false);
        const showBtn = ref(false);
        const isVisible = ref(false);
        const textRef = ref(null);
        const isActive = ref(!!props.active);
        const minHeight = ref(props.minHeight);
        const maxHeight = ref(props.minHeight);
        const style = reactive({});

        const toggle = () => {
            isActive.value = !isActive.value;
            const div = textRef.value;
            div.style.height = (isActive.value ? maxHeight.value : minHeight.value) + 'px';
        }

        const onTransitionEnd = () => {

        }

        const calcHeight = () => {
            if (isVisible.value && !inited.value) {
                const div = textRef.value;
                maxHeight.value = div.offsetHeight;
                if (minHeight.value > maxHeight.value) {
                    minHeight.value = maxHeight.value;

                } else {
                    showBtn.value = true;
                }


                div.style.height = (isActive.value ? maxHeight.value : minHeight.value) + 'px';
                inited.value = true;
            }
        }

        const visibilityChanged = (visible) => {
            isVisible.value = visible;
            calcHeight();
        }

        onMounted(() => {
            const div = textRef.value;
            div.style.transitionProperty = 'height';
            div.style.transitionDuration = props.duration + 'ms';
            calcHeight();
        });

        return {
            toggle,
            isActive,
            textRef,
            style,
            showBtn,
            onTransitionEnd,
            visibilityChanged,
        }
    }
}
</script>

<style scoped lang="scss">
.text {
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
