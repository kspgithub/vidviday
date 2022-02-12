export default (options) => ({
    value: options.value,
    init() {
        const self = this;
        jQuery(this.$refs.input).select2({
            theme: 'bootstrap-5',
            ajax: {
                url: '/api/places/select-box',
                dataType: 'json',
                data: function (params) {
                    return {
                        region_id: jQuery('#region_id').val(),
                        district_id: jQuery('#district_id').val(),
                        q: params.term,
                        page: params.page || 1,
                        limit: 20
                    };
                },
            }

        });
        jQuery(this.$refs.input).on('select2:select', (e) => {
            this.value = e.params.data.id;
        })
    },
    onChange(event) {
        this.value = event.target.value;
    },
    clear() {
        this.value = 0;
    }
})
