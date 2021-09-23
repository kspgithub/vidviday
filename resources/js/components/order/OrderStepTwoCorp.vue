<template>
    <div class="tab" :class="{active: active}">
        <div class="row">
            <div class="col-xl-6 col-12">
                <div class="mb-40">
                    <h2 class="h3 mb-10">Група</h2>
                    <div class="text mb-10">
                        <p>Опишіть особливості групи: вік учасників, співвідношення статей, рід занять та інше. Для
                            шкільних
                            груп: вкажіть співвідношення дітей та супроводжуючих дорослих</p>
                    </div>
                    <form-textarea name="group_comment" v-model="group_comment"/>
                </div>

                <div class="mb-40">
                    <span class="text text-sm title"><b>Побажання до організації та умов туру</b></span>
                    <form-textarea name="program_comment"
                                   v-model="program_comment"
                                   placeholder="Екскурсійний супровід, розваги, транспорт, проживання, харчування та інше"
                    />
                </div>

                <h2 class="h3">Включити у вартість</h2>
                <div class="spacer-xs"></div>
                <div class="checkbox-wrap">
                    <label class="checkbox small">
                        <input type="checkbox" value="support" name="price_include[]" v-model="price_include">
                        <span>Екскурсійний супровід</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="bus" name="price_include[]" v-model="price_include">
                        <span>Проїзд у туристичному автобусі</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="apartment" name="price_include[]" v-model="price_include">
                        <span>Поселення</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="food" name="price_include[]" v-model="price_include">
                        <span>Харчування</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="ticket" name="price_include[]" v-model="price_include">
                        <span>Вхідні квитки</span>
                    </label>
                    <br>
                    <label class="checkbox small">
                        <input type="checkbox" value="insurance" name="price_include[]" v-model="price_include">
                        <span>Страхування на час подорожі</span>
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
