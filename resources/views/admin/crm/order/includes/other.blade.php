<div class="card" x-data='crmOrderOther(@json($order))'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інше</h3>
            <div>
                <button class="btn btn-outline-success btn-sm" @click.prevent="edit()">
                    Редагувати <i class="fa fa-pen"></i>
                </button>
            </div>
        </div>

        <table class="table table-bordered">
            <tbody>
            <tr class="border-top">
                <th style="width: 300px">Додатково</th>
                <td x-text="comment || '-'"></td>
            </tr>
            <tr class="border-top">
                <th style="width: 300px">Примітки менеджера</th>
                <td x-text="admin_comment || '-'"></td>
            </tr>
            <tr class="border-top">
                <th style="width: 300px">Джерело клієнта</th>
                <td x-text="utm_data.customer_source || '-'"></td>
            </tr>
            <tr class="border-top">
                <th style="width: 300px">Засіб клієнта</th>
                <td x-text="utm_data.customer_device || '-'"></td>
            </tr>
            </tbody>
        </table>

        @include('admin.crm.order.includes.other-modal')
    </div>
</div>
