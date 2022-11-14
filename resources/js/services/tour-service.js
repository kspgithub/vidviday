import apiClient, { getError } from './api'
import axios from 'axios'

let schedulesRequestSource = axios.CancelToken.source()
let fetchRequestSource = axios.CancelToken.source()
let searchRequestSource = axios.CancelToken.source()

/**
 * Поиск туров
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTours = async (params = {}) => {
    try {
        fetchRequestSource.cancel('abort')
    } catch (e) {}
    fetchRequestSource = axios.CancelToken.source()

    const response = await apiClient
        .get('/tours', {
            params: params,
            cancelToken: fetchRequestSource.token,
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

export const fetchPopularTours = async (count = 12) => {
    const response = await apiClient
        .get('/tours/popular', {
            params: { count: count },
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
    return []
}

export const autocompleteTours = async (q = '', limit = 20) => {
    try {
        searchRequestSource.cancel('abort')
    } catch (e) {}
    searchRequestSource = axios.CancelToken.source()

    const response = await apiClient
        .get('/tours/autocomplete', {
            params: { q: q, limit: limit, order: 'relevant' },
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

export const fetchGuides = async (tour_id = 0) => {
    const response = await apiClient
        .get('/tours/guides', {
            params: { tour_id: tour_id },
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

/**
 * Расписание тура
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourSchedules = async (tourId, params = {}) => {
    try {
        schedulesRequestSource.cancel('abort')
    } catch (e) {}
    schedulesRequestSource = axios.CancelToken.source()

    const response = await apiClient
        .get(`/tours/${tourId}/schedules`, {
            params: params,
            cancelToken: fetchRequestSource.token,
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
export default {
    fetchTours,
    fetchPopularTours,
}
