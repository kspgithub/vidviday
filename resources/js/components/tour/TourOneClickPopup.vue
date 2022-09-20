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
                    <form-input :label="__('forms.phone')" name="phone" v-model="phone" id="order-phone"
                                mask="+38 (099) 999-99-99"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input :label="__('forms.email')" name="email" v-model="email" id="order-email"/>
                </div>

                <div class="col-md-6 col-12">
                    <div class="single-datepicker">
                        <form-select-event v-model="schedule_id"
                                           :options="departureOptions"
                                           name="schedule_id"
                                           :label="__('forms.select-date') + '*'"
                                           :preselect="false"/>
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
                        <button type="submit" :disabled="request" @click="submitForm" class="btn type-1">
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
        <div class="popup-align" v-if="showThanks">
            <div class="img done">
                <img src="/icon/done.svg" alt="done">
            </div>
            <div class="text-center">
                <div class="spacer-xs"></div>
                <span class="h2 title text-medium">{{ __('order-section.thanks-message') }}</span>
                <br>
                <span class="text">{{ __('common.recall') }}</span>
                <br>
                <div class="spacer-xs"></div>
                <span class="btn type-1" @click="closePopup()">{{ __('popup.return') }}</span>
            </div>
            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>
</template>

<script>
import Popup from "../popup/Popup";
import {computed, ref} from "vue";
import {useStore} from "vuex";
import FormInput from "../form/FormInput";
import {useDebounceFormDataProperty, useFormDataProperty} from "../../store/composables/useFormData";
import FormTextarea from "../form/FormTextarea";
import FormNumberInput from "../form/FormNumberInput";
import FormSelectEvent from "../form/FormSelectEvent";
import axios from "axios";
import {getError} from "../../services/api";
import toast from "../../libs/toast";
import {useForm} from "vee-validate";
import {__} from "../../i18n/lang";

export default {
    name: "TourOneClickPopup",
    components: {FormSelectEvent, FormNumberInput, FormTextarea, FormInput, Popup},
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
                email: 'required|email',
                phone: 'required|tel',
                places: () => {
                    return data.value.places > 0 ? true : __('validation.min-place-1')
                },
                schedule_id: () => {
                    return data.value.schedule_id > 0 ? true : __('validation.select-tour-date')
                },
            },
        });

        if(user) {
            store.commit('orderTour/SET_USER', user);
        }

        store.commit('orderTour/SET_TOUR', props.tour);
        store.commit('orderTour/SET_SCHEDULES', props.schedules || []);

        const request = ref(false);

        const showForm = ref(true);
        const showThanks = ref(false);


        const popupOpen = computed(() => store.state.orderTour.popupOpen);


        const closePopup = () => {
            store.commit('orderTour/SET_POPUP_OPEN', false);
            showForm.value = true;
            showThanks.value = false;
        }
        const maxPlaces = computed(() => store.getters['orderTour/maxPlaces']);

        const departureOptions = computed(() => store.getters['orderTour/departureOptions']());


        const submitForm = async () => {
            const result = await validate();

            if (!result.valid) {
                event.preventDefault();
                console.log(errors);
            } else {

                request.value = true;
                axios.post(props.action, Object.assign({}, data.value))
                    .then(({data}) => {
                        if (data.result === 'success') {
                            showForm.value = false;
                            showThanks.value = true;
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

        return {
            first_name: useDebounceFormDataProperty('orderTour', 'first_name'),
            last_name: useDebounceFormDataProperty('orderTour', 'last_name'),
            email: useDebounceFormDataProperty('orderTour', 'email'),
            phone: useDebounceFormDataProperty('orderTour', 'phone'),
            comment: useDebounceFormDataProperty('orderTour', 'comment'),
            places: useFormDataProperty('orderTour', 'places'),
            schedule_id: useFormDataProperty('orderTour', 'schedule_id'),
            maxPlaces,
            popupOpen,
            closePopup,
            departureOptions,
            showForm,
            showThanks,
            request,
            submitForm,
        }
    }
}
</script>

<style scoped>

</style>
