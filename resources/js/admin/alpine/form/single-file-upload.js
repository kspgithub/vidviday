export default options => ({
    value: options.value,
    onChange(event) {
        console.log(event)
    },
    clear() {
        this.value = ''

        this.$refs.fileInputRef.value = ''
    },
})
