export default (options = {expanded: false}) => ({
    ...options.share,
    trans_locale: document.documentElement.lang || 'uk',
    trans_expanded: options && options.expanded,
    locales: options.locales || [],
    async submit() {
        let valid = true;
        const inputs = this.$refs.form.querySelectorAll(':invalid');

        inputs.forEach((inputEl) => {
            if (!inputEl.validity.valid) {
                valid = false;
                toast.error('Поле ' + inputEl.name + ' має не вірне значення');
            }
        })


        if (valid) {
            this.$refs.form.submit();
        }
    },
})
