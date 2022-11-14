export default options => ({
    locales: options.locales,
    types: options.types || [],
    finances: options.finances || [],
    model: options.model,
    includeOptions: options.includeOptions,
    excludeOptions: options.excludeOptions,
    finance: options.finance || null,
    financeOptions: [],
    init() {
        if (this.model && this.model.type_id > 0) {
            this.financeOptions = this.model.type_id === 1 ? this.includeOptions : this.excludeOptions
        }
    },
    onTypeChange() {
        if (this.model && this.model.type_id > 0) {
            this.financeOptions = this.model.type_id === 1 ? this.includeOptions : this.excludeOptions
        } else {
            this.financeOptions = []
        }
    },
    onFinanceChange() {
        if (this.model && this.model.finance_id > 0) {
            this.finance = this.finances.find(it => it.id === this.model.finance_id)
        } else {
            this.finance = null
        }
    },
})
