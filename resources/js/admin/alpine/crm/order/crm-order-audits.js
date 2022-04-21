import axios from "axios";
import handleError from "../../composables/handle-error";
import moment from "moment";

export default (orderId) => ({
    orderId: orderId,
    items: [],
    currentPage: 1,
    hasMore: false,
    request: false,
    init() {
        this.loadItems();
    },
    loadItems() {
        this.request = true;
        axios.get(`/admin/crm/order/${this.orderId}/audits?page=${this.currentPage}`)
            .then(({data: response}) => {
                if (this.currentPage === 1) {
                    this.items = response.data;
                } else {
                    this.items = [...this.items, ...response.data];
                }
                this.hasMore = !!response.next_page_url;
                this.request = false;
            })
            .catch((error) => {
                handleError(error);
                this.request = false;
                this.hasMore = false;
            })
    },
    loadMore() {
        if (this.request) return;
        this.currentPage = this.currentPage + 1;
        this.loadItems();
    },
    formattedDate(date) {
        return moment(date).format('DD.MM.YYYY HH:mm');
    },
    changedFields(item) {
        let html = '';
        if (item.event === 'updated') {
            const fields = [];
            for (let key in item.new_values) {

                let html = '';

                const newValue = item.new_values[key];
                if (item.old_values[key]) {
                    const oldValue = item.old_values[key];
                    html += `${key}: ${oldValue} => ${newValue}`;
                } else {
                    html += `${key}: ${newValue}`;
                }

                fields.push(html);
            }

            html += fields.join(', ');
        }

        return html;
    }
});
