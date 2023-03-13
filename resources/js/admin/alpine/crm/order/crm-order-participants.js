import axios from "axios";
import {toast} from "../../../../libs/toast";

const DEFAULT_PARTICIPANT = {
    first_name: '',
    last_name: '',
    middle_name: '',
    birthday: '',
}
export default (order) => ({
    order: order,
    editIndex: null,
    participants: order.participants ? order.participants.items || [] : [],
    participant_contacts: order.participant_contacts ? order.participant_contacts || [] : [],
    data: {
        first_name: '',
        last_name: '',
        middle_name: '',
        birthday: '',
    },
    data_contacts:{
        phone: '',
        comment:'',
    },
    get modal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-participant-modal'));
    },
    participantFio(participant) {
        return (participant.last_name + ' ' + participant.first_name + ' ' + participant.middle_name)
            .replaceAll('null', '').trim();
    },
    editParticipant(idx = null) {

        if (idx !== null) {
            const participant = this.participants[idx];
            this.data = {
                first_name: participant.first_name || '',
                last_name: participant.last_name || '',
                middle_name: participant.middle_name || '',
                birthday: participant.birthday || '',
            }
        } else {
            this.data = Object.assign({}, DEFAULT_PARTICIPANT);
        }

        this.editIndex = idx;
        this.modal.show();
    },
    cancelEdit() {
        this.modal.hide();
        this.editIndex = null;
        this.data = Object.assign({}, DEFAULT_PARTICIPANT);
    },
    saveParticipant() {
        if (this.editIndex !== null) {
            this.participants[this.editIndex] = {
                first_name: this.data.first_name,
                last_name: this.data.last_name,
                middle_name: this.data.middle_name,
                birthday: this.data.birthday,
            }
        } else {
            this.participants.push({
                first_name: this.data.first_name,
                last_name: this.data.last_name,
                middle_name: this.data.middle_name,
                birthday: this.data.birthday,
            });
        }
        this.updateOrder();
        this.modal.hide();
    },
    deleteParticipant(idx) {
        this.participants.splice(idx, 1);
        this.updateOrder();
    },
    updateOrder() {
        if (this.order.id > 0) {
            axios.patch(`/admin/order/${this.order.id}`, {
                participants: {
                    items: this.participants,
                },
                participant_contacts: this.participant_contacts,
            })
                .then(({data: response}) => {
                    this.order = response.model;
                    this.participants = response.model.participants.items;
                    this.participant_contacts = response.model.participant_contacts;
                    toast.success(response.message);
                })
                .catch(error => {
                    console.log(error);
                })
        }

    }
});
