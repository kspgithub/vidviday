<template>
    <slide-up-down :model-value="show">
        <div class="radio-additional-tabs">
            <div class="radio-additional-tab active">
                <div class="spacer-xs"></div>
                <h2 class="h3 m10">{{ __('order-section.additional.title') }}</h2>
                <span class="text">
                    {{ __('order-section.additional.question') }}
                    <tooltip>
                        <span v-html="__('order-section.additional.tooltip')"></span>
                    </tooltip>
                </span>
                <div class="spacer-xs"></div>

                <form-radio
                    v-model="additional"
                    name="additional"
                    :value="1"
                    :label="__('order-section.additional.yes')"
                />
                <form-radio
                    v-model="additional"
                    name="additional"
                    :value="0"
                    :label="__('order-section.additional.skip')"
                />
            </div>

            <div class="radio-additional-tab"></div>
        </div>
    </slide-up-down>
</template>

<script>
import FormRadio from '../form/FormRadio'
import SlideUpDown from 'vue3-slide-up-down'
import { useStore } from 'vuex'
import { computed } from 'vue'
import Tooltip from '../common/Tooltip'

export default {
    name: 'OrderAdditional',
    components: { Tooltip, FormRadio, SlideUpDown },
    props: {
        show: Boolean,
    },
    setup() {
        const store = useStore()
        const additional = computed({
            get: () => store.state.orderTour.additional,
            set: val => store.commit('orderTour/SET_ADDITIONAL', val),
        })

        return {
            additional,
        }
    },
}
</script>

<style scoped></style>
