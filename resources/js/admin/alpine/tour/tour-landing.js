export default options => ({
    locale: document.documentElement.lang || 'uk',
    locales: options.locales,
    trans_expanded: false,
    landings: options.landings || [],
    model: options.model,
    landing: options.landing || null,
    init() {
        this.$watch('model.landing_id', landing_id => this.onLandingChange(landing_id))
    },
    onTypeChange() {
        setTimeout(() => {
            window.LocationGroup(document.querySelector('.location-group'))
        }, 1000)
        this.trans_expanded = this.model.type <= 1
    },
    onLandingChange(landing_id) {
        this.landing = this.landings.find(item => item.id == landing_id)
    },
    get landingOptions() {
        return this.landings.map(item => ({
            value: item.id,
            text: item.title[this.locale] || item.title,
        }))
    },
})
