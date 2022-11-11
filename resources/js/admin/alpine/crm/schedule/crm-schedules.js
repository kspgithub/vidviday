import moment from 'moment'
import axios from 'axios'

let cancelTokenSource = null
import * as UrlUtils from '../../../../utils/url'
import { toast } from '../../../../libs/toast'
import flatpickr from 'flatpickr'
import rangePlugin from 'flatpickr/dist/plugins/rangePlugin'
import { Ukrainian } from 'flatpickr/dist/l10n/uk'
import loadItems from '../../composables/load-items'

Ukrainian.rangeSeparator = '-'

export default options => ({
    loading: false,
    links: [],
    items: [],
    currentTab: options.params.tab || 'recruited',
    current_page: parseInt(options.params.page) || 1,
    sort: options.params.order || 'start_date:asc',
    dates: options.params.dates || '',
    manager_id: parseInt(options.params.manager_id) || 0,
    booked: options.params.booked ? !!options.params.booked : false,
    init() {
        this.loadItems(false)
        const picker = flatpickr(this.$refs.datesRef, {
            mode: 'range',
            locale: Ukrainian,
            dateFormat: 'd.m.Y',
            defaultDate: this.dates,
        })
    },
    setPage(url) {
        const params = UrlUtils.parseQuery(url)
        this.current_page = params['page'] || 1
        this.loadItems(true)
    },
    setTab(tab) {
        this.currentTab = tab
        this.current_page = 1
        this.loadItems(true)
    },
    setSorting(sorting) {
        this.sort = sorting
        this.loadItems(true)
    },
    clearDates() {
        this.dates = ''
        this.filterChange()
    },
    filterChange() {
        this.current_page = 1
        this.loadItems()
    },
    loadItems(updateUrl = true) {
        this.loading = true

        loadItems({
            url: '',
            params: {
                manager_id: this.manager_id,
                dates: this.dates,
                order: this.sort,
                page: this.current_page,
                booked: this.booked ? 1 : 0,
                tab: this.currentTab,
            },
            updateUrl: updateUrl,
            defaultParams: {
                dates: moment().format('DD.MM.YYYY'),
                order: 'start_date:asc',
                page: 1,
                manager_id: 0,
                booked: 0,
                tab: 'recruited',
            },
            onSuccess: response => {
                this.items = response.data
                this.links = response.links
                this.loading = false
            },
            onError: error => {
                this.loading = false
            },
        })
    },
})
