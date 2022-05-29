export default (options) => ({
    locales: options.locales,
    landings: options.landings || [],
    model: options.model,
    options: options.options,
    landing: options.landing || null,
    init() {

        jQuery(this.$refs.input).select2()

        this.$watch('model.landing_id', (e) => this.onLandingChange())
    },
    handleChange(e) {
        console.log(e)
        this.model.landing_id = e.target.value
    },
    onLandingChange() {
        if (this.model && this.model.landing_id > 0) {
            this.landing = this.landings.find(it => it.id === this.model.landing_id);
        } else {
            this.landing = null;
        }
    }
})
