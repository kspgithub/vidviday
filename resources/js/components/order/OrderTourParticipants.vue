<template>
    <div>
        <h2 class="h3 mb-30">Учасники туру</h2>

        <order-participant v-for="(participant, idx) in participants"
                           :key="'participant-'+idx"
                           :participant="participant"
                           :index="idx"
                           @update="updateParticipant"
                           @delete="deleteParticipant(idx)"
        />

        <div class="text-right text-center-xs">
            <button class="btn type-1 add-participant-btn" @click.prevent="addParticipant()">
                Додати учасника
            </button>
        </div>

        <div class="participant phone-number">
            <span class="h4"></span>
            <div class="form">
                <form-input v-model="participant_phone"
                            name="participant_phone"
                            label="Телефон одного із учасників туру"
                            rules="required|tel"
                />
                <span class="text">Це потрібно для СМС-розсилки з контактами гіда та місцем виїзду і, за потреби, для зв’язку з туристом під час туру</span>
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
