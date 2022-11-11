export default options => ({
    locales: options.locales || [],
    place: options.place || null,
    model: options.model || null,
    regions: options.regions || [],
    districts: options.districts || [],
    places: options.places || [],
    options: [],
    prevSearchQuery: '',
    prevQuery: {},
    prevResults: {},
    init() {
        const self = this

        this.$watch('model.place_id', place_id => this.onPlaceChange(place_id))

        jQuery(this.$refs.input).select2({
            theme: 'bootstrap-5',
            dataCache: [],
            // minimumInputLength: 2,
            ajax: {
                url: '/api/places/select-box',
                dataType: 'json',
                quietMillis: 500,
                data: function (params) {
                    self.prevQuery = params
                    return {
                        region_id: jQuery('#region_id').val(),
                        district_id: jQuery('#district_id').val(),
                        q: params.term,
                        page: params.page || 1,
                        limit: 20,
                    }
                },
                processResults: function (data) {
                    return data
                },
                success: function (data) {
                    // console.log(jQuery(self.$refs.input).data('select2'))
                    self.prevResults = data.results
                },
            },
        })
        jQuery(this.$refs.input).on('select2:closing', function (e) {
            self.prevSearchQuery = jQuery('.select2-search input').prop('value')
        })
        jQuery(this.$refs.input).on('select2:open', e => {
            jQuery('.select2-search input').val(self.prevSearchQuery).trigger('input')
        })
        jQuery(this.$refs.input).on('select2:select', e => {
            self.model.place_id = e.params.data.id
        })
    },
    onPlaceChange(place_id) {
        let self = this
        axios.get('/api/places/get', { params: { place_id } }).then(response => {
            self.place = response.data
        })
    },
    onChange(event) {
        this.model.place_id = event.target.value
    },
    clear() {
        this.model.place_id = 0
    },
})
