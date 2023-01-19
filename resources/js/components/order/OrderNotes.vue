<template>
    <div class="additional-block py-20">
        <div v-for="note in innerNotes" class="order-note">
            <div class="text">{{ formatDate(note.created_at) }}</div>
            <more-text :key="'note-'+note.id" :min-height="90" text-size="text-normal">
                {{ note.text }}
            </more-text>
        </div>
        <div class="add-note pb-0">
            <transition name="fade">
                <form @submit.prevent="onSubmit()" method="POST" :action="action" class="add-note-toggle d-block"
                      v-if="showForm">
                    <div class="add-note-input">
                        <form-textarea v-model="text" :id="'note-text-'+order.id"
                                       :label="__('order-section.notes.label')"
                                       rows="3" name="text"/>
                    </div>
                    <div class="add-note-btns">
                        <button id="b16" class="btn type-2" type="submit" :disabled="!text || request">
                            {{ __('forms.send') }}
                        </button>
                        <a class="text-sm add-note-btn-cancel" @click.prevent="showForm = false">
                            <b class="text-bold">{{ __('forms.cancel-alt') }}</b>
                        </a>
                    </div>
                </form>
            </transition>
            <transition name="fade">
                <a @click.prevent="showForm = true" class="add-note-btn text text-sm" v-if="!showForm">
                    <b class="text-bold">{{ __('order-section.notes.add-note') }}</b>
                </a>
            </transition>
        </div>

    </div>
</template>

<script>
import ShowMoreText from "../common/ShowMoreText";
import FormTextarea from "../form/FormTextarea";
import {ref} from "vue";
import SlideUpDown from "../common/SlideUpDown";
import axios from "axios";
import moment from "moment";
import MoreText from "../common/MoreText";

export default {
    name: "OrderNotes",
    components: {MoreText, SlideUpDown, FormTextarea, ShowMoreText},
    props: {
        action: String,
        order: Object,
        notes: Array,
    },
    setup(props) {
        const text = ref('');
        const request = ref(false);
        const showForm = ref(false);
        const innerNotes = ref(props.notes || []);

        const onSubmit = async () => {
            request.value = true;
            const {data: response} = await axios.post('/profile/orders/add-note', {
                text: text.value,
                order_id: props.order.id
            })
            if (response.result === 'success') {
                innerNotes.value = [response.note, ...innerNotes.value];
            }
            showForm.value = false;
            request.value = false;
        }

        const formatDate = (date) => {
            return date ? moment(date).format('d.m.Y') : '';
        }

        return {
            text,
            showForm,
            innerNotes,
            onSubmit,
            formatDate,
            request,
        }
    }
}
</script>

<style scoped>

</style>
