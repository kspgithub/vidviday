import axios from "axios";
import {toast} from "../../libs/toast";

const defaultAgency = {
    title: '',
    affiliate: '',
    manager_name: '',
    manager_phone: '',
    manager_email: '',
}

export default (order) => ({
    order: order,
    agency: Object.assign({}, defaultAgency, order.agency_data || {}),
    get modal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-agency-modal'));
    },
    edit() {
        this.agency = Object.assign({}, defaultAgency, this.order.agency_data || {});
        this.modal.show();
    },
    cancel() {
        this.modal.hide();
        this.agency = Object.assign({}, defaultAgency, this.order.agency_data || {});
    },
    save() {
        axios.patch(`/admin/order/${this.order.id}`, {
            agency_data: {
                title: this.agency.title,
                affiliate: this.agency.affiliate,
                manager_name: this.agency.manager_name,
                manager_phone: this.agency.manager_phone,
                manager_email: this.agency.manager_email,
            }
        })
            .then(({data: response}) => {
                this.order = response.model;
                this.agency = Object.assign({}, defaultAgency, response.model.agency_data || {});
                this.modal.hide();
                toast.success(response.message);
            })
            .catch(error => {
                console.log(error);
            })
    }
});
