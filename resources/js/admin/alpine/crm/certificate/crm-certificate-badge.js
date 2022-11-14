import axios from 'axios'

export default status => ({
    count: 0,
    init() {
        this.checkCount()
    },
    checkCount() {
        axios
            .get('/admin/crm/certificate/count', {
                params: {
                    status: status,
                },
            })
            .then(({ data }) => {
                this.count = data
            })
    },
})
