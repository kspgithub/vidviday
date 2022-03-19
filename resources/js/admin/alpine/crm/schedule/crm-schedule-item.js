import {toast} from "../../../../libs/toast";
import moment from "moment";
import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";
import handleError from "../../composables/handle-error";
import loadItems from "../../composables/load-items";
import roomTitle from "../../composables/room-title";
import updateItem from "../../composables/update-item";
import rangePlugin from "flatpickr/dist/plugins/rangePlugin";
import {cleanPhoneNumber} from "../../../../utils/string";

const rooms = {
    "1o-plus": 0,
    "1o-sgl": 0,
    "2o-twn": 0,
    "2p-dbl": 0,
    "3o-trpl": 0,
    "2p-1o-trpl": 0,
    "4o-qdpl": 0,
    "2p-2p-qdpl": 0,
    "other": false,
    "other-text": '',
}


export default (options) => ({
    edit: false,
    loader: false,
    schedule: options.schedule,
    orders: options.orders || [],
    statuses: options.statuses || [],
    roomTypes: options.roomTypes || [],
    currentTab: options.params.tab || 'common',
    sort: options.params.order || 'id:asc',
    countOrders: options.countOrders,
    accommodation: {...rooms},
    participants: {
        items: [],
        participant_phone: '',
    },
    participantData: {
        first_name: '',
        last_name: '',
        middle_name: '',
        birthday: '',
    },
    agencyData: {
        title: '',
        affiliate: '',
        manager_name: '',
        manager_email: '',
        manager_phone: ''
    },
    selectedOrder: {
        id: null,
        status: 'new',
        first_name: '',
        last_name: '',
        phone: '',
        email: '',
    },
    scheduleData: {...options.schedule},
    init() {
        setTimeout(() => {
            if (this.$refs.pickerInput) {
                flatpickr(this.$refs.pickerInput, {
                    locale: Ukrainian,
                    allowInput: true,
                    dateFormat: 'd.m.Y'
                });
            }
            flatpickr(this.$refs.startDateRef, {
                locale: Ukrainian,
                allowInput: true,
                dateFormat: 'd.m.Y',
                plugins: [new rangePlugin({input: this.$refs.endDateRef})],
                onChange: (selectedDates, dateStr, instance) => {
                    const start_date = selectedDates[0] ? moment(selectedDates[0]).format('DD.MM.YYYY') : null;
                    const end_date = selectedDates[1] ? moment(selectedDates[1]).format('DD.MM.YYYY') : null;
                    console.log(start_date, end_date);
                    this.scheduleData = {...this.scheduleData, start_date: start_date, end_date: end_date};
                }
            });


        }, 500);
        this.loadOrders(false);
    },
    setTab(tab) {
        this.currentTab = tab;
        this.loadOrders();
    },
    loadOrders(updateUrl = true) {
        this.loader = true;

        loadItems({
            url: '',
            params: {
                tab: this.currentTab,
                order: this.sort,
            },
            updateUrl: updateUrl,
            defaultParams: {
                tab: 'common',
                order: 'id:asc'
            },
            onSuccess: (data) => {
                this.orders = data.orders;
                this.countOrders = data.countOrders;
                this.loader = false;
            },
            onError: (error) => {
                handleError(error);
                this.loader = false;
            },
        });

    },
    statusText(value) {
        const status = this.statuses.find(s => s.value === value);
        return status ? status.text : value;
    },
    formatDate(value) {
        return moment(value).format('DD.MM.YYYY')
    },
    roomTitle(key) {
        return roomTitle(key, this.roomTypes);
    },
    paymentGet(order) {
        return order.total_price - order.payment_fop - order.payment_tov - order.payment_office;
    },
    updateOrder(id, params) {
        updateItem({
            url: `/admin/order/${id}`,
            params: params,
            onSuccess: (response) => {
                if (params.status) {
                    this.loadOrders(false);
                } else {
                    const idx = this.orders.findIndex(o => o.id === id);
                    this.orders[idx] = response.model;
                }
            },
            onError: () => {
                this.loadOrders(false);
            }
        })
    },
    get scheduleModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('editScheduleModal'));
    },
    editSchedule() {
        this.scheduleData = {...this.schedule};
        this.scheduleModal.show();
    },
    cancelSchedule() {
        this.scheduleModal.hide();
    },
    saveSchedule() {
        const params = {...this.scheduleData};
        this.updateSchedule(params, (response) => {
            this.scheduleModal.hide();
        })
    },
    updateSchedule(params = {}, callback = null) {
        this.loader = true;
        updateItem({
            url: `/admin/crm/schedules/${this.schedule.id}`,
            params: params,
            onSuccess: (response) => {
                if (callback) {
                    callback(response);
                }
                this.schedule = response.schedule;
                toast.success(response.message);
                this.loader = false;
            },
            onError: () => {
                this.loader = false;
            }
        })
    },

    togglePublished() {
        this.updateSchedule({
            published: this.schedule.published
        }, () => {
            if (this.schedule.published) {
                toast.success('Виїзд опубліковано');
            } else {
                toast.success('Виїзд скасовано');
            }
        })
    },
    setSorting(sorting) {
        this.sort = sorting;
        this.loadOrders(true);
    },
    editOrder(order) {
        this.selectedOrder = {
            id: order.id,
            first_name: order.first_name || '',
            last_name: order.last_name || '',
            middle_name: order.middle_name || '',
            birthday: order.birthday || '',
            phone: order.phone || '',
            email: order.email || '',
            viber: order.viber || '',
        };

        const accomm = {}
        if (order.accommodation) {

            for (let key in order.accommodation) {
                const val = order.accommodation[key];
                const normalKey = key.trim().replaceAll('-', '_').replaceAll(' ', '_');
                accomm[normalKey] = key === 'other' ? !!val : val;
            }
        }
        this.accommodation = {...rooms, ...accomm};

        this.agencyData = {
            title: order.agency_data && order.agency_data.title ? order.agency_data.title : '',
            affiliate: order.agency_data && order.agency_data.affiliate ? order.agency_data.affiliate : '',
            manager_name: order.agency_data && order.agency_data.manager_name ? order.agency_data.manager_name : '',
            manager_email: order.agency_data && order.agency_data.manager_email ? order.agency_data.manager_email : '',
            manager_phone: order.agency_data && order.agency_data.manager_phone ? order.agency_data.manager_phone : '',
        }
        this.edit = true;
    },
    cancelEdit() {
        this.edit = false;
    },
    saveOrder() {
        this.edit = false;
        const params = {
            ...this.selectedOrder,
            accommodation: {...this.accommodation},
            agency_data: {...this.agencyData}
        };
        //console.log(params)
        this.updateOrder(this.selectedOrder.id, params);
    },

    get participantsModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('editParticipantsModal'));
    },
    get isCustomerParticipant() {
        return this.participants && !!this.participants.customer;
    },
    set isCustomerParticipant(value) {
        if (!this.participants) {
            this.participants = {
                items: [],
                participant_phone: '',
                customer: value,
            }
        } else {
            this.participants.customer = value;
        }
    },
    participantNames(order) {
        const items = [];
        if (order.participants && order.participants.items) {
            order.participants.items.forEach(p => {
                let item = `${p.last_name || ''} ${p.first_name || ''} ${p.middle_name || ''}`.trim();
                items.push(`<div>${item}</div>`);
            })
        }
        return items.join('');
    },
    participantDates(order) {
        const items = [];
        if (order.participants && order.participants.items) {
            order.participants.items.forEach(p => {
                let item = '&nbsp;';
                if (p.birthday) {
                    item = this.formatDate(p.birthday);
                }
                items.push(`<div>${item}</div>`);
            })
        }
        return items.join('');
    },
    editParticipants(order) {
        this.selectedOrder = {
            id: order.id,
            first_name: order.first_name || '',
            last_name: order.last_name || '',
            middle_name: order.middle_name || '',
            birthday: order.birthday || '',
            places: order.places,
            children: !!order.children,
            without_place: !!order.without_place,
            without_place_count: order.without_place_count ? order.without_place_count : 0,
            children_young: order.children ? order.children_young : 0,
            children_older: order.children ? order.children_older : 0,
        };
        this.participants = {
            items: order.participants && order.participants.items ? order.participants.items.map(p => {
                return Object.assign({
                    first_name: '',
                    last_name: '',
                    middle_name: '',
                    birthday: '',
                }, p);
            }) : [],
            participant_phone: order.participants && order.participants.participant_phone ? order.participants.participant_phone : '',
            customer: order.participants && order.participants.customer,
        };
        this.participantsModal.show();
    },
    cancelParticipants() {
        this.participantsModal.hide();
    },
    saveParticipants() {
        if (this.selectedOrder.id > 0) {
            this.updateOrder(this.selectedOrder.id, {
                ...this.selectedOrder,
                participants: {...this.participants}
            })
        }
        this.participantsModal.hide();
    },
    removeParticipant(idx) {
        this.participants.items.splice(idx, 1);
    },
    addParticipant() {
        if (!this.participants) {
            this.participants = {
                items: [],
                participant_phone: '',
            }
        }
        if (this.participantData.first_name) {
            this.participants.items.push({...this.participantData});
            this.participantData = {
                first_name: '',
                last_name: '',
                middle_name: '',
                birthday: '',
            }
        }
    },
    get statusModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('editStatusModal'));
    },
    editStatus(order) {
        this.selectedOrder = {
            id: order.id,
            status: order.status,
            total_places: order.total_places,
        };
        this.statusModal.show();
    },
    cancelStatus() {
        this.statusModal.hide();
    },
    saveStatus() {
        this.updateOrder(this.selectedOrder.id, {status: this.selectedOrder.status});
        this.statusModal.hide();
        this.loadOrders(false);
    },
    get totalPlaces() {
        let total = 0;
        this.orders.forEach(o => total += o.total_places)
        return total;
    },
    get totalSum() {
        let total = 0;
        this.orders.forEach(o => total += o.total_price)
        return total;
    },
    get totalSumFop() {
        let total = 0;
        this.orders.forEach(o => total += o.payment_fop)
        return total;
    },
    get totalSumTov() {
        let total = 0;
        this.orders.forEach(o => total += o.payment_tov)
        return total;
    },
    get totalSumOffice() {
        let total = 0;
        this.orders.forEach(o => total += o.payment_office)
        return total;
    },
    get totalSumGet() {
        let total = 0;
        this.orders.forEach(o => total += this.paymentGet(o))
        return total;
    },
    clearPhone(phone) {
        return '+' + cleanPhoneNumber(phone);
    },
    get disabledBookedStatus() {
        return this.currentTab === 'reserve' && this.selectedOrder.total_places > this.schedule.places_available;
    }
})
