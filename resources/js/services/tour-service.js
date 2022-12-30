import apiClient, {getError} from "./api";
import axios from 'axios';

let schedulesRequestSource = axios.CancelToken.source();
let fetchRequestSource = axios.CancelToken.source();
let searchRequestSource = axios.CancelToken.source();
let landingsRequestSource = axios.CancelToken.source();
let placesRequestSource = axios.CancelToken.source();
let financesRequestSource = axios.CancelToken.source();
let ticketsRequestSource = axios.CancelToken.source();
let funRequestSource = axios.CancelToken.source();
let transportRequestSource = axios.CancelToken.source();
let accommodationsRequestSource = axios.CancelToken.source();
let foodRequestSource = axios.CancelToken.source();
let calculatorRequestSource = axios.CancelToken.source();
let questionsRequestSource = axios.CancelToken.source();
let testimonialsRequestSource = axios.CancelToken.source();

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

export const autocompleteTours = async (q = '', limit = 20, page = 1) => {
    try {
        searchRequestSource.cancel('abort');
    } catch (e) {
    }
    searchRequestSource = axios.CancelToken.source();

    const response = await apiClient.get('/tours/autocomplete', {
        params: {q: q, limit: limit, order: 'relevant'},
        cancelToken: searchRequestSource.token
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

export const fetchGuides = async (tour_id = 0) => {
    const response = await apiClient.get('/tours/guides', {
        params: {tour_id: tour_id},
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

/**
 * Расписание тура
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourSchedules = async (tourId, params = {}) => {
    try {
        schedulesRequestSource.cancel('abort');
    } catch (e) {
    }
    schedulesRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/schedules`, {
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


/**
 * Місця посадки
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourLandings = async (tourId, params = {}) => {
    try {
        landingsRequestSource.cancel('abort');
    } catch (e) {
    }
    landingsRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/landings`, {
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


/**
 * Екскурсійні об'єкти
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourPlaces = async (tourId, params = {}) => {
    try {
        placesRequestSource.cancel('abort');
    } catch (e) {
    }
    placesRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/places`, {
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


/**
 * Фінанси
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourFinances = async (tourId, params = {}) => {
    try {
        financesRequestSource.cancel('abort');
    } catch (e) {
    }
    financesRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/finances`, {
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


/**
 * Квитки
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourTickets = async (tourId, params = {}) => {
    try {
        ticketsRequestSource.cancel('abort');
    } catch (e) {
    }
    ticketsRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/tickets`, {
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


/**
 * Гуцульська забава
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourFun = async (tourId, params = {}) => {
    try {
        funRequestSource.cancel('abort');
    } catch (e) {
    }
    funRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/fun`, {
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


/**
 * Транспорт
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourTransport = async (tourId, params = {}) => {
    try {
        transportRequestSource.cancel('abort');
    } catch (e) {
    }
    transportRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/transport`, {
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


/**
 * Проживання
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourAccommodations = async (tourId, params = {}) => {
    try {
        accommodationsRequestSource.cancel('abort');
    } catch (e) {
    }
    accommodationsRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/accommodations`, {
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


/**
 * Харчування
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourFood = async (tourId, params = {}) => {
    try {
        foodRequestSource.cancel('abort');
    } catch (e) {
    }
    foodRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/food`, {
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


/**
 * Калькулятор
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourCalculator = async (tourId, params = {}) => {
    try {
        calculatorRequestSource.cancel('abort');
    } catch (e) {
    }
    calculatorRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/calculator`, {
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


/**
 * Питання
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourQuestions = async (tourId, params = {}) => {
    try {
        questionsRequestSource.cancel('questions');
    } catch (e) {
    }
    questionsRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/questions`, {
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


/**
 * Відгуки
 * @param tourId
 * @param params
 * @returns {Promise<null|any>}
 */
export const fetchTourTestimonials = async (tourId, params = {}) => {
    try {
        testimonialsRequestSource.cancel('abort');
    } catch (e) {
    }
    testimonialsRequestSource = axios.CancelToken.source();

    const response = await apiClient.get(`/tours/${tourId}/testimonials`, {
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
