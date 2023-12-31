import axios from "axios";

let cancelTokenSource = null;
import * as UrlUtils from '../../../../utils/url';
import {toast} from "../../../../libs/toast";

export default (options) => ({
    links: [],
    clients: [],
    edit: false,
    create: false,
    loader: false,
    contact: options.params.contact || '',
    phone: options.params.phone || '',
    email: options.params.email || '',
    bitrix_id:  options.params.bitrix_id || '',
    sort: options.params.order || 'bitrix_id:asc',
    current_page: parseInt(options.params.page) || 1,
    selectedClient: null,
    init() {
        this.loadClients(false);
        this.$watch('contact', () => {
            this.current_page = 1;
            this.loadClients(true)
        });
        this.$watch('phone', () => {
            this.current_page = 1;
            this.loadClients(true)
        });
        this.$watch('email', () => {
            this.current_page = 1;
            this.loadClients(true)
        });
        this.$watch('bitrix_id', () => {
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
            contact: this.contact,
            phone: this.phone.replace(/[\s()-]+/g, ''),
            email: this.email,
            bitrix_id:  this.bitrix_id,
            order: this.sort,
            page: this.current_page,
        };

        if (updateUrl) {
            const updateParams = UrlUtils.filterParams(params, {contact: '',phone: '', email: '', bitrix_id:'', order: 'bitrix_id:asc', page: 1});
            UrlUtils.updateUrl(document.location.pathname, updateParams, false);
        }

        axios.get('', {
            cancelToken: cancelTokenSource.token,
            params: params
        })
            .then(({data: response}) => {
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
    createClient() {
        this.selectedClient = {
            id: null,
            bitrix_id: null,
            first_name: '',
            last_name: '',
            email: [],
            phone: [],
        };
        this.create = true;
    },
    cancelCreate() {
        this.create = false;
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
    storeClient() {
        const data = {
            id: this.selectedClient.id,
            bitrix_id: this.selectedClient.bitrix_id,
            first_name: this.selectedClient.first_name,
            last_name: this.selectedClient.last_name,
            email: this.selectedClient.email,
            phone: this.selectedClient.phone,
        };

        axios.post(`/admin/crm/clients`, data)
            .then(({data}) => {
                if (data.result === 'success') {
                    toast.success(data.message);
                    this.loadClients(true);
                    this.create = false;
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
