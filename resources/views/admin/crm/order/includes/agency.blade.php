<div class="card" x-data='crmOrderAgency(@json($order))'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Турфірма (від кого турист)</h3>
            <div>
                <button @click.prevent="edit()" class="btn btn-outline-success btn-sm">
                    Редагувати <i class="fa fa-pen"></i>
                </button>
            </div>
        </div>

        <table class="table  table-bordered">
            <tbody>
            <tr class="border-top">
                <th style="width: 300px">Назва</th>
                <td x-text="agency.title || '-'"></td>
            </tr>
            <tr>
                <th style="width: 300px">Філія</th>
                <td x-text="agency.affiliate || '-'"></td>
            </tr>
            <tr>
                <th style="width: 300px">Менеджер</th>
                <td x-text="agency.manager_name || '-'"></td>
            </tr>
            <tr>
                <th style="width: 300px">Телефон менеджера</th>
                <td x-text="agency.manager_phone || '-'"></td>
            </tr>
            <tr>
                <th style="width: 300px">Email менеджера</th>
                <td x-text="agency.manager_email || '-'"></td>
            </tr>
            </tbody>
        </table>

        @include('admin.crm.order.includes.agency-modal')
    </div>
</div>
