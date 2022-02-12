export default (options) => ({
    value: options.value,
    onChange(event) {
        console.log(event);
    },
    clear() {
        this.value = '';
    }
})
