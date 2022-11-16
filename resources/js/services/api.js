export const apiClient = axios.create({
    baseURL: "/api",
    withCredentials: true // required to handle the CSRF token
});


export const getError = (error) => {
    let errorMessages = [];
    let data = error.data || error.response.data || null;
    if (data) {
        if (data.errors) {
            for (let key in data.errors) {
                if (data.errors.hasOwnProperty(key)) {
                    errorMessages.push(data.errors[key]);
                }
            }
        } else {
            errorMessages.push(data.message)
        }
    }
    return errorMessages.length ? errorMessages.join('<br>') : error;
};

/**
 * Add a request interceptor
 * @param AxiosRequestConfig config
 */
apiClient.interceptors.request.use(
    function (config) {
        const token = window.localStorage.getItem("token");
        if (token != null) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    function (error) {
        return Promise.reject(error.response);
    }
);


export default apiClient;
