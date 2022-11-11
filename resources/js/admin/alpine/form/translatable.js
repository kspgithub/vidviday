export default (options = { expanded: false }) => {
    return {
        ...(options.share || {}),
        locales: options.share?.locales || [],
        trans_locale: document.documentElement.lang || 'uk',
        trans_expanded: options && options.expanded,
        async submit(e, submit) {
            let valid = true
            const inputs = this.$refs.form.querySelectorAll(':invalid')

            inputs.forEach(inputEl => {
                if (!inputEl.validity.valid) {
                    valid = false
                    toast.error('Поле ' + inputEl.name + ' має не вірне значення')
                }
            })

            if (valid) {
                if (submit) {
                    this.$refs.form.submit()
                } else {
                    let btn = jQuery('<button type="submit" class="d-none"></button>')
                    jQuery(this.$refs.form).append(btn)
                    btn.click()
                }
            } else {
                toast.error('Перевірте правильність заповнення полів')
            }
        },
    }
}
