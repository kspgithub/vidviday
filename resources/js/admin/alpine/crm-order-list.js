import moment from "moment";
import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";
import axios from "axios";
import * as UrlUtils from "../../utils/url";

let cancelTokenSource = null;

Ukrainian.rangeSeparator = '-';


export default (options) => ({
    loading: false,
    links: [],
    items: [],
    statuses: options.statuses || [],
    current_page: parseInt(options.params.page) || 1,
    sort: options.params.order || 'created_at:desc',
    dates: options.params.dates || '',
    manager_id: parseInt(options.params.manager_id) || 0,
    tour_id: parseInt(options.params.tour_id) || 0,
    status: parseInt(options.params.status) || '',
    init() {
        this.loadItems(false);
        const picker = flatpickr(this.$refs.datesRef, {
            mode: 'range',
            locale: Ukrainian,
            dateFormat: 'd.m.Y',
            defaultDate: this.dates,
        });
    },
    clearDates() {
        this.dates = '';
        this.filterChange();
    },
    setPage(url) {
        const params = UrlUtils.parseQuery(url);
        this.current_page = params['page'] || 1;
        this.loadItems(true);
    },
    setSorting(sorting) {
        this.sort = sorting;
        this.loadItems(true);
    },
    filterChange() {
        this.current_page = 1;
        this.loadItems();
    },
    get filterData() {
        return {
            manager_id: this.manager_id,
            tour_id: this.tour_id,
            dates: this.dates,
            order: this.sort,
            page: this.current_page,
            status: this.status,
        }
    },
    get defaultFilter() {
        return {
            dates: '',
            order: 'created_at:desc',
            page: 1,
            manager_id: 0,
            tour_id: 0,
            status: '',
        }
    },
    loadItems(updateUrl = true) {
        if (cancelTokenSource) {
            cancelTokenSource.cancel();
        }
        cancelTokenSource = axios.CancelToken.source();
        this.loading = true;
        const params = this.filterData;

        if (updateUrl) {
            const updateParams = UrlUtils.filterParams(params, this.defaultFilter);
            UrlUtils.updateUrl(document.location.pathname, updateParams, false);
        }

        axios.get('', {
            cancelToken: cancelTokenSource.token,
            params: params
        })
            .then(({data: response}) => {
                this.items = response.data;
                this.links = response.links;
                this.loading = false;
            })
            .catch(error => {
                console.log(error);
                this.loading = false;
            })
    },
    formatDate(dateString) {
        return !dateString ? '-' : moment(dateString).format('DD.MM.YYYY HH:mm');
    },
    statusText(status) {
        const orderStatus = this.statuses.find(s => s.value === status);
        return orderStatus ? orderStatus.text : status;
    },
    contactName(order) {
        return order.last_name + ' ' + order.first_name;
    },
    tourFirm(order) {
        return order.agency_data ? order.agency_data.title : '-';
    }
});
