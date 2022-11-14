<template>
    <div class="participant">
        <span class="h4"
            >Учасник <span>{{ index + 1 }}</span
            ><i></i
        ></span>
        <div class="form">
            <form-input
                v-model="participant.last_name"
                :label="__('forms.last-name')"
                :name="'participants[' + index + '][last_name]'"
            />
            <form-input
                v-model="participant.first_name"
                label="Ім'я"
                :name="'participants[' + index + '][first_name]'"
            />
            <form-input
                v-model="participant.middle_name"
                label="По-батькові"
                :name="'participants[' + index + '][middle_name]'"
            />

            <div class="single-datepicker">
                <form-datepicker
                    v-model="participant.birthday"
                    label="Дата народження"
                    :name="'participants[' + index + '][birthday]'"
                ></form-datepicker>
            </div>
        </div>
        <div class="btn-delete" @click.stop="deleteItem()"></div>
    </div>
</template>

<script>
import FormInput from '../form/FormInput'
import FormDatepicker from '../form/FormDatepicker'
import { computed, reactive, watch } from 'vue'

export default {
    name: 'OrderParticipant',
    components: { FormDatepicker, FormInput },
    props: {
        index: Number,
        participant: Object,
    },
    emits: ['update', 'delete'],
    setup({ index, participant }, { emit }) {
        const innerValue = reactive(
            Object.assign(
                {
                    first_name: '',
                    last_name: '',
                    middle_name: '',
                    birthday: '',
                },
                participant,
            ),
        )

        watch(
            innerValue,
            _.debounce(() => {
                emit('update', { idx: index, data: Object.assign({}, innerValue) })
            }, 300),
        )

        const deleteItem = () => {
            emit('delete', index)
        }

        return {
            innerValue,
            deleteItem,
        }
    },
}
</script>

<style scoped></style>
