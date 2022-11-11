import axios from 'axios'
import * as UrlUtils from '../../utils/url'
import { toast } from '../../libs/toast'

let cancelTokenSource = null

export default options => ({
    loading: false,
    locales: options.locales || ['uk'],
    links: [],
    items: [],
    group: options.params.group || '*',
    order: options.params.order || 'key:asc',
    q: decodeURIComponent(options.params.q || ''),
    current_page: parseInt(options.params.page) || 1,
    selectedItem: {
        id: 0,
        group: '',
        key: '',
        text: {
            uk: '',
        },
    },
    init() {
        this.loadItems(false)
        this.$watch('q', () => {
            this.filterChange()
        })
    },
    get modal() {
        return bootstrap.Modal.getOrCreateInstance(document.getElementById('edit-line-modal'))
    },
    get filterData() {
        return {
            q: this.q,
            group: this.group,
            order: this.sort,
            page: this.current_page,
        }
    },
    get defaultFilter() {
        return {
            q: '',
            group: '*',
            order: 'key:desc',
            page: 1,
        }
    },
    loadItems(updateUrl = true) {
        if (cancelTokenSource) {
            cancelTokenSource.cancel()
        }
        cancelTokenSource = axios.CancelToken.source()
        this.loading = true
        const params = this.filterData

        if (updateUrl) {
            const updateParams = UrlUtils.filterParams(params, this.defaultFilter)
            UrlUtils.updateUrl(document.location.pathname, updateParams, false)
        }

        axios
            .get('', {
                cancelToken: cancelTokenSource.token,
                params: params,
            })
            .then(({ data: response }) => {
                this.items = response.data
                this.links = response.links
                this.loading = false
            })
            .catch(error => {
                console.log(error)
                this.loading = false
            })
    },
    setPage(url) {
        const params = UrlUtils.parseQuery(url)
        this.current_page = params['page'] || 1
        this.loadItems(true)
    },
    setSorting(sorting) {
        this.sort = sorting
        this.loadItems(true)
    },
    filterChange() {
        this.current_page = 1
        this.loadItems()
    },
    editItem(item) {
        this.selectedItem = Object.assign(
            {
                id: 0,
                group: '',
                key: '',
                text: {
                    uk: '',
                },
            },
            item,
        )
        this.modal.show()
    },
    cancelEdit() {
        this.modal.hide()
    },
    saveItem() {
        const url = this.selectedItem.id > 0 ? `/admin/translation` : `/admin/translation/` + this.selectedItem.id
        if (this.selectedItem.id > 0) {
            axios
                .patch(`/admin/translation/` + this.selectedItem.id, {
                    text: this.selectedItem.text,
                })
                .then(({ data }) => {
                    if (data.result === 'success') {
                        const idx = this.items.findIndex(it => it.id === this.selectedItem.id)
                        this.items[idx] = data.model
                        toast.success('Запис оновлено')
                    }
                })
                .catch(error => {
                    console.log(error)
                    toast.error(error.message)
                })
        } else {
            axios
                .post(`/admin/translation`, {
                    group: this.selectedItem.group,
                    key: this.selectedItem.key,
                    text: this.selectedItem.text,
                })
                .then(() => {
                    this.loadItems()
                    toast.success('Запис створено')
                })
                .catch(error => {
                    console.log(error)
                    toast.error(error.message)
                })
        }

        this.modal.hide()
    },
})
