import axios from "axios";

export default (url, active) => {
    axios.patch(url, {
        active: active ? 1 : 0,
    }).then(({data: response}) => {
        toast.success(response.message);
    }).catch((error) => {
        toast.error(error.data.message);
        console.log(error);
    })
}