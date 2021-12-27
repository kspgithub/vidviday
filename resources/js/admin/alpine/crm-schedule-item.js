import axios from "axios";

let cancelTokenSource = null;
import * as UrlUtils from '../../utils/url';
import {toast} from "../../libs/toast";
import moment from "moment";

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
    selectedOrder: {
        id: null,
        first_name: '',
        last_name: '',
        phone: '',
        email: '',
    },
    init() {

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
        return moment(value).format('DD.MM.YYYY HH:mm')
    },
    roomTitle(key) {
        key = key.trim().replaceAll('_', '-');
        const room = this.roomTypes.find(r => r.value === key);
        return room ? room.text : key.replaceAll('-', ' ');
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
        this.edit = true;
    },
    cancelEdit() {
        this.edit = false;
    },
    saveOrder() {
        this.edit = false;
        const params = {...this.selectedOrder, accommodation: {...this.accommodation}};
        //console.log(params)
        this.updateOrder(this.selectedOrder.id, params);
    },

})
