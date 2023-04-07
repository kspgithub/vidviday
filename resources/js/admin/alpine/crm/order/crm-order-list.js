import moment from "moment";
import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";
import axios from "axios";
import * as UrlUtils from "../../../../utils/url";

let cancelTokenSource = null;

Ukrainian.rangeSeparator = '-';


export default (options) => ({
    loading: false,
    links: [],
    items: [],
    statuses: options.statuses || [],
    abolition_types: options.abolition_types || [],
    current_page: parseInt(options.params.page) || 1,
    sort: options.params.order || 'created_at:desc',
    dates: options.params.dates || '',
    manager_id: parseInt(options.params.manager_id) || 0,
    tour_id: parseInt(options.params.tour_id) || 0,
    status: options.params.status || '',
    abolition_cause: options.params.abolition_cause || '',
    order_id: options.params.order_id || '',
    dates__interval: options.params.dates__interval || 0,
    created_dates__interval: options.params.created_dates__interval || 0,
    created_dates: options.params.created_dates || '',
    contact: options.params.contact || '',
    phone: options.params.phone || '',
    email: options.params.email || '',
    places: options.params.places || '',
    company: options.params.company || '',
    init() {
        this.loadItems(false);
        if (this.$refs.datesRef) {
            const mode = this.dates__interval ? 'range' : 'single';
            const picker = flatpickr(this.$refs.datesRef, {
                mode: mode,
                locale: Ukrainian,
                dateFormat: 'd.m.Y',
                defaultDate: this.dates,
            });
        }

        if (this.$refs.created_datesRef) {
            const mode = this.created_dates__interval ? 'range' : 'single';
            const createdPicker = flatpickr(this.$refs.created_datesRef, {
                mode: mode,
                locale: Ukrainian,
                dateFormat: 'd.m.Y',
                defaultDate: this.created_dates,
            });
        }
    },
    clearDates() {
        this.dates = '';
        this.filterChange();
    },
    clearCreatedDates() {
        this.created_dates = '';
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
    changeDatesType(){
        mode = this.dates__interval ? 'range' : 'single';
        const picker = flatpickr(this.$refs.datesRef, {
            mode: mode,
            locale: Ukrainian,
            dateFormat: 'd.m.Y',
            defaultDate: this.dates,
        });
    },
    changeCreatedDatesType(){
        mode = this.created_dates__interval ? 'range' : 'single';
        const createdPicker = flatpickr(this.$refs.created_datesRef, {
            mode: mode,
            locale: Ukrainian,
            dateFormat: 'd.m.Y',
            defaultDate: this.created_dates,
        });
    },

    get filterData() {
        return {
            manager_id: this.manager_id,
            tour_id: this.tour_id,
            dates: this.dates,
            order: this.sort,
            page: this.current_page,
            status: this.status,
            order_id: this.order_id,
            dates__interval: this.dates__interval,
            created_dates__interval: this.created_dates__interval,
            created_dates: this.created_dates,
            contact: this.contact,
            phone: this.phone,
            email: this.email,
            places: this.places,
            company: this.company,
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
            order_id: '',
            dates__interval: 0,
            created_dates__interval: 0,
            created_dates: '',
            contact: '',
            phone: '',
            email: '',
            places: '',
            company: '',
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
    },
});
