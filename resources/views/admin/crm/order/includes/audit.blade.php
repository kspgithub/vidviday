<div class="card" x-data='crmOrderAudits({{$order->id}})'>
    <div class="card-body">
        <h3>Історія змін</h3>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Користувач</th>
                <th>Подія</th>
                <th>Зміни</th>
            </tr>
            </thead>
            <tbody>
            <template x-for="item in items" :key="item.id">
                <tr>
                    <td>
                        <div class="text-nowrap" x-text="formattedDate(item.created_at)"></div>
                    </td>
                    <td>
                        <div class="text-nowrap" x-text="item.user ? item.user.name : 'user deleted'"></div>
                        <div x-text="item.user ? item.user.phone : ''"></div>
                        <div x-text="item.user ? item.user.email : ''"></div>
                    </td>
                    <td>
                        <div x-text="item.event"></div>
                    </td>
                    <td>
                        <div x-html="changedFields(item)"></div>
                    </td>
                </tr>
            </template>
            <tr x-show="hasMore">
                <td colspan="4" class="text-center">
                    <a href="#" class="btn btn-sm btn-outline-primary" @click.prevent="loadMore()">Завантажити ще</a>
                </td>
            </tr>
            <tr x-show="!items.length && !request">
                <td colspan="4" class="text-center">
                    Історія змін порожня
                </td>
            </tr>

            </tbody>
        </table>

    </div>
</div>

