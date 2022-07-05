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

                    <!-- @see App\Helpers\Types\TourCorporateIncludes::values() -->
                    <template v-for="item in corporateIncludes">
                        <template v-if="includes.includes(item.value)">
                            <label class="checkbox small">
                                <input type="checkbox" :value="item.value" name="price_include[]" v-model="price_include">
                                <span>{{item.text}}</span>
                            </label>
                            <br>
                        </template>
                    </template>

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
        includes: Array,
        corporateIncludes: {
            type: Array,
            default() {
                return [];
            }
        },
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
