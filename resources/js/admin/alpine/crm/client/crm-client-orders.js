import loadItems from "../../composables/load-items";
import moment from "moment";

export default ({client, params = {}}) => ({
    loading: false,
    client: client,
    links: [],
    items: [],
    current_page: parseInt(params.page) || 1,
    sort: params.order || 'created_at:desc',
    status: params.status || '',
    init() {
        this.$store.orders.current_page = parseInt(params.page) || 1;
        this.$store.orders.sort = parseInt(params.sort) || 1;
        this.$store.orders.status = arams.status || '';
        this.$store.orders.loadItems(false);
    },
    loadItems(updateUrl = true) {
        this.loading = true;

        loadItems({
            url: '',
            params: {
                status: this.status,
                order: this.sort,
                page: this.current_page,
            },
            updateUrl: updateUrl,
            defaultParams: {
                status: '',
                order: 'created_at:desc',
                page: 1,
            },
            onSuccess: (response) => {
                this.items = response.data;
                this.links = response.links;
                this.loading = false;
            },
            onError: (error) => {
                this.loading = false;
            }
        });
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
