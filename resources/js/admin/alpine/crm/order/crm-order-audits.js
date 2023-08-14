import axios from "axios";
import handleError from "../../composables/handle-error";
import moment from "moment";
import * as jsondiffpatch from "jsondiffpatch"; 

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

                    if (this.isValidJSON(oldValue)){
                        const oldValueJSON = JSON.parse(oldValue);
                        const newValueJSON = JSON.parse(newValue);

                        const diff = jsondiffpatch.formatters.html.format(jsondiffpatch.diff(oldValueJSON, newValueJSON), oldValueJSON);

                        html += `<div class="audit-changes">
                                    <div class="audit-key">${key}:</div>
                                    <div>${diff}</div>
                                </div>`;
                    } else {
                        html += `<div class="audit-changes">
                                    <div class="audit-key">${key}:</div>
                                    <div class="audit-old">${oldValue}</div>  
                                    <div class="audit-new">${newValue}</div>
                                </div>`;
                    }
                    
                } else {
                    if (this.isValidJSON(newValue)){
                        const newValueJSON = JSON.parse(newValue);
                        const diff = jsondiffpatch.formatters.html.format(jsondiffpatch.diff('', newValueJSON));
                        html += `<div class="audit-changes">
                                    <div class="audit-key">${key}:</div>
                                    <div>${diff}</div>
                                </div>`;
                    } else {
                        html += `<div class="audit-changes">
                                    <div class="audit-key">${key}:</div>
                                    <div class="audit-new">${newValue}</div>
                                </div>`;
                    }
                }

                fields.push(html);
            }

            html += fields.join(' ');
        }

        return html;
    },
    isValidJSON(str) {

        if(!isNaN(str) && !isNaN(parseFloat(str))){
            return false;
        }

        try {
            JSON.parse(str);
            return true;
        } catch (error) {
            return false;
        }
    }
});
