export default (error) => {
    if (error.response) {
        // Request made and server responded
        //console.log(error.response.data);
        //console.log(error.response.status);
        //console.log(error.response.headers);
        if (error.response.status === 422) {
            for (let key in error.response.data.errors) {
                const message = error.response.data.errors[key];
                toast.error(message);
            }
        } else {
            toast.error(error.response.data.message);
        }

    } else if (error.request) {
        // The request was made but no response was received
        console.log(error.request);
    } else {
        // Something happened in setting up the request that triggered an Error
        console.log('Error', error.message);
        toast.error(error.message);
    }
}
