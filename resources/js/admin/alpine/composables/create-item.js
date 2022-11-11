import axios from 'axios'
import handleError from './handle-error'

export default ({ url, params = {}, onSuccess = null, onError = null }) => {
    axios
        .post(url, params)
        .then(({ data: response }) => {
            if (onSuccess) {
                onSuccess(response)
            }
        })
        .catch(error => {
            handleError(error)
            if (onError) {
                onError(error)
            }
        })
}
