import axios from "axios";

let cancelTokenSource = null;
import * as UrlUtils from '../../../../utils/url';
import {toast} from "../../../../libs/toast";

export default (options) => ({
    links: [],
    clients: [],
    edit: false,
    loader: false,
    search: options.params.q || '',
    order: options.params.order || 'bitrix_id:asc',
    current_page: parseInt(options.params.page) || 1,
    selectedClient: null,
    init() {
        this.loadClients(false);
        this.$watch('search', () => {
            this.current_page = 1;
            this.loadClients(true)
        })
    },
    loadClients(updateUrl = true) {
        if (cancelTokenSource) {
            cancelTokenSource.cancel();
        }
        cancelTokenSource = axios.CancelToken.source();
        this.loader = true;
        const params = {
            q: this.search,
            order: this.order,
            page: this.current_page,
        };

        if (updateUrl) {
            const updateParams = UrlUtils.filterParams(params, {q: '', order: 'bitrix_id:asc', page: 1});
            UrlUtils.updateUrl(document.location.pathname, updateParams, false);
        }

        axios.get('', {
            cancelToken: cancelTokenSource.token,
            params: params
        })
            .then(({data: response}) => {

                console.log(response);
                this.clients = response.data;
                this.links = response.links;
                this.loader = false;
            })
            .catch(error => {
                console.log(error);
                this.loader = false;
            })

    },
    setPage(url) {
        const params = UrlUtils.parseQuery(url);
        this.current_page = params['page'] || 1;
        this.loadClients(true);
    },
    setSorting(sorting) {
        this.sort = sorting;
        this.loadClients(true);
    },
    cancelEdit() {
        this.edit = false;
    },
    editClient(client) {
        this.selectedClient = client;
        this.edit = true;
    },
    deleteClient(client) {

        Swal.fire({
            text: 'Ви впевнені?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Так',
            cancelButtonText: 'Відмінити'
        }).then((result) => {
            if (result.value) {
                axios.delete(`/admin/crm/clients/${client.id}`)
                    .then(({data}) => {
                        if (data.result === 'success') {
                            toast.success(data.message);
                            this.loadClients(true);
                        }
                    })
                    .catch(err => {
                        console.log(err);
                        toast.error(err.message);
                    })
            }
        })
    },
    saveClient() {
        const data = {
            id: this.selectedClient.id,
            bitrix_id: this.selectedClient.bitrix_id,
            first_name: this.selectedClient.first_name,
            last_name: this.selectedClient.last_name,
            email: this.selectedClient.email,
            phone: this.selectedClient.phone,
        };

        axios.patch(`/admin/crm/clients/${data.id}`, data)
            .then(({data}) => {
                if (data.result === 'success') {
                    toast.success(data.message);
                    this.loadClients(true);
                    this.edit = false;
                }
            })
            .catch(err => {
                console.log(err);
                toast.error(err.message);
            })
    },
    addEmail() {
        if (this.selectedClient) {
            this.selectedClient.email.push('');
        }
    },
    removeEmail(idx) {
        if (this.selectedClient) {
            this.selectedClient.email.splice(idx, 1);
        }
    },
    addPhone() {
        if (this.selectedClient) {
            this.selectedClient.phone.push('');
        }
    },
    removePhone(idx) {
        if (this.selectedClient) {
            this.selectedClient.phone.splice(idx, 1);
        }
    }
})
