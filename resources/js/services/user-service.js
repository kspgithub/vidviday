import axios from 'axios'
import apiClient, { getError } from './api'

/**
 * Профиль пользователя
 * @returns {Promise<null|any>}
 */
export const fetchProfile = async () => {
    const response = await apiClient.get('/user').catch(error => {
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
 * Избранное
 * @returns {Promise<null|any>}
 */
export const fetchFavourites = async () => {
    const response = await apiClient.get('/user/favourites').catch(error => {
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

export const toggleFavourite = async id => {
    const response = await apiClient.patch(`/user/favourites/${id}`).catch(error => {
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
