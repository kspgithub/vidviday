import axios from "axios";
import {swalConfirm} from "../../../utils/functions";
import {toast} from "../../../../libs/toast";
import validateForm from "../../composables/validate-form";

const DEFAULT_DISCOUNT = {
    id: 0,
    title: '',
    value: 0,
    places: 0,
};

export default (params) => ({
    order: {
        ...params.order,
        participants: {
            items: params.order?.participants?.items || [],
            customer: params.order?.participants?.customer || false,
        },
        participant_contacts: params.order?.participant_contacts || [],
    },
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
    participant_contactsData: {
        phone: '',
        comment: '',
    },
    discountIdx: null,
    discountData: {...DEFAULT_DISCOUNT},
    tourDiscounts: params.availableDiscounts || [],
    fillForm() {
        let vm = this
        this.order.first_name = 'Test'
        this.order.last_name = 'Test'
        this.order.middle_name = 'Test'
        this.order.phone = '+38 (333) 333-33-33'

        const tourSelectBox = document.getElementById('tourSelectBox');
        $(tourSelectBox).select2('open')
        setTimeout(() => {
            $('#select2-tourSelectBox-results > *').first().mouseup()
            setTimeout(function() {
                vm.order.schedule_id = vm.schedules[0].id
                vm.calcSum()
            }, 500)
        }, 500)

        this.order.places = 1
        this.isCustomerParticipant = true
    },
    init() {
        //Set default status
        if (!this.order.status) {
            this.order.status = 'booked'
        }
        if (this.order.tour_id > 0) {
            this.loadSchedules(false);
        }

        this.$watch('participantData', (data) => {
            if(data.first_name)
                this.participantData.first_name = data.first_name.ucWords()

            if(data.last_name)
                this.participantData.last_name = data.last_name.ucWords()

            if(data.middle_name)
                this.participantData.middle_name = data.middle_name.ucWords()
        })

        this.$watch('participant_contactsData', (data) => {
            if(data.phone)
                this.participant_contactsData.phone = data.phone.ucWords()

            if(data.comment)
                this.participant_contactsData.comment = data.comment.ucWords()
        })

        this.$watch('order', (order) => {
            this.formChanged = true;

            if(order.first_name)
                this.order.first_name = order.first_name.ucWords()

            if(order.last_name)
                this.order.last_name = order.last_name.ucWords()

            if(order.middle_name)
                this.order.middle_name = order.middle_name.ucWords()

            if(!order.participants) {
                order.participants = {
                    items: [],
                    customer: false,
                }
            }

            if(!order.participant_contacts) {
                order.participant_contacts = [];
            }

            for (let i in order.participants.items) {
                if(order.participants.items[i].first_name)
                    this.order.participants.items[i].first_name = order.participants.items[i].first_name.ucWords()
                if(order.participants.items[i].last_name)
                    this.order.participants.items[i].last_name = order.participants.items[i].last_name.ucWords()
                if(order.participants.items[i].middle_name)
                    this.order.participants.items[i].middle_name = order.participants.items[i].middle_name.ucWords()
            }

            for (let i in order.participant_contacts) {
                if(order.participant_contacts[i].phone)
                    this.order.participant_contacts[i].phone = order.participant_contacts[i].phone.ucWords()
                if(order.participant_contacts[i].comment)
                    this.order.participant_contacts[i].comment = order.participant_contacts[i].comment.ucWords()
            }

            order.is_customer = !order.is_tour_agent
            order.is_tour_agent = !order.is_customer
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
        return !!this.order.participants.customer;
    },
    set isCustomerParticipant(value) {
        if(value) {
            this.order.participants.items.unshift({
                first_name: this.order.first_name || '',
                last_name: this.order.last_name || '',
                middle_name: this.order.middle_name || '',
                birthday: this.order.birthday || '',
            })
            this.order.participant_contacts.push({
                phone: this.order.phone,
                comment: 'Замовник',
            })
        } else {
            this.order.participants.items.shift()
        }
        this.order.participants.customer = value
    },
    get participant_contacts() {
        return this.order.participant_contacts ? this.order.participant_contacts : [];
    },
    set participant_contacts(value) {
        this.formChanged = true;
        this.order.participant_contacts = value;
    },
    addParticipantContact() {
        if (this.participant_contactsData.phone) {
            this.order.participant_contacts.push({...this.participant_contactsData});
            this.participant_contactsData = {
                phone: '',
                comment: '',
            }
        }

    },
    removeParticipantContact(idx) {
        swalConfirm(() => {
            this.order.participant_contacts.splice(idx, 1);
        });

    },
    get participants() {
        return this.order.participants ? this.order.participants.items : [];
    },
    set participants(value) {
        this.formChanged = true;
        this.order.participants.items = value;
    },
    addParticipant() {
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
            title: existsDiscount ? (existsDiscount.admin_title || existsDiscount.title.uk || existsDiscount.title) : '',
            value: value,
        }

        this.discountData = {...this.discountData, ...data};
    },
    saveDiscount() {
        const discounts = this.order.discounts || [];
        const id = this.discountData.id || 0;
        const existsDiscount = this.tourDiscounts.find(d => d.id === id)
        const title = existsDiscount ? (existsDiscount.admin_title || existsDiscount.title.uk || existsDiscount.title) : this.discountData.title;
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
    async onFormChange() {
        //console.log(evt);
        this.formChanged = true;
    },
    async onSubmit() {
        if (validateForm(this.$refs.form)) {
            this.formChanged = false;
            this.$refs.form.submit();
        }
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
