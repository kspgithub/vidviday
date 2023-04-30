<template>
    <div>
        <h2 class="h3 mb-30">{{ __('order-section.participants.title') }}</h2>

        <div class="mb-30">
            <form-checkbox class="small"
                           v-model="isCustomerParticipant"
                           name="is_tourist"
                           :label="__('order-section.is-tourist')"/>
        </div>

        <order-participant v-for="(participant, idx) in participants"
                           :key="'participant-'+idx"
                           :active="idx === 0"
                           :participant="participant"
                           :index="idx"
                           @update="updateParticipant"
                           @delete="deleteParticipant(idx)"
        />

        <div class="text-right text-center-xs">
            <seo-button code="order.add-participant" class="btn type-1 add-participant-btn" @click.prevent="addParticipant()">
                {{ __('order-section.participants.add') }}
            </seo-button>
        </div>

        <div v-if="isTourAgent" class="participant phone-number">
            <div class="form" style="display: block">
                <form-phone v-model="participant_phone"
                            ref="participantPhoneRef"
                            name="participant_phone"
                            :label="__('order-section.participants.phone-label')"
                            rules="required|tel"
                />
                <span class="text">{{ __('order-section.participants.phone-description') }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import OrderParticipant from './OrderParticipant'
import FormInput from '../form/FormInput'
import { useStore } from 'vuex'
import { useDebounceFormDataProperty, useFormDataProperty } from '../../store/composables/useFormData'
import { computed, getCurrentInstance, onMounted, ref, watch } from 'vue'
import FormCheckbox from '../form/FormCheckbox'
import FormPhone from '../form/FormPhone'
import SeoButton from '../common/SeoButton.vue'

export default {
    name: 'OrderTourParticipants',
    components: {SeoButton, FormPhone, FormCheckbox, FormInput, OrderParticipant},
    setup() {
        const store = useStore()
        const isCustomerParticipant = useFormDataProperty('orderTour', 'isCustomerParticipant')
        const formData = computed(() => store.state.orderTour.formData)
        const participants = computed(() => store.state.orderTour.formData.participants)
        const participant_phone = useDebounceFormDataProperty('orderTour', 'participant_phone')

        const vm = getCurrentInstance()

        // let form = vm.ctx.$.provides[Object.getOwnPropertySymbols(vm.ctx.$.provides)[1]]

        const updateParticipant = (data) => {
            store.dispatch('orderTour/updateParticipant', data)
        }

        const prependParticipant = (data) => {
            store.dispatch('orderTour/prependParticipant', data)
        }

        const deleteParticipant = (idx) => {
            store.dispatch('orderTour/deleteParticipant', idx)
        }

        const addParticipant = () => {
            store.dispatch('orderTour/addParticipant')
        }

        const updateParticipantPhone = () => {
            store.dispatch('orderTour/updateParticipantPhone').then(() => {
                formData.value.participant_phone = store.state.orderTour.formData.phone
            })
        }

        watch(isCustomerParticipant, (val) => {
            if (val) {
                updateParticipant({
                    idx: 0, data: {
                        first_name: formData.value.first_name,
                        last_name: formData.value.last_name,
                        middle_name: '',
                        birthday: '',
                    },
                })

                // form.values.participants[0]['[first_name]'] = store.state.orderTour.formData.first_name
                // form.values.participants[0]['[last_name]'] = store.state.orderTour.formData.last_name
                if (participantPhoneRef.value) {
                    const countryDialCode = participantPhoneRef.value.intl.getSelectedCountryData().dialCode

                    if (participant_phone.value.replaceAll(/\D+/g, '') === countryDialCode && !participant_phone._dirty) {
                        updateParticipantPhone()
                    }
                }
            } else {
                updateParticipant({
                    idx: 0, data: {
                        first_name: '',
                        last_name: '',
                        middle_name: '',
                        birthday: '',
                    },
                })
            }
        })

        onMounted(() => {
            if (participantPhoneRef.value) {

                const countryDialCode = participantPhoneRef.value.intl.getSelectedCountryData().dialCode

                if (participant_phone.value.replaceAll(/\D+/g, '') === countryDialCode) {
                    updateParticipantPhone()
                }
            }
        })

        const isTourAgent = computed(() => store.getters['user/isTourAgent'])

        const participantPhoneRef = ref()

        return {
            isCustomerParticipant,
            participants,
            participant_phone,
            updateParticipant,
            deleteParticipant,
            addParticipant,
            isTourAgent,
            participantPhoneRef,
        }
    },
}
</script>

<style scoped>

</style>
