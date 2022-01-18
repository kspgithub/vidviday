<template>
    <div class="container">
        <div class="spacer-sm"></div>
        <h1 class="h1" v-if="(schedules.length > 0 && !orderCorporate) && tourSelected ">
            <span v-if="tour">Замовлення туру:</span>
            {{ tour ? tour.title : 'Замовлення туру' }}
        </h1>
        <h1 class="h1" v-if="(schedules.length === 0 || orderCorporate) && tourSelected">
            <span v-if="tour">Замовлення корпоративу:</span>
            {{ tour ? tour.title : 'Замовлення корпоративу' }}
        </h1>
        <h1 class="h1" v-if="!tourSelected && !orderCorporate">Замовлення туру</h1>
        <h1 class="h1" v-if="!tourSelected && orderCorporate">Замовлення корпоративу</h1>
        <div class="spacer-xs"></div>
        <form :action="action" class="tabs vue-tabs" method="post">
            <slot/>
            <ul class="tab-toggle mb-40">
                <li class="tab-caption" :class="{active: currentStep === 1}"
                    @click="setStep(1)">
                    <span>1</span> Основні дані
                </li>
                <li class="tab-caption"
                    :class="{active: currentStep === 2, disabled: currentStep < 2 || (group_type === 0 && additional === 0)}"
                    @click="setStep(2)">
                    <span>2</span> Додаткові дані
                </li>
                <li class="tab-caption" :class="{active: currentStep === 3, disabled: currentStep < 3}"
                    @click="setStep(3)">
                    <span>3</span> Підтвердження
                </li>
            </ul>

            <div class="tabs-wrap">
                <!-- TAB #1 -->
                <order-step-one v-if="!orderCorporate" :tour-selected="tourSelected" :active="currentStep === 1"/>
                <order-step-one-corp v-if="orderCorporate" :tour-selected="tourSelected" :active="currentStep === 1"/>
                <!-- TAB #1 END -->

                <!-- TAB #2 -->
                <order-step-two v-if="group_type === 0" :active="currentStep === 2"/>
                <order-step-two-corp v-if="group_type === 1" :active="currentStep === 2"/>
                <!-- TAB #2 END -->

                <!-- TAB #3 -->
                <order-step-three :active="currentStep === 3"/>
                <!-- TAB #3 END -->
            </div>
            <div class="spacer-xs"></div>
            <div v-if="!(currentStep === 2 && group_type === 1)">
                <span class="text-sm">* обов’язкове для заповнення поле</span>
                <div class="spacer-sm"></div>
            </div>
            <hr>
            <div class="spacer-xs"></div>
            <div class="relative">
                <div class="row align-items-center">

                    <div class="col-4">
                        <span class="btn btn-read-more left-arrow text-bold" v-if="currentStep !== 1"
                              @click="prevStep()">Назад</span>
                    </div>

                    <div class="col-md-6 col-8 text-right" v-if="currentStep !== 3">
                        <span class="btn type-1 tab-next" @click="nextStep()">Наступний крок</span>
                    </div>

                    <div class="col-8 justify-content-end align-items-center d-flex" v-if="currentStep === 3">
                        <form-checkbox class="small only-desktop-pad"
                                       name="conditions"
                                       v-model="conditions" label="Я прочитав та приймаю умови"/>
                        <span class="text">
                            <a href="/" target="_blank">&nbsp;Правил бронювання</a>
                        </span>
                        <button type="submit" @click="submit($event)" class="btn type-1  ms-30">
                            Оформити замовлення
                        </button>
                    </div>
                </div>


            </div>
        </form>
    </div>
</template>

<script>
import OrderStepOne from "./OrderStepOne";
import {computed, watch} from "vue";
import OrderStepTwo from "./OrderStepTwo";
import OrderStepThree from "./OrderStepThree";
import {useStore} from "vuex";
import {useFormDataProperty} from "../../store/composables/useFormData";
import FormCheckbox from "../form/FormCheckbox";
import {useForm} from "vee-validate";
import * as UrlUtils from "../../utils/url";
import {scrollToEl} from "../../utils/functions";
import OrderStepTwoCorp from "./OrderStepTwoCorp";
import OrderStepOneCorp from "./OrderStepOneCorp";

export default {
    name: "OrderForm",
    components: {OrderStepOneCorp, OrderStepTwoCorp, FormCheckbox, OrderStepThree, OrderStepTwo, OrderStepOne},
    props: {
        action: String,
        currentStep: {
            default: 1,
        },
        tour: {
            default() {
                return null;
            }
        },
        user: {
            default() {
                return null;
            }
        },
        tourSelected: {
            type: Boolean,
            default() {
                return false;
            }
        },
        orderCorporate: {
            type: Boolean,
            default() {
                return false;
            }
        },
        scheduleId: {
            default: 0
        },
        schedules: {
            type: Array,
            default() {
                return [];
            }
        },
        discounts: {
            type: Array,
            default() {
                return [];
            }
        },
        rooms: {
            type: Array,
            default() {
                return [];
            }
        },
        paymentTypes: {
            type: Array,
            default() {
                return [];
            }
        },
        confirmationTypes: {
            type: Array,
            default() {
                return [];
            }
        },
    },
    setup(props) {
        const store = useStore();

        store.commit('orderTour/INIT', {
            user: props.user,
            schedules: props.schedules,
            rooms: props.rooms,
            discounts: props.discounts,
            scheduleId: props.scheduleId,
            currentStep: props.currentStep,
            paymentTypes: props.paymentTypes,
            confirmationTypes: props.confirmationTypes,
        })

        if (props.currentStep === 1) {
            store.commit('orderTour/SET_TOUR', props.tour);
            store.commit('orderTour/UPDATE_FORM_DATA', {
                tour_id: props.tour ? props.tour.id : 0,
                schedule_id: props.scheduleId
            });
        }


        if (!props.tourSelected) {
            store.commit('orderTour/UPDATE_FORM_DATA', {children: 0});
        }

        store.commit('orderTour/UPDATE_FORM_DATA', {group_type: props.orderCorporate ? 1 : 0});

        const currentStep = computed(() => store.state.orderTour.currentStep);
        const additional = computed(() => store.state.orderTour.additional);
        const schedules = computed(() => store.state.orderTour.schedules);

        const group_type = computed(() => store.state.orderTour.formData.group_type);
        const program_type = computed(() => store.state.orderTour.formData.program_type);
        const tour_id = computed(() => store.state.orderTour.formData.tour_id);
        const formData = computed(() => store.state.orderTour.formData);


        const conditions = useFormDataProperty('orderTour', 'conditions');

        const validationSchema = computed(() => {
            let schema = {};
            if (currentStep.value === 1) {
                schema = {
                    first_name: 'required',
                    last_name: 'required',
                    email: 'required|email',
                    phone: 'required|tel',
                    places: 'required|min:1',
                }
                if (!props.tourSelected && program_type.value === 0) {
                    schema.tour_id = () => tour_id.value > 0 ? true : 'Оберіть тур';
                }
                if (!props.tourSelected && program_type.value === 1) {
                    schema.tour_plan = 'required';
                }
                if (group_type.value === 0 && schedules.value.length > 0) {
                    schema.schedule_id = 'required';
                } else {
                    if (!props.tourSelected && group_type.value === 1) {
                        schema.start_date = () => !formData.value.start_date ? 'Оберіть дату виїзду' : true;
                        schema.start_place = 'required';
                        schema.end_date = () => !formData.value.start_date ? 'Оберіть дату повернення' : true;
                        schema.end_place = 'required';
                    } else {
                        schema.start_date = 'required';
                    }
                }
            }
            if (currentStep.value === 2 && group_type.value === 0) {
                schema.participant_phone = 'required|tel';
            }
            if (currentStep.value === 3) {
                schema.conditions = () => {
                    return conditions.value === 1 ? true : 'Ви повинні прийняти умови правил бронювання.';
                };
            }
            return schema;
        });

        const {validate, errors} = useForm({
            validationSchema: validationSchema,
        });


        const submit = async (event) => {
            const result = await validate();
            if (result.valid) {

            } else {
                console.log(errors.value);
                event.preventDefault();
            }
        }

        const nextStep = async () => {
            const result = await validate();
            if (result.valid) {
                if (currentStep.value === 1 && group_type.value === 0) {
                    await store.dispatch('orderTour/setParticipants');
                    await store.dispatch('orderTour/setAccommodation');
                }
                if (currentStep.value === 1 && group_type.value === 0 && additional.value === 0) {
                    await store.dispatch('orderTour/setStep', 3);
                } else {
                    await store.dispatch('orderTour/nextStep');
                }
                scrollToEl('.h1', -110);
            } else {
                console.log(errors.value)
                const first_error = Object.keys(errors.value)[0];
                scrollToEl(`[name="${first_error}"]`, -150);
            }
        }

        const prevStep = async () => {
            if (currentStep.value === 3 && group_type.value === 0 && additional.value === 0) {
                await store.dispatch('orderTour/setStep', 1);
            } else {
                await store.dispatch('orderTour/prevStep')
            }
            scrollToEl('.h1', -110);
        }

        watch(currentStep, () => {
            UrlUtils.updateUrlQuery({step: currentStep.value === 1 ? null : currentStep.value});
        });

        return {
            setStep: (step) => store.dispatch('orderTour/setStep', step),
            prevStep,
            nextStep,
            group_type,
            currentStep,
            conditions,
            submit,
            additional,
            errors,
        }
    }
}
</script>

<style scoped>

</style>