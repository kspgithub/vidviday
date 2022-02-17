import axios from "axios";
import {toast} from "../../../../libs/toast";
import {swalConfirm} from "../../../utils/functions";

const defaultAgency = {}

const DEFAULT_DISCOUNT = {
    id: 0,
    title: '',
    value: 0,
    places: 0,
};

export default (props) => ({
    order: props.order,

    // ORDER PRICE
    orderPrice: props.order.price || 0,
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
    orderCommission: props.order.commission || 0,
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
        this.editComMode = false;
        this.orderPrice = this.order.price;
    },

    // ACCOMMODATION
    orderAccomm: props.order.accomm_price || 0,
    editAccommMode: false,
    editAccomm() {
        this.orderAccomm = this.order.accomm_price;
        this.editAccommMode = true;
    },
    saveAccomm() {
        this.editAccommMode = false;
        this.updateOrder({
            accomm_price: this.orderAccomm || 0,
        })
    },
    cancelAccomm() {
        this.editAccommMode = false;
        this.orderAccomm = this.order.accomm_price;
    },


    // DISCOUNTS
    tourDiscounts: props.discounts || [],
    discounts: props.order.discounts || [],
    discountIdx: null,
    discountData: {...DEFAULT_DISCOUNT},
    get discountModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-discount-modal'));
    },

    get totalDiscount() {
        let total = 0;
        this.discounts.forEach(item => {
            total += item.value * (item.places || 1);
        })
        return total;
    },
    editDiscount(idx = null) {
        this.discountIdx = idx;
        if (idx !== null) {
            this.discountData = {
                id: this.discounts[idx].id || 0,
                title: this.discounts[idx].title,
                value: this.discounts[idx].value,
                places: this.discounts[idx].places || 1,
            }
        } else {
            this.discountData = {...DEFAULT_DISCOUNT}
        }
        this.discountModal.show();
    },
    cancelDiscount() {
        this.discountModal.hide();
        this.discountIdx = null;
        this.discountData = {...DEFAULT_DISCOUNT}
    },
    saveDiscount() {
        const id = this.discountData.id || 0;
        const existsDiscount = this.tourDiscounts.find(d => d.id === id)
        const title = existsDiscount ? (existsDiscount.title.uk) : this.discountData.title;
        const places = this.discountData.places || 1;
        let value = this.discountData.value;

        if (existsDiscount) {
            if (existsDiscount.type === 'percent' || existsDiscount.type === 1) {
                value = (this.placePrice / 100) * existsDiscount.price;
            } else {
                value = existsDiscount.price;
            }
        }

        const data = {
            id: id,
            title: title,
            value: value,
            places: places,
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
    payments: props.order.payment_data || [],
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
        return this.orderPrice - this.orderCommission - this.totalDiscount + this.orderAccomm;
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
                this.orderAccomm = response.model.accomm_price || 0;
                toast.success(response.message);
            })
            .catch(error => {
                console.log(error);
            })
    }
});
