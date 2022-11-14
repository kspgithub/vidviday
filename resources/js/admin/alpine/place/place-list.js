import loadItems from '../composables/load-items'
import axios from 'axios'
import deleteItem from '../composables/delete-item'
import * as UrlUtils from '../../../utils/url'

export default props => ({
    request: false,
    baseUrl: props.baseUrl || document.location.href,
    q: props.request.q || '',
    region_id: parseInt(props.request.region_id) || 0,
    district_id: parseInt(props.request.district_id) || 0,
    current_page: parseInt(props.request.page) || 1,
    per_page: parseInt(props.request.per_page) || 20,
    sort: props.request.order || 'title->uk:desc',
    regions: props.regions || [],
    districts: props.districts || [],
    items: [],
    links: [],
    init() {
        this.loadItems(false)
        if (this.region_id > 0) {
            this.loadDistricts()
        }
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
    loadItems(updateUrl = true) {
        this.request = true
        loadItems({
            url: this.baseUrl,
            params: {
                q: this.q,
                region_id: this.region_id,
                district_id: this.district_id,
                page: this.current_page,
                per_page: this.per_page,
                order: this.sort,
            },
            updateUrl: updateUrl,
            defaultParams: {
                q: '',
                region_id: 0,
                district_id: 0,
                page: 1,
                per_page: 20,
                order: 'title->uk:desc',
            },
            onSuccess: response => {
                this.items = response.data
                this.links = response.links
                this.request = false
            },
            onError: () => {
                this.request = false
            },
        })
    },
    loadDistricts() {
        axios.get('/api/location/districts?region_id=' + this.region_id).then(({ data }) => {
            this.districts = data
        })
    },
    regionsChange() {
        this.page = 1
        this.district_id = 0
        if (this.region_id > 0) {
            this.loadDistricts()
        } else {
            this.districts = []
        }
        this.loadItems()
    },
    filterChange() {
        this.current_page = 1
        this.loadItems()
    },
    updateItem(id, params) {
        axios.patch('/admin/place/' + id, params).then(({ data }) => {
            toast.success(data.message)
        })
    },
    deleteItem(id) {
        deleteItem(`/admin/place/${id}`, data => {
            this.loadItems(false)
        })
    },
})
