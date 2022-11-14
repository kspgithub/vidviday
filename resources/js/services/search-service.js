import axios from 'axios'
import apiClient, { getError } from './api'

let searchRequestSource = axios.CancelToken.source()

export const autocompleteSearch = async (q = '', params = {}) => {
    try {
        searchRequestSource.cancel('abort')
    } catch (e) {}
    searchRequestSource = axios.CancelToken.source()

    const response = await apiClient
        .get('/search/autocomplete', {
            params: { q: q, order: 'relevant', ...params },
            cancelToken: searchRequestSource.token,
        })
        .catch(error => {
            if (!axios.isCancel(error)) {
                const message = getError(error)
                toast.error(message)
            }
        })

    if (response) {
        return response.data
    }

    return null
}
