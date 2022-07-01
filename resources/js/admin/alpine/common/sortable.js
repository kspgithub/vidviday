import Sortable from 'sortablejs';

export default (options) => ({
    orderUrl: options.url || '',
    sortable: null,
    init() {
        this.sortable = Sortable.create(this.$refs.sortableRef, {
            handle: '.handler',
            animation: 150,
            onUpdate: (/**Event*/evt) => {
                const order = this.sortable.toArray();
                // Первый элемент это template, его удаляем
                axios.post(this.orderUrl, {order: order}).catch((error) => {
                    console.log(error);
                })
                // same properties as onEnd
            },
        });
    },
})
