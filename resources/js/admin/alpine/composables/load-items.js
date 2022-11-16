import axios from "axios";
import * as UrlUtils from "../../../utils/url";
import handleError from "./handle-error";

let cancelTokenSource = null;


export default ({url, params = {}, updateUrl = true, defaultParams = {}, onSuccess = null, onError = null}) => {
    if (cancelTokenSource) {
        cancelTokenSource.cancel();
    }
    cancelTokenSource = axios.CancelToken.source();

    if (updateUrl) {
        const updateParams = UrlUtils.filterParams(params, defaultParams);
        UrlUtils.updateUrl(document.location.pathname, updateParams, false);
    }

    axios.get(url, {
        cancelToken: cancelTokenSource.token,
        params: params
    })
        .then(({data: response}) => {
            if (onSuccess) {
                onSuccess(response);
            }
        })
        .catch(error => {
            handleError(error);
            if (onError) {
                onError(error);
            }
        })
}
