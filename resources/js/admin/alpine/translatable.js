export default (options) => ({
    trans_locale: document.documentElement.lang || 'uk',
    trans_expanded: options.expanded || false,
    async submit() {
        let valid = true;
        const inputs = this.$refs.form.querySelectorAll('[required]');

        inputs.forEach((inputEl) => {
            if (!inputEl.validity.valid) {
                valid = false;
                toast.error('Поле ' + inputEl.name + ' має не вірне значення');
                console.log(inputEl);
            }
        })

        if (valid) {
            this.$refs.form.submit();
        } else {
            toast.error('Перевірте правильність заповнення полів');
        }
    },
})
