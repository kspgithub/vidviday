import axios from "axios";
import {Ukrainian} from "flatpickr/dist/l10n/uk";
import {swalConfirm} from "../../../utils/functions";
import {toast} from "../../../../libs/toast";

const DEFAULT_DISCOUNT = {
    id: 0,
    title: '',
    value: 0,
    places: 0,
};

export default (params) => ({
    order: params.order,
    tour: params.tour ?? null,
    formChanged: false,
    roomTypes: params.roomTypes || [],
    statuses: params.statuses,
    schedules: [],
    participantData: {
        first_name: '',
        last_name: '',
        middle_name: '',
        birthday: '',
    },
    discountIdx: null,
    discountData: {...DEFAULT_DISCOUNT},
    tourDiscounts: params.availableDiscounts || [],
    init() {
        if (this.order.tour_id > 0) {
            this.loadSchedules(false);
        }

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
                            limit: 20,
                            relations: ['discounts'],
                            attributes: ['price', 'commission'],
                        };
                    },
                }
            });
            jQuery(tourSelectBox).on('select2:select', (e) => {
                this.order.tour_id = e.params.data.id;
                this.tour = e.params.data;
                this.tourDiscounts = e.params.data.discounts || [];
                this.order.schedule_id = null;
                this.loadSchedules();
            })

            if (this.$refs.pickerInput) {
                flatpickr(this.$refs.pickerInput, {
                    locale: Ukrainian,
                    allowInput: true,
                    dateFormat: 'd.m.Y'
                });
            }


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

    loadSchedules(clear = true) {
        if (clear) {
            this.order.schedule_id = null;
        }

        axios.get(`/api/tours/${this.order.tour_id}/all-schedules`)
            .then((response) => {
                this.schedules = response.data;
            });
    },

    // PARTICIPANTS
    get isCustomerParticipant() {
        return this.order.participants && !!this.order.participants.customer;
    },
    set isCustomerParticipant(value) {
        if (!this.order.participants) {
            this.order.participants = {
                items: [],
                participant_phone: '',
                customer: value,
            }
        } else {
            this.order.participants.customer = value;
        }
    },

    get participantPhone() {
        return this.order.participants && this.order.participants.participant_phone ? this.order.participants.participant_phone : '';
    },
    set participantPhone(value) {
        this.formChanged = true;
        if (!this.order.participants) {
            this.order.participants = {
                items: [],
                participant_phone: '',
                customer: false,
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
                customer: false,
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


    // DISCOUNTS

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
            amount += (d.value * (d.places || 1)) || 0;
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
    discountChanged() {
        const id = this.discountData.id || 0;
        const existsDiscount = this.tourDiscounts.find(d => d.id === id);
        let value = 0;
        if (existsDiscount) {
            if (existsDiscount.type === 'percent' || existsDiscount.type === 1) {
                value = (this.placePrice / 100) * existsDiscount.price;
            } else {
                value = existsDiscount.price;
            }
        }

        const data = {
            title: existsDiscount ? (existsDiscount.title.uk) : '',
            value: value,
        }

        this.discountData = {...this.discountData, ...data};
    },
    saveDiscount() {
        const discounts = this.order.discounts || [];
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
    setAccommodationItem(key, value) {
        if (!this.order.accommodation) {
            this.order.accommodation = {};
        }
        this.order.accommodation[key] = parseInt(value) || 0;
    },
    async onFormChange(evt) {
        //console.log(evt);
        this.formChanged = true;
    },
    async onSubmit(evt) {
        this.formChanged = false;
    },

    get childrenDiscounts() {
        return this.tourDiscounts.filter(d => d.category.includes('children'))
    },
    // Дети до 6 бесплатно?
    get childrenYoungFree() {
        return !!this.childrenDiscounts.find(d => (d.category === 'children_young' || d.category === 'children') && d.type === 1 && d.price === 100);
    },
    // Дети до 12 бесплатно?
    get childrenOlderFree() {
        return !!this.childrenDiscounts.find(d => (d.category === 'children_older' || d.category === 'children') && d.type === 1 && d.price === 100);
    },


    get totalPlaces() {
        let total = this.order.places || 0;

        if (this.order.children) {
            total += this.order.children_young || 0;
            total += this.order.children_older || 0;
        }
        return total;
    },
    get totalPayedPlaces() {
        let total = this.order.places || 0;
        if (this.order.children && !this.childrenYoungFree) {
            total += this.order.children_young || 0;
        }
        if (this.order.children && !this.childrenOlderFree) {
            total += this.order.children_older || 0;
        }
        return total;
    },
    get selectedSchedule() {
        return this.order.schedule_id > 0 ? this.schedules.find(it => it.id === this.order.schedule_id) : null;
    },
    get placePrice() {

        return this.selectedSchedule ? this.selectedSchedule.price : (this.tour ? this.tour.price : 0);
    },
    get placeCommission() {
        return this.selectedSchedule ? this.selectedSchedule.commission : (this.tour ? this.tour.commission : 0);
    },
    get accommPrice() {

        return this.selectedSchedule ? this.selectedSchedule.accomm_price : (this.tour ? this.tour.accomm_price : 0);
    },

    get totalPrice() {
        return (this.order.price || 0) - this.discountAmount + (this.order.accomm_price || 0) - (this.order.commission || 0);
    },
    calcSum() {
        if (this.totalPayedPlaces === 0) {
            toast.warning('Введіть кількість учасників');
        }
        if (this.placePrice === 0) {
            toast.warning('Оберіть дату виїзду');
        }
        const accomm_places = this.accommodation['1o_sgl'] || 0;
        this.order.accomm_price = (accomm_places * this.accommPrice) || 0;
        this.order.price = (this.totalPayedPlaces * this.placePrice) || 0;
        if (this.order.is_tour_agent) {
            this.order.commission = (this.totalPayedPlaces * this.placeCommission) || 0;
        } else {
            this.order.commission = 0;
        }

    },
    get isReserve() {
        return !this.order.id && this.selectedSchedule && this.selectedSchedule.places_available < this.totalPayedPlaces;
    }
});