import axios from 'axios'
import handleError from './handle-error'

export default (url, params = {}, callback = null) => {
    Swal.fire({
        text: 'Ви впевнені?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Так',
        cancelButtonText: 'Відмінити',
    }).then(result => {
        if (result.value) {
            axios
                .post(url, params)
                .then(({ data: response }) => {
                    if (callback) callback(response)
                    toast.success(response.message)
                })
                .catch(error => {
                    handleError(error)
                })
        }
    })
}
