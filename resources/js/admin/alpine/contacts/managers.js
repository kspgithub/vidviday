import Sortable from "sortablejs";

export default ({options, items}) => ({
    options: options || [],
    items: items.map(it => parseInt(it)),
    managerId: 0,
    managers: [],
    sortable: null,
    init() {
        this.sortable = Sortable.create(this.$refs.sortableRef, {
            handle: '.handler',
            animation: 150,
            onUpdate: (/**Event*/evt) => {
                const order = this.sortable.toArray();
                this.items = order.map(it => parseInt(it));
            },
        });

        this.managers = this.options.filter(o => this.items.indexOf(o.value) !== -1)
            .sort((a, b) => this.items.indexOf(a.value) > this.items.indexOf(b.value) ? 1 : (this.items.indexOf(a.value) < this.items.indexOf(b.value) ? -1 : 0))
    },
    // get managers() {
    //     return this.options.filter(o => this.items.indexOf(o.id) !== -1)
    //         .sort((a, b) => this.items.indexOf(a.id) > this.items.indexOf(b.id) ? 1 : (this.items.indexOf(a.id) < this.items.indexOf(b.id) ? -1 : 0))
    // },

    remove(id) {
        const index = this.items.indexOf(id);
        if (index > -1) {
            this.items.splice(index, 1);
            this.managers = this.managers.filter(m => m.value !== id);
        }
    },
    add() {
        if (this.managerId > 0 && this.items.indexOf(this.managerId) === -1) {
            this.items.push(this.managerId);
            const manager = this.options.find(o => o.value === this.managerId);
            this.managers.push(manager);
        }
    }
})
