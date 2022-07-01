<div class="card" x-data='crmOrderAdditional(@json($order))'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Додатково</h3>
            <div>

            </div>
        </div>

        <table class="table  table-bordered">
            <tbody>
            <tr class="border-top">
                <th style="width: 300px">Коментарі чергового</th>
                <td>
                    <textarea x-model.debounce.500ms="order.duty_comment" class="form-control"
                              {{--                              x-bind:readonly="{{current_user()->can('order-duty-comments', $order) ? 'false' : 'true'}}"--}}
                              @change="updateOrder({duty_comment: order.duty_comment})"></textarea>
                </td>
            </tr>
            <tr class="border-top">
                <th style="width: 300px">Примітки</th>
                <td>
                    <textarea x-model.debounce.500ms="order.admin_comment" class="form-control"
                              {{--                              x-bind:readonly="{{current_user()->can('order-admin-comments', $order) ? 'false' : 'true'}}"--}}
                              @change="updateOrder({admin_comment: order.admin_comment})"></textarea>
                </td>
            </tr>
            <tr class="border-top">
                <th style="width: 300px">Побажання замовника</th>
                <td>
                    <textarea x-model.debounce.500ms="order.comment" class="form-control"
                              x-bind:readonly="{{current_user()->can('order-comments', $order) ? 'false' : 'true'}}"
                              @change="updateOrder({comment: order.comment})"></textarea>
                </td>
            </tr>
            <tr class="border-top">
                <th style="width: 300px">Джерело клієнта</th>
                <td>
                    <textarea x-model.debounce.500ms="order.utm_data.customer_source" class="form-control"
                              {{--                              x-bind:readonly="{{current_user()->can('order-comments', $order) ? 'false' : 'true'}}"--}}
                              @change="updateOrder({utm_data: order.utm_data})"></textarea>
                </td>
            </tr>
            <tr class="border-top">
                <th style="width: 300px">Засіб клієнта</th>
                <td>
                    <textarea x-model.debounce.500ms="order.utm_data.customer_device" class="form-control"
                              {{--                              x-bind:readonly="{{current_user()->can('order-comments', $order) ? 'false' : 'true'}}"--}}
                              @change="updateOrder({utm_data: order.utm_data})"></textarea>
                </td>
            </tr>
            </tbody>
        </table>


    </div>
</div>
