import axios from "axios";

let cancelTokenSource = null;
import * as UrlUtils from '../../utils/url';
import {toast} from "../../libs/toast";
import moment from "moment";
import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";

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
    init() {
        setTimeout(() => {
            if (this.$refs.pickerInput) {
                flatpickr(this.$refs.pickerInput, {
                    locale: Ukrainian,
                    allowInput: true,
                    dateFormat: 'd.m.Y'
                });
            }


        }, 500);
        this.loadOrders(false);
    },
    setTab(tab) {
        this.currentTab = tab;
        this.loadOrders();
    },
    loadOrders(updateUrl = true) {
        if (cancelTokenSource) {
            cancelTokenSource.cancel();
        }
        cancelTokenSource = axios.CancelToken.source();
        this.loader = true;
        const params = {
            tab: this.currentTab,
            order: this.sort,
        };

        if (updateUrl) {
            const updateParams = UrlUtils.filterParams(params, {
                tab: 'common',
                order: 'id:asc'
            });
            UrlUtils.updateUrl(document.location.pathname, updateParams, false);
        }

        axios.get('', {
            cancelToken: cancelTokenSource.token,
            params: params
        })
            .then(({data}) => {
                this.orders = data.orders;
                this.countOrders = data.countOrders;
            })
            .catch(error => {
                console.log(error);
                this.loader = false;
            })
    },
    statusText(value) {
        const status = this.statuses.find(s => s.value === value);
        return status ? status.text : value;
    },
    formatDate(value) {
        return moment(value).format('DD.MM.YYYY')
    },
    roomTitle(key) {
        key = key.trim().replaceAll('_', '-').replaceAll(' ', '-').replaceAll('р', 'p').replaceAll('о', 'o');

        const room = this.roomTypes.find(r => r.value === key);
        return room ? room.text : key.replaceAll('-', ' ').replaceAll('_', ' ');
    },
    paymentGet(order) {
        return order.total_price - order.payment_fop - order.payment_tov - order.payment_office;
    },
    updateOrder(id, params) {
        axios.patch(`/admin/order/${id}`, params)
            .then(({data: response}) => {
                if (params.status) {
                    this.loadOrders(false);
                } else {
                    const idx = this.orders.findIndex(o => o.id === id);
                    this.orders[idx] = response.model;
                }
            })
            .catch(error => {
                console.log(error);
                this.loadOrders(false);
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
            places: order.places,
            children: !!order.children,
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
    updateScheduleComment() {
        this.loader = true;
        axios.patch(`/admin/crm/schedules/${this.schedule.id}`, {admin_comment: this.schedule.admin_comment})
            .then(({data}) => {
                this.loader = false;
            })
            .catch((err) => {

                this.loader = false;
            })
    }
})
