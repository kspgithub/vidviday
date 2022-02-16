import loadItems from "../composables/load-items";

export default {
    loading: false,
    links: [],
    items: [],
    statuses: [],
    current_page: 1,
    sort: 'created_at:desc',
    dates: '',
    manager_id: 0,
    tour_id: 0,
    status: '',
    loadItems(updateUrl = true) {
        this.loading = true;

        loadItems({
            url: '',
            params: {
                manager_id: this.manager_id,
                tour_id: this.tour_id,
                dates: this.dates,
                order: this.sort,
                page: this.current_page,
                status: this.status,
            },
            updateUrl: updateUrl,
            defaultParams: {
                dates: '',
                order: 'created_at:desc',
                page: 1,
                manager_id: 0,
                tour_id: 0,
                status: '',
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
}
