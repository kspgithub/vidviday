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

Array.prototype.toggle = function(item, getValue = item => item) {
    const index = this.findIndex(i => getValue(i) === getValue(item));
    if (index === -1) this.push(item);
    else this.splice(index, 1);
    return this;
};

Array.prototype.toObject = function() {
    return Object.entries(this)
        .reduce((obj, [key, value]) => ({ ...obj, [value]: key }), {});
};
