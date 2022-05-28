export default (options) => ({
    locales: options.locales,
    landings: options.landings || [],
    model: options.model,
    options: options.options,
    landing: options.landing || null,
    init() {

    },
    onLandingChange() {
        if (this.model && this.model.landing_id > 0) {
            this.landing = this.landings.find(it => it.id === this.model.landing_id);
        } else {
            this.landing = null;
        }
    }
})
