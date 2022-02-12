import axios from "axios";
import {swalConfirm} from "../../../utils/functions";
import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";

export default (params) => ({
    order: params.order,
    formChanged: false,
    roomTypes: params.roomTypes || [],
    statuses: params.statuses,
    includes: params.includes,
    participantData: {
        first_name: '',
        last_name: '',
        middle_name: '',
        birthday: '',
    },
    discountIdx: null,
    discountData: {
        title: '',
        value: 0,
    },
    init() {
        this.$watch('order', () => {
            this.formChanged = true;
        });
        setTimeout(() => {
            const tourSelectBox = document.getElementById('tourSelectBox');
            jQuery(tourSelectBox).select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: '/api/tours/select-box',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page || 1,
                            limit: 20
                        };
                    },
                }
            });
            jQuery(tourSelectBox).on('select2:select', (e) => {
                this.order.tour_id = e.params.data.id;
            })

            flatpickr(this.$refs.pickerInput, {
                locale: Ukrainian,
                allowInput: true,
                dateFormat: 'd.m.Y'
            });

            const startPicker = flatpickr(this.$refs.startDateRef, {
                locale: Ukrainian,
                dateFormat: 'd.m.Y',

            });

            const endPicker = flatpickr(this.$refs.endDateRef, {
                locale: Ukrainian,
                dateFormat: 'd.m.Y',
            });

        }, 200);

        window.addEventListener('beforeunload', async (event) => {
            //console.log(this.formChanged, event);
            if (this.formChanged) {
                // Отмените событие, как указано в стандарте.
                event.preventDefault();
                // Chrome требует установки возвратного значения.
                event.returnValue = '';
            }

        });
    },

    get participantPhone() {
        return this.order.participants ? this.order.participants.participant_phone : '';
    },
    set participantPhone(value) {
        this.formChanged = true;
        if (!this.order.participants) {
            this.order.participants = {
                items: [],
                participant_phone: '',
            }
        }
        this.order.participants.participant_phone = value;
    },
    get participants() {
        return this.order.participants ? this.order.participants.items : [];
    },
    set participants(value) {
        this.formChanged = true;
        if (!this.order.participants) {
            this.order.participants = {
                items: [],
                participant_phone: '',
            }
        }
        this.order.participants.items = value;
    },
    addParticipant() {
        if (!this.order.participants) {
            this.order.participants = {
                items: [],
                participant_phone: '',
            }
        }
        if (this.participantData.first_name) {
            this.order.participants.items.push({...this.participantData});
            this.participantData = {
                first_name: '',
                last_name: '',
                middle_name: '',
                birthday: '',
            }
        }

    },
    removeParticipant(idx) {
        swalConfirm(() => {
            this.order.participants.items.splice(idx, 1);
        });

    },
    get discounts() {
        return this.order.discounts || [];
    },
    set discounts(value) {
        this.formChanged = true;
        this.order.discounts = value;
    },
    get discountAmount() {
        let amount = 0;
        this.discounts.forEach(d => {
            amount += parseInt(d.value) || 0;
        })
        return amount;
    },
    get discountModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-discount-modal'));
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
            value: 0,
        }
    },
    saveDiscount() {
        const discounts = this.order.discounts || [];

        const data = {
            title: this.discountData.title,
            value: this.discountData.value,
        }
        if (this.discountIdx !== null) {
            discounts[this.discountIdx] = data;
        } else {
            discounts.push(data);
        }
        this.order.discounts = discounts;
        this.discountModal.hide();
    },
    deleteDiscount(idx) {
        swalConfirm(() => {
            this.order.discounts.splice(idx, 1);
        })
    },

    get totalPrice() {
        return (this.order.price || 0) - this.discountAmount + (this.order.commission || 0);
    },
    get agency() {
        return this.order.agency_data || {
            title: '',
            affiliate: '',
            manager_name: '',
            manager_phone: '',
            manager_email: '',
        }
    },
    set agency(value) {
        this.formChanged = true;
        this.order.agency_data = value;
    },

    get utmData() {
        return this.order.utm_data || {
            customer_source: '',
            customer_device: '',
        }
    },
    set utmData(value) {
        this.formChanged = true;
        this.order.utm_data = value;
    },
    get accommodation() {
        const accomm = {
            other: this.order.accommodation ? this.order.accommodation.other || 0 : 0,
            other_text: this.order.accommodation ? this.order.accommodation.other_text || '' : '',
        }
        this.roomTypes.forEach(rt => {
            accomm[rt.value] = this.order.accommodation ? this.order.accommodation[rt.value] : 0;
        })

        return accomm;
    },
    set accommodation(value) {
        this.formChanged = true;
        this.order.accommodation = value;
    },
    async onFormChange(evt) {
        console.log(evt);
        this.formChanged = true;
    },
    async onSubmit(evt) {
        this.formChanged = false;
    }
});
