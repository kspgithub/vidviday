<template>
    <div>
        <h2 class="h3 mb-30">{{ __('order-section.participants.title') }}</h2>

        <order-participant v-for="(participant, idx) in participants"
                           :key="'participant-'+idx"
                           :participant="participant"
                           :index="idx"
                           @update="updateParticipant"
                           @delete="deleteParticipant(idx)"
        />

        <div class="text-right text-center-xs">
            <button class="btn type-1 add-participant-btn" @click.prevent="addParticipant()">
                {{ __('order-section.participants.add') }}
            </button>
        </div>

        <div class="participant phone-number">
            <span class="h4"></span>
            <div class="form">
                <form-input v-model="participant_phone"
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
import OrderParticipant from "./OrderParticipant";
import FormInput from "../form/FormInput";
import {useStore} from "vuex";
import {useDebounceFormDataProperty} from "../../store/composables/useFormData";
import {computed} from "vue";

export default {
    name: "OrderTourParticipants",
    components: {FormInput, OrderParticipant},
    setup() {
        const store = useStore();
        const participants = computed(() => store.state.orderTour.formData.participants);
        const participant_phone = useDebounceFormDataProperty('orderTour', 'participant_phone');

        const updateParticipant = (data) => {
            store.dispatch('orderTour/updateParticipant', data);
        }

        const deleteParticipant = (idx) => {
            store.dispatch('orderTour/deleteParticipant', idx);
        }

        const addParticipant = () => {
            store.dispatch('orderTour/addParticipant');
        }

        return {
            participants,
            participant_phone,
            updateParticipant,
            deleteParticipant,
            addParticipant,
        }
    }
}
</script>

<style scoped>

</style>
