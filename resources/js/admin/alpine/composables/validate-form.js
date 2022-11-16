export default (form) => {
    let valid = form.checkValidity();
    if (!valid) {
        const inputs = form.querySelectorAll(':invalid');
        inputs.forEach((inputEl) => {
            if (!inputEl.validity.valid) {
                valid = false;
                let label = '';
                const formGroupEl = inputEl.closest('.form-group');
                if (formGroupEl) {
                    let labelEl = formGroupEl.querySelector('.col-form-label');
                    if (!labelEl) {
                        labelEl = formGroupEl.querySelector('label');
                    }
                    if (labelEl) {
                        label = labelEl.innerText.replace('*', '').trim();
                    }
                }
                if (!label) {
                    label = inputEl.name;
                }
                toast.error('Поле "<b>' + label + '</b>" має не вірне значення');
            }
        })
    }
    return valid;
}
