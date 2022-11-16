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
    participantPhone: order.participants ? order.participants.participant_phone || '' : '',
    data: {
        first_name: '',
        last_name: '',
        middle_name: '',
        birthday: '',
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
            console.log(participant, this.data);
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
                    participant_phone: this.participantPhone,
                }
            })
                .then(({data: response}) => {
                    this.order = response.model;
                    this.participants = response.model.participants.items;
                    this.participantPhone = response.model.participants.participant_phone;
                    toast.success(response.message);
                })
                .catch(error => {
                    console.log(error);
                })
        }

    }
});
