export default (options) => ({
    locale: document.documentElement.lang || 'uk',
    locales: options.locales,
    regions: options.regions || [],
    districts: options.districts || [],
    places: options.places || [],
    model: options.model,
    place: options.place || null,
    init() {
        this.$watch('model.place_id', (place_id) => this.onPlaceChange(place_id))
    },
    onPlaceChange(place_id) {
        this.place = this.places.find(item => item.id == place_id);
    },
    get placeOptions() {
        return this.places.map(item => ({
            value: item.id,
            text: item.title[this.locale] || item.title,
        }))
    }
})
