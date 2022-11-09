import apiClient, {getError} from "./api";
import axios from 'axios';

let fetchRequestSource = axios.CancelToken.source();

/**
 * Поиск мест
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchPlaces = async (params = {}) => {
    try {
        fetchRequestSource.cancel('abort');
    } catch (e) {
    }
    fetchRequestSource = axios.CancelToken.source();

    const response = await apiClient.get('/places/select-box', {
        params: params,
        cancelToken: fetchRequestSource.token
    }).catch(error => {
        if (!axios.isCancel(error)) {
            const message = getError(error);
            toast.error(message);
        }
    })

    if (response) {
        return response.data;
    }

    return null;
}

export default {
    fetchPlaces,
}
