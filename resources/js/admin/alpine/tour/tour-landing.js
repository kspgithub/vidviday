import axios from "axios";
import handleError from "../composables/handle-error";
import jQuery from 'jquery';
import Sortable from "sortablejs";

export default (props) => ({
    baseUrl: props.baseUrl || document.location.pathname,
    tour: props.tour,
    items: [],
    selectedId: 0,
    init() {
        this.loadItems();

        const self = this;

        jQuery(self.$refs.select).select2({
            theme: 'bootstrap-5',
            ajax: {
                url: `${self.baseUrl}/select-box`,
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1,
                        limit: 20
                    };
                },
            }

        });
        jQuery(this.$refs.select).on('select2:select', (e) => {
            self.selectedId = e.params.data.id;
        })

        const sortable = Sortable.create(self.$refs.sortable, {
            draggable: '.draggable',
            handler: '.handle',
            onUpdate: (/**Event*/evt) => {
                const sorted_ids = sortable.toArray();
                const data = {
                    ids: sorted_ids,
                };
                axios.post(`${self.baseUrl}/update-position`, data)
                    .then(({data}) => {
                    })
                    .catch(error => handleError(error));
            },
        });
    },
    loadItems() {
        axios.get(this.baseUrl)
            .then(({data}) => {
                this.items = data;
            })
            .catch(error => {
                handleError(error);
            })
    },
    detachItem(id) {
        axios.post(`${this.baseUrl}/${id}/detach`)
            .then(({data}) => {
                this.loadItems();
            })
            .catch(error => {
                handleError(error);
            })
    },
    attachItem(id) {
        axios.post(`${this.baseUrl}/${id}/attach`)
            .then(({data}) => {
                this.loadItems();
            })
            .catch(error => {
                handleError(error);
            })
    }
})
