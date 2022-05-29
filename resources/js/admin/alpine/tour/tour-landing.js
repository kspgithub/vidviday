export default (options) => ({
    locales: options.locales,
    landings: options.landings || [],
    model: options.model,
    options: options.options,
    landing: options.landing || null,
    init() {
        this.$watch('model.landing_id', (landing_id) => this.onLandingChange(landing_id))
    },
    onLandingChange(landing_id) {
        this.landing = this.landings.find(it => it.id == landing_id);
    }
})
