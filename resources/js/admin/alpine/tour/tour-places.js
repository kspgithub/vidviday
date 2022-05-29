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
        return (model) => {
            console.log(model)
            return this.places.filter(item => {
                if(model.region_id > 0 ) {
                    if(model.region_id != item.region_id) return false
                }
                if(model.district_id > 0 ) {
                    if(model.district_id != item.district_id) return false
                }
                return true
            }).map(item => ({
                value: item.id,
                text: item.title[this.locale] || item.title,
            }))
        }
    }
})
