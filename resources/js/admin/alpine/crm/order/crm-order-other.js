import axios from "axios";
import {toast} from "../../../../libs/toast";

export default (order) => ({
    order: order,
    comment: order.comment,
    admin_comment: order.admin_comment,
    utm_data: Object.assign({
        customer_source: '',
        customer_device: ''
    }, order.utm_data),
    get modal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-other-modal'));
    },
    edit() {
        this.modal.show();
    },
    cancel() {
        this.modal.hide();
        this.comment = this.order.comment;
        this.admin_comment = this.order.admin_comment;
        this.utm_data = Object.assign({
            customer_source: '',
            customer_device: ''
        }, this.order.utm_data);
    },
    save() {
        const data = {
            comment: this.comment,
            admin_comment: this.admin_comment,
            utm_data: {
                customer_source: this.utm_data.customer_source,
                customer_device: this.utm_data.customer_device,
            },
        }

        axios.patch(`/admin/order/${this.order.id}`, data)
            .then(({data: response}) => {
                this.order = response.model;
                this.comment = response.model.comment || '';
                this.admin_comment = response.model.admin_comment || '';
                this.utm_data = Object.assign({
                    customer_source: '',
                    customer_device: ''
                }, response.model.utm_data);

                toast.success(response.message);
            })
            .catch(error => {
                console.log(error);
            })

        this.modal.hide();
    },
});
