<template>
    <div class="tab" :class="{active: active}">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="mb-40">
                    <h2 class="h3 mb-10">{{ __('order-section.group.label') }}</h2>
                    <div class="text mb-10">
                        <p v-html="__('order-section.group.description')"></p>
                    </div>
                    <form-textarea name="group_comment" v-model="group_comment"/>
                </div>

                <div class="mb-40">
                    <span class="text text-sm title"><b>{{ __('order-section.wish') }}</b></span>
                    <form-textarea name="program_comment" v-model="program_comment"
                                   :placeholder="__('order-section.wish-placeholder')"/>
                </div>

                <h2 class="h3">{{ __('order-section.includes.title') }}</h2>
                <div class="spacer-xs"></div>
                <div class="checkbox-wrap">
                    <label class="checkbox small">
                        <input type="checkbox" value="support" name="price_include[]" v-model="price_include">
                        <span>{{ __('order-section.includes.support') }}</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="bus" name="price_include[]" v-model="price_include">
                        <span>{{ __('order-section.includes.bus') }}</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="apartment" name="price_include[]" v-model="price_include">
                        <span>{{ __('order-section.includes.apartment') }}</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="food" name="price_include[]" v-model="price_include">
                        <span>{{ __('order-section.includes.food') }}</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="ticket" name="price_include[]" v-model="price_include">
                        <span>{{ __('order-section.includes.ticket') }}</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="insurance" name="price_include[]" v-model="price_include">
                        <span>{{ __('order-section.includes.insurance') }}</span>
                    </label>
                </div>
                <span class="text-sm"></span>
            </div>
        </div>
    </div>
</template>

<script>

import {useStore} from "vuex";

import {useDebounceFormDataProperty, useFormDataProperty} from "../../store/composables/useFormData";
import FormCheckbox from "../form/FormCheckbox";
import FormTextarea from "../form/FormTextarea";

export default {
    name: "OrderStepTwoCorp",
    components: {FormTextarea, FormCheckbox},
    props: {
        active: Boolean,
    },
    setup() {
        const store = useStore();


        return {
            group_comment: useDebounceFormDataProperty('orderTour', 'group_comment'),
            program_comment: useDebounceFormDataProperty('orderTour', 'program_comment'),
            price_include: useFormDataProperty('orderTour', 'price_include'),
        }
    }
}
</script>

<style scoped>

</style>
