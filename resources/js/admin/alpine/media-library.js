export default (options) => ({
    items: options.value,
    onChange(event) {
        console.log(event);
    },
    clear() {
        this.value = '';
    }
})
