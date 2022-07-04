<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align" v-if="showForm">
            <div class="text-center">
                <span class="h2 title text-medium">{{ __('tours-section.voting') }}</span>
            </div>
            <div class="spacer-xs"></div>
            <form :action="action" method="POST" class="row" @submit.prevent="submitForm">
                <slot/>
                <div class="col-md-6 col-12">
                    <form-input :label="__('forms.last-name')"
                                name="last_name"
                                v-model="last_name"
                                id="voting-last-name"
                                rules="required"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input :label="__('forms.name')" name="first_name" v-model="first_name" id="voting-first-name"
                                rules="required"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input mask="+38 (099) 999-99-99" :label="__('forms.phone')" name="phone" v-model="phone" id="voting-phone"
                                rules="required|tel"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input :label="__('forms.email')" name="email" v-model="email" id="voting-email"
                                rules="required|email"/>
                </div>

                <div class="col-12">

                    <form-textarea v-model="comment" name="comment" id="voting-comment"
                                   :label="__('forms.voting-comment')"/>

                    <input name="conditions" type="hidden" value="1"/>

                    <div class="text-center">
                        <button type="submit" :disabled="request" @click="submitForm" class="btn type-1">
                            {{ __('forms.vote') }}
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
                <span class="h2 title text-medium">{{ __('tour-section.voting-thanks-message') }}</span>
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
    name: "TourVotingPopup",
    components: {FormSelectEvent, FormNumberInput, FormTextarea, FormInput, Popup},
    props: {
        tour: Object,
        user: Object,
        action: String,
    },
    setup(props) {
        const store = useStore();
        const data = computed(() => store.getters['voteTour/votingData']);

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                email: 'required|email',
                phone: 'required|tel',
            },
        });
        store.commit('voteTour/SET_TOUR', props.tour);
        store.commit('voteTour/SET_USER', props.user);

        const request = ref(false);

        const showForm = ref(true);
        const showThanks = ref(false);


        const popupOpen = computed(() => store.state.voteTour.popupOpen);


        const closePopup = () => {
            store.commit('voteTour/SET_POPUP_OPEN', false);
            showForm.value = true;
            showThanks.value = false;
        }

        const submitForm = async () => {
            const result = await validate();

            if (!result.valid) {
                event.preventDefault();
                console.log(errors);
            } else {

                request.value = true;
                console.log(Object.assign({}, data.value))
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
            first_name: useDebounceFormDataProperty('voteTour', 'first_name'),
            last_name: useDebounceFormDataProperty('voteTour', 'last_name'),
            email: useDebounceFormDataProperty('voteTour', 'email'),
            phone: useDebounceFormDataProperty('voteTour', 'phone'),
            comment: useDebounceFormDataProperty('voteTour', 'comment'),
            popupOpen,
            closePopup,
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
