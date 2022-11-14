export default options => ({
    checked: options.checked || false,
    async change() {
        this.$refs.checkboxEl.disabled = true
        await axios.patch(options.url, { published: this.checked ? 1 : 0 })
        this.$refs.checkboxEl.disabled = false
        if (this.checked) {
            toast.success('Запис опубліковано')
        } else {
            toast.success('Запис знятий з публікації')
        }
    },
})
