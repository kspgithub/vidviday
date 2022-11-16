import {toast} from "../../../../libs/toast";
import updateItem from "../../composables/update-item";

export default (order) => ({
    order: order,
    updateOrder(params) {
        updateItem({
            url: `/admin/order/${this.order.id}`,
            params: params,
            onSuccess: (response) => {
                toast.success(response.message);
            }
        })
    }
});
