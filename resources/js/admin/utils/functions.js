export const swalConfirm = (callback, options = {}) => {

    Swal.fire({
        text: options.text || 'Ви впевнені?',
        icon: options.icon || 'warning',
        showCancelButton: options.showCancelButton || true,
        confirmButtonText: options.confirmButtonText || 'Так',
        cancelButtonText: options.cancelButtonText || 'Відмінити'
    }).then((result) => {

        if (result.value) {
            if (typeof callback === 'object' && typeof callback.onTrue === "function") {
                callback.onTrue();
            } else {
                callback();
            }

        } else {
            if (typeof callback === 'object' && typeof callback.onFalse === "function") {
                callback.onFalse();
            }
        }
    })
}

