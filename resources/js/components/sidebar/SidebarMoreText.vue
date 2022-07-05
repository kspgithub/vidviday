<template>
    <div class="sidebar-more-text">
        <div class="text" ref="textRef" v-observe-visibility="visibilityChanged" :style="style"
             @transitionend="onTransitionEnd()">
            <slot/>
        </div>
        <div class="show-more-btn" v-if="showBtn" :class="{active: isActive}" @click.prevent.stop="toggle()">
            <span v-if="!isActive">{{ __('common.read-more') }}</span>
            <span v-if="isActive">{{ __('common.hide-text') }}</span>
        </div>
    </div>
</template>

<script>
import {onMounted, reactive, ref} from "vue";

export default {
    name: "SidebarMoreText",
    props: {
        minHeight: {
            type: Number,
            default: 45
        },
        duration: {
            type: Number,
            default: 500,
        },
    },
    setup(props) {
        const isVisible = ref(false);
        const inited = ref(false);
        const showBtn = ref(false);
        const isActive = ref(false);
        const textRef = ref(null);
        const minHeight = ref(props.minHeight);
        const maxHeight = ref(props.minHeight);
        const style = reactive({});

        const onTransitionEnd = () => {

        }

        const toggle = () => {
            isActive.value = !isActive.value;
            const div = textRef.value;
            div.style.height = (isActive.value ? maxHeight.value : minHeight.value) + 'px';
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
            style,
            onTransitionEnd,
            textRef,
            isActive,
            toggle,
            showBtn,
            visibilityChanged,
        }
    }
}
</script>

<style scoped lang="scss">
.sidebar-more-text {
    .text {
        overflow: hidden;
    }
}
</style>
