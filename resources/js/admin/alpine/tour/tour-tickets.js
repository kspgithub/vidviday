export default options => ({
    locales: options.locales || [],
    ticket: options.ticket || null,
    model: options.model || null,
    regions: options.regions || [],
    tickets: options.tickets || [],
    init() {
        const self = this

        this.$watch('model.ticket_id', ticket_id => this.onTicketChange(ticket_id))

        jQuery(this.$refs.input).select2({
            theme: 'bootstrap-5',
            ajax: {
                url: '/api/tickets/select-box',
                dataType: 'json',
                data: function (params) {
                    return {
                        region_id: jQuery('#region_id').val(),
                        q: params.term,
                        page: params.page || 1,
                        limit: 20,
                    }
                },
            },
        })
        jQuery(this.$refs.input).on('select2:select', e => {
            self.model.ticket_id = e.params.data.id
            console.log(self.model)
        })
    },
    onTicketChange(ticket_id) {
        let self = this
        axios.get('/api/tickets/get', { params: { ticket_id } }).then(response => {
            self.ticket = response.data
        })
    },
    onChange(event) {
        this.model.ticket_id = event.target.value
    },
    clear() {
        this.model.ticket_id = 0
    },
})
