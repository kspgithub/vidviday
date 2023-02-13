<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align" v-if="showForm">
            <div class="text-center">
                <span class="h2 title text-medium">{{ __('tours-section.order-one-click') }}</span>
            </div>
            <div class="spacer-xs"></div>
            <form :action="action" method="POST" class="row">
                <slot/>
                <div class="col-md-6 col-12">
                    <form-input :label="__('forms.last-name')"
                                name="last_name"
                                v-model="last_name"
                                id="order-last-name"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input :label="__('forms.name')" name="first_name" v-model="first_name" id="order-first-name"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-phone :label="__('forms.phone')" name="phone" v-model="phone" id="order-phone"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input :label="__('forms.email')" name="email" v-model="email" id="order-email"/>
                </div>

                <div class="col-md-6 col-12">
                    <div class="single-datepicker">
                        <div class="datepicker-input">
                            <form-select v-model.number="schedule_id"
                                         :options="departureOptions"
                                         :placeholder="__('forms.select-date')"
                                         name="schedule_id"
                                         :label="__('forms.select-date') + '*'"
                                         :preselect="false"/>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <form-number-input v-model="places"
                                       class="mb-10"
                                       :min="1"
                                       :max="maxPlaces"
                                       name="places"
                                       :title="__('forms.number-of-people') + '*'"/>
                </div>

                <div class="col-12">

                    <form-textarea v-model="comment" name="comment" id="order-comment"
                                   :label="__('forms.order-comment')"/>

                    <input name="conditions" type="hidden" value="1"/>

                    <div class="text-center">
                        <button type="submit" :disabled="request" @click.prevent="submitForm" class="btn type-1">
                            {{ __('forms.order') }}
                        </button>
                    </div>
                </div>
                <input type="hidden" name="group_type" value="0">
            </form>
            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>
</template>

<script>
import Popup from "../popup/Popup";
import { computed, ref } from "vue";
import { useStore } from "vuex";
import FormInput from "../form/FormInput";
import { useDebounceFormDataProperty, useFormDataProperty } from "../../store/composables/useFormData";
import FormTextarea from "../form/FormTextarea";
import FormNumberInput from "../form/FormNumberInput";
import FormSelectEvent from "../form/FormSelectEvent";
import axios from "axios";
import { getError } from "../../services/api";
import toast from "../../libs/toast";
import { useForm } from "vee-validate";
import { __ } from "../../i18n/lang";
import FormSelect from "../form/FormSelect";
import FormPhone from "../form/FormPhone";

export default {
    name: "TourOneClickPopup",
    components: {FormPhone, FormSelect, FormSelectEvent, FormNumberInput, FormTextarea, FormInput, Popup},
    props: {
        tour: Object,
        schedules: Array,
        action: String,
    },
    setup(props) {
        const store = useStore();
        const data = computed(() => store.getters['orderTour/oneClickData']);
        const user = store.state.user.currentUser

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                // email: 'required|email',
                phone: 'required|tel',
                places: () => {
                    return data.value.places > 0 ? true : __('validation.min-place-1')
                },
                schedule_id: () => {
                    return props.schedules.find(s => s.id === data.value.schedule_id) ? true : __('validation.select-tour-date')
                },
            },
        });

        if (user) {
            store.commit('orderTour/SET_USER', user);
        }

        store.commit('orderTour/SET_TOUR', props.tour);
        store.commit('orderTour/SET_SCHEDULES', props.schedules || []);

        const request = ref(false);

        const showForm = ref(true);


        const popupOpen = computed(() => store.state.orderTour.popupOpen);

        const closePopup = () => {
            store.commit('orderTour/SET_POPUP_OPEN', false);
            showForm.value = true;
        }
        const maxPlaces = computed(() => store.getters['orderTour/maxPlaces']);

        const departureOptions = computed(() => store.getters['orderTour/departureOptions']());

        // departureOptions.value.unshift({
        //     value: '',
        //     text: __('tours-section.date-title'),
        // })
        // console.log('departureOptions', departureOptions.value)

        const submitForm = async (e) => {
            e.preventDefault()

            const result = await validate();

            if (!result.valid) {
                event.preventDefault();
                console.log(errors);
            } else {

                request.value = true;
                axios.post(props.action, Object.assign({}, data.value))
                    .then(async ({data}) => {
                        if (data.result === 'success') {
                            closePopup()

                            await store.dispatch('userQuestion/showThanks', {
                                title: __('popup.types.one-click.thanks-title'),
                                message: __('popup.types.one-click.thanks-message'),
                            })

                        } else {
                            toast.error(data.message);
                        }
                        request.value = false;
                    })
                    .catch(error => {
                        if (!axios.isCancel(error)) {
                            const message = getError(error);
                            toast.error(message);
                            request.value = false;
                        }
                    });


            }
        }

        store.commit('orderTour/UPDATE_FORM_DATA', {schedule_id: ''});

        const popupTitle = __('tours-section.order-one-click')

        return {
            first_name: useDebounceFormDataProperty('orderTour', 'first_name'),
            last_name: useDebounceFormDataProperty('orderTour', 'last_name'),
            email: useDebounceFormDataProperty('orderTour', 'email'),
            phone: useDebounceFormDataProperty('orderTour', 'phone'),
            comment: useDebounceFormDataProperty('orderTour', 'comment'),
            places: useDebounceFormDataProperty('orderTour', 'places'),
            schedule_id: useDebounceFormDataProperty('orderTour', 'schedule_id'),
            maxPlaces,
            popupOpen,
            closePopup,
            departureOptions,
            showForm,
            request,
            submitForm,
        }
    }
}
</script>

<style scoped>

</style>
