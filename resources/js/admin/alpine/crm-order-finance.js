import axios from "axios";
import {toast} from "../../libs/toast";
import {swalConfirm} from "../utils/functions";

const defaultAgency = {}

export default (order) => ({
    order: order,

    // ORDER PRICE
    orderPrice: order.price || 0,
    editSumMode: false,
    editSum() {
        this.orderPrice = this.order.price;
        this.editSumMode = true;
    },
    saveSum() {
        this.editSumMode = false;
        this.updateOrder({
            price: this.orderPrice,
        })
    },
    cancelSum() {
        this.editComMode = false;
        this.orderCommission = this.order.commission;
    },

    // ORDER COMMISSION
    orderCommission: order.commission || 0,
    editComMode: false,
    editCom() {
        this.orderCommission = this.order.commission;
        this.editComMode = true;
    },
    saveCom() {
        this.editComMode = false;
        this.updateOrder({
            commission: this.orderCommission || 0,
        })
    },
    cancelCom() {
        this.editSumMode = false;
        this.orderPrice = this.order.price;
    },

    // ORDER DISCOUNT
    discounts: order.discounts || [],
    // DISCOUNTS
    discountIdx: null,
    discountData: {
        title: '',
        value: '',
    },
    get discountModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-discount-modal'));
    },

    get totalDiscount() {
        let total = 0;
        this.discounts.forEach(item => {
            total += parseInt(item.value) || 0;
        })
        return total;
    },
    editDiscount(idx = null) {
        this.discountIdx = idx;
        if (idx !== null) {
            this.discountData = {
                title: this.discounts[idx].title,
                value: this.discounts[idx].value,
            }
        } else {
            this.discountData = {
                title: '',
                value: '',
            }
        }
        this.discountModal.show();
    },
    cancelDiscount() {
        this.discountModal.hide();
        this.discountIdx = null;
        this.discountData = {
            title: '',
            value: '',
        }
    },
    saveDiscount() {
        const data = {
            title: this.discountData.title,
            value: this.discountData.value,
        }
        if (this.discountIdx !== null) {
            this.discounts[this.discountIdx] = data;
        } else {
            this.discounts.push(data);
        }
        this.updateOrder({
            discount: this.totalDiscount,
            discounts: [...this.discounts]
        })
        this.discountModal.hide();
    },
    deleteDiscount(idx) {
        swalConfirm(() => {
            this.discounts.splice(idx, 1);
            this.updateOrder({
                discount: this.totalDiscount,
                discounts: [...this.discounts]
            })
        })
    },

    // ORDER PAYMENTS
    payments: order.payment_data || [],
    paymentIdx: null,
    paymentData: {
        sum: null,
        type: '',
        recipient: '',
        comment: '',
    },
    get paymentModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-payment-modal'));
    },

    editPayment(idx = null) {
        this.paymentIdx = idx;
        if (idx !== null) {
            this.paymentData = {
                sum: this.payments[idx].sum || null,
                date: this.payments[idx].date || '',
                type: this.payments[idx].type || '',
                recipient: this.payments[idx].recipient || '',
                comment: this.payments[idx].comment || '',
            }
        } else {
            this.paymentData = {
                sum: null,
                date: '',
                type: '',
                recipient: '',
                comment: '',
            }
        }
        this.paymentModal.show();
    },

    cancelPayment() {
        this.paymentModal.hide();
        this.paymentIdx = null;
        this.paymentData = {
            sum: null,
            type: '',
            date: '',
            recipient: '',
            comment: '',
        }
    },

    savePayment() {
        const data = {
            sum: this.paymentData.sum || null,
            date: this.paymentData.date || '',
            type: this.paymentData.type || '',
            recipient: this.paymentData.recipient || '',
            comment: this.paymentData.comment || '',
        }
        if (this.paymentIdx !== null) {
            this.payments[this.paymentIdx] = data;
        } else {
            this.payments.push(data);
        }
        this.updateOrder({
            payment_data: [...this.payments]
        })
        this.paymentModal.hide();
    },
    deletePayment(idx) {
        swalConfirm(() => {
            this.payments.splice(idx, 1);
            this.updateOrder({
                payment_data: [...this.payments]
            })
        })
    },
    get totalPayed() {
        let total = 0;
        this.payments.forEach(item => {
            total += item.sum;
        })
        return total;
    },


    // COMMON
    get totalPrice() {
        return this.orderPrice + this.orderCommission - this.totalDiscount;
    },
    get pickUpPayment() {
        return this.totalPrice - this.totalPayed;
    },


    updateOrder(params) {
        axios.patch(`/admin/order/${this.order.id}`, params)
            .then(({data: response}) => {
                this.order = response.model;
                this.payments = response.model.payment_data || [];
                this.discounts = response.model.discounts || [];
                this.orderPrice = response.model.price || 0;
                this.orderCommission = response.model.commission || 0;
                toast.success(response.message);
            })
            .catch(error => {
                console.log(error);
            })
    }
});
