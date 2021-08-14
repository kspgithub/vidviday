import apiClient, {getError} from "./api";
import axios from 'axios';

let fetchRequestSource = axios.CancelToken.source();

/**
 * Поиск туров
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTours = async (params = {}) => {
    try {
        fetchRequestSource.cancel('abort');
    } catch (e) {
    }
    fetchRequestSource = axios.CancelToken.source();

    const response = await apiClient.get('/tours', {
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

export const fetchPopularTours = async (count = 12) => {
    const response = await apiClient.get('/tours/popular', {
        params: {count: count},
    }).catch(error => {
        if (!axios.isCancel(error)) {
            const message = getError(error);
            toast.error(message);
        }
    })
    if (response) {
        return response.data;
    }
    return [];
}

export default {
    fetchTours,
    fetchPopularTours,
}
