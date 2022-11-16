import loadItems from "../composables/load-items";
import * as UrlUtils from "../../../utils/url";
import updateItem from "../composables/update-item";
import {toast} from "../../../libs/toast";
import deleteItem from "../composables/delete-item";
import flatpickr from "flatpickr";
import {Ukrainian} from "flatpickr/dist/l10n/uk";
import rangePlugin from "flatpickr/dist/plugins/rangePlugin";
import moment from "moment";
import createItem from "../composables/create-item";

const DEFAULT_SCHEDULE = {
    id: 0,
    start_date: '',
    places: 48,
    price: null,
    commission: null,
    accomm_price: null,
    curren: 'UAH',
    comment: '',
    auto_booking: false,
    auto_limit: 10,
    repeat: '',
    repeat_count: 1,
    repeat_custom_interval: 'all',
    repeat_day_of_week: 'saturday',
}

export default (props) => ({
    tour: props.tour,
    canEdit: props.canEdit || false,
    scheduleData: {...DEFAULT_SCHEDULE},
    q: props.params.q || '',
    sort: props.params.order || 'start_date:desc',
    currentPage: parseInt(props.params.page) || 1,
    perPage: parseInt(props.params.per_page) || 20,
    items: [],
    links: [],
    init() {
        this.loadItems(false);
        setTimeout(() => {
            flatpickr(this.$refs.startDateRef, {
                locale: Ukrainian,
                allowInput: true,
                dateFormat: 'd.m.Y',
                // plugins: [new rangePlugin({input: this.$refs.endDateRef})],
                onChange: (selectedDates) => {
                    const start_date = selectedDates[0] ? moment(selectedDates[0]).format('DD.MM.YYYY') : null;
                    const totalDayNights = this.tour.duration + this.tour.nights;
                    let days;
                    if (this.tour.duration > this.tour.nights) {
                        days = Math.floor(totalDayNights / 2)
                    } else {
                        days = Math.ceil(totalDayNights / 2)
                    }

                    const end_date = selectedDates[0] ? moment(selectedDates[0]).add(days, 'days').format('DD.MM.YYYY') : null;
                    this.scheduleData = {...this.scheduleData, start_date: start_date, end_date: end_date};
                }
            });
        }, 100);

    },
    setPage(url) {
        const params = UrlUtils.parseQuery(url);
        this.currentPage = params['page'] || 1;
        this.loadItems(true);
    },
    setSorting(sorting) {
        this.sort = sorting;
        this.loadItems(true);
    },
    loadItems(updateUrl = true) {
        loadItems({
            url: '',
            params: {
                page: this.currentPage,
                per_page: this.perPage,
                order: this.sort,
            },
            updateUrl: updateUrl,
            defaultParams: {
                page: 1,
                per_page: 20,
                order: 'start_date:desc',
            },
            onSuccess: (response) => {
                this.items = response.data;
                this.links = response.links;
            }
        })
    },
    get scheduleModal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('editScheduleModal'));
    },
    editSchedule(item = {}) {
        const tourDefaults = {
            price: this.tour.price,
            commission: this.tour.commission,
            accomm_price: this.tour.accomm_price,
        }
        this.scheduleData = {...DEFAULT_SCHEDULE, ...tourDefaults, ...item};
        this.scheduleModal.show();
    },
    cancelSchedule() {
        this.scheduleModal.hide();
    },
    saveSchedule() {
        const params = {...this.scheduleData};
        if (params.id > 0) {
            this.updateSchedule({id: params.id}, params);
        } else {
            this.createSchedule(params);
        }
    },
    createSchedule(params) {
        createItem({
            url: `/admin/tour/${this.tour.id}/schedule`,
            params: params,
            onSuccess: (response) => {
                toast.success(response.message);
                this.scheduleModal.hide();
                this.loadItems();
            }
        });
    },
    updateSchedule(item, params = {}) {
        updateItem({
            url: `/admin/tour/${this.tour.id}/schedule/${item.id}`,
            params: params,
            onSuccess: (response) => {
                toast.success(response.message);
                this.scheduleModal.hide();
                this.loadItems();
            }
        });
    },
    deleteSchedule(item) {
        deleteItem(`/admin/tour/${this.tour.id}/schedule/${item.id}`, () => {
            this.loadItems();
        })
    }

});
