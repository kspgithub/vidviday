import axios from "axios";
import apiClient, {getError} from "./api";


/**
 * Поиск туров
 * @returns {Promise<null|any>}
 */
export const fetchProfile = async () => {

    const response = await apiClient.get('/user').catch(error => {
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
