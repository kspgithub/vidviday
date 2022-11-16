import axios from "axios";
import handleError from "./handle-error";

export default (url, callback = null) => {
    Swal.fire({
        text: 'Ви впевнені?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Так',
        cancelButtonText: 'Відмінити'
    }).then((result) => {
        if (result.value) {
            axios.delete(url)
                .then(({data: response}) => {
                    if (callback) callback(response);
                    toast.success(response.message);
                })
                .catch((error) => {
                    handleError(error);
                })
        }
    })
}
