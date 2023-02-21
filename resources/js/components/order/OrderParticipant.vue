<template>
    <div class="participant">
        <span class="h4" :class="{active: isActive}" @click.prevent="isActive = !isActive">Учасник <span>{{ index + 1 }}</span><i></i></span>
        <div class="form" :class="{active: isActive}">
            <form-input :label="__('forms.last-name')" v-model="participant.last_name"
                        :name="'participants['+index+'][last_name]'"/>
            <form-input label="Ім'я" v-model="participant.first_name" :name="'participants['+index+'][first_name]'"/>
            <form-input label="По-батькові" v-model="participant.middle_name"
                        :name="'participants['+index+'][middle_name]'"/>


            <div class="single-datepicker">
                <form-datepicker label="Дата народження" v-model="participant.birthday"
                                 :name="'participants['+index+'][birthday]'"></form-datepicker>
            </div>
        </div>
        <div class="btn-delete" @click.stop="deleteItem()"></div>
    </div>
</template>

<script>
import FormInput from "../form/FormInput";
import FormDatepicker from "../form/FormDatepicker";
import { computed, reactive, ref, watch } from 'vue'

export default {
    name: "OrderParticipant",
    components: {FormDatepicker, FormInput},
    props: {
        index: Number,
        participant: Object,
        active: Object,
    },
    emits: ['update', 'delete'],
    setup({index, participant, active}, {emit}) {


        const innerValue = reactive(Object.assign({
            first_name: '',
            last_name: '',
            middle_name: '',
            birthday: '',
        }, participant));

        watch(innerValue, _.debounce(() => {
            emit('update', {idx: index, data: Object.assign({}, innerValue)});
        }, 300));

        const deleteItem = () => {
            emit('delete', index);
        }

        const isActive = ref(active)

        return {
            innerValue,
            deleteItem,
            isActive,
        }
    }
}
</script>

<style scoped>

</style>
