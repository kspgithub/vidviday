import axios from "axios";

export default (status, group) => ({
    count: 0,
    init() {
        this.checkCount();
    },
    checkCount() {
        axios.get('/admin/crm/order/count', {
            params: {
                status: status,
                group_type: group,
            }
        })
            .then(({data}) => {
                this.count = data;
            })
    }
});
