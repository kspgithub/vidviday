<template>
    <div class="participant">
        <span class="h4">Учасник <span>{{ index + 1 }}</span><i></i></span>
        <div class="form">
            <form-input label="Прізвище" v-model="innerValue.last_name" :name="'participants['+index+'][last_name]'"/>
            <form-input label="Ім'я" v-model="innerValue.first_name" :name="'participants['+index+'][first_name]'"/>
            <form-input label="По-батькові" v-model="innerValue.middle_name"
                        :name="'participants['+index+'][middle_name]'"/>


            <div class="single-datepicker">
                <form-datepicker label="Дата народження" v-model="innerValue.birthday"
                                 :name="'participants['+index+'][birthday]'"></form-datepicker>
            </div>
        </div>
        <div class="btn-delete" @click.stop="deleteItem()"></div>
    </div>
</template>

<script>
import FormInput from "../form/FormInput";
import FormDatepicker from "../form/FormDatepicker";
import {reactive, watch} from "vue";

export default {
    name: "OrderParticipant",
    components: {FormDatepicker, FormInput},
    props: {
        index: Number,
        participant: Object
    },
    emits: ['update', 'delete'],
    setup(props, {emit}) {
        const innerValue = reactive(Object.assign({
            first_name: '',
            last_name: '',
            middle_name: '',
            birthday: '',
        }, props.participant));

        watch(innerValue, _.debounce(() => {
            emit('update', {idx: props.index, data: Object.assign({}, innerValue)});
        }, 300));

        const deleteItem = () => {
            emit('delete', props.index);
        }

        return {
            innerValue,
            deleteItem
        }
    }
}
</script>

<style scoped>

</style>
