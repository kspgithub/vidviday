export default options => ({
    value: options.value,
    init() {
        const self = this
        jQuery(this.$refs.input).select2({
            theme: 'bootstrap-5',
        })
        jQuery(this.$refs.input).on('select2:select', e => {
            this.value = e.params.data.id
        })
    },
    onChange(event) {
        this.value = event.target.value
    },
    clear() {
        this.value = 0
    },
})
