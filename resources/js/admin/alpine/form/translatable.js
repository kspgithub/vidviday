export default (options = {expanded: false}) => {

    console.log(document.documentElement.lang || 'uk')
    return {
        ...options.share || {},
        locales: options.share?.locales || [],
        trans_locale: document.documentElement.lang || 'uk',
        trans_expanded: options && options.expanded,
        async submit(e, submit) {
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
                if(submit) {
                    this.$refs.form.submit();
                } else {
                    let btn = jQuery('<button type="submit"></button>')
                    jQuery(this.$refs.form).append(btn)
                    btn.click()
                }
            } else {
                toast.error('Перевірте правильність заповнення полів');
            }
        },
    }
}
