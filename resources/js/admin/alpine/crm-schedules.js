import moment from "moment";
import axios from "axios";

let cancelTokenSource = null;
import * as UrlUtils from '../../utils/url';
import {toast} from "../../libs/toast";
import flatpickr from "flatpickr";
import rangePlugin from "flatpickr/dist/plugins/rangePlugin";
import {Ukrainian} from "flatpickr/dist/l10n/uk";

Ukrainian.rangeSeparator = '-';

export default (options) => ({
    loading: false,
    links: [],
    items: [],
    current_page: parseInt(options.params.page) || 1,
    sort: options.params.order || 'start_date:asc',
    dates: options.params.dates || moment().format('DD.MM.YYYY'),
    manager_id: parseInt(options.params.manager_id) || 0,
    booked: options.params.booked ? !!options.params.booked : false,
    init() {
        this.loadItems(false);
        const picker = flatpickr(this.$refs.datesRef, {
            mode: 'range',
            locale: Ukrainian,
            dateFormat: 'd.m.Y',
            defaultDate: this.dates,
        });
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
    clearDates() {
        this.dates = '';
        this.filterChange();
    },
    filterChange() {
        this.current_page = 1;
        this.loadItems();
    },
    loadItems(updateUrl = true) {
        if (cancelTokenSource) {
            cancelTokenSource.cancel();
        }
        cancelTokenSource = axios.CancelToken.source();
        this.loading = true;
        const params = {
            manager_id: this.manager_id,
            dates: this.dates,
            order: this.sort,
            page: this.current_page,
            booked: this.booked ? 1 : 0,
        };

        if (updateUrl) {
            const updateParams = UrlUtils.filterParams(params, {
                dates: moment().format('DD.MM.YYYY'),
                order: 'start_date:asc',
                page: 1,
                manager_id: 0,
                booked: 0,
            });
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

    }
});
