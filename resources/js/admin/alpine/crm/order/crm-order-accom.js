import axios from "axios";
import {toast} from "../../../../libs/toast";

export default (params) => ({
    order: params.order,
    tour: params.tour ?? null,
    formChanged: false,
    roomTypes: params.roomTypes || [],
    editableIds: [],
    accommodationsForm: {
        other: params.order.accommodation ? params.order.accommodation['other'] || '' : '',
        other_text: params.order.accommodation ? params.order.accommodation['other_text'] || '' : '',
        ...params.roomTypes.reduce((rt, res) => {res[rt.value] = params.order.accommodation ? params.order.accommodation[rt.value] || '' : ''; return res}, {})
    },
    isEditable(id){
        // console.log(id)
        return this.editableIds.indexOf(id) > -1
    },
    editAccomm(id) {
        if (!this.isEditable(id)) {
            this.editableIds.push(id)
            this.accommodationsForm[id] = this.order.accommodation ? this.order.accommodation[id] || '' : ''
        }
    },
    saveAccomm(id) {
        // console.log('saveAccomm', id)
        this.updateAccomm(id, this.accommodationsForm[id]).then(() => {
            if (this.isEditable(id)) {
                this.editableIds.splice(this.editableIds.indexOf(id));
            }
        })
    },
    cancelAccomm(id) {
        // console.log('cancelAccomm', id)
        if (this.isEditable(id)) {
            this.editableIds.splice(this.editableIds.indexOf(id));
        }
        this.accommodationsForm[id] = this.order.accommodation[id];
    },

    updateAccomm(id, value) {
        return axios.patch(`/admin/order/${this.order.id}/accomm`, {id,value})
            .then(({data: response}) => {
                this.order = response.model;
                this.accommodationsForm.other = this.order.accommodation ? this.order.accommodation.other || '' : ''
                this.accommodationsForm.other_text = this.order.accommodation ? this.order.accommodation.other_text || '' : ''
                for(let rt of this.roomTypes) {
                    this.accommodationsForm[rt.value] = this.order.accommodation ? this.order.accommodation[rt.value] || '' : '';
                }
                toast.success(response.message);
            })
            .catch(error => {
                console.log(error);
            })
    }
});
