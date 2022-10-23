<div class="card" x-data='crmOrderBasic({
        order: @json($order),
        statuses: @json($statuses),
        schedules: @json($schedules),
        redirect: {{isset($redirect) && $redirect ? 'true' : 'false'}},
    })'>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Основна інформація</h3>
            <div>
                <button data-bs-toggle="modal" data-bs-target="#edit-basic-modal"
                        @click.prevent="resetData()"
                        class="btn btn-outline-success btn-sm">
                    Редагувати <i class="fa fa-pen"></i>
                </button>
            </div>
        </div>
        <table class="table  table-bordered">
            <tbody>
            <tr>
                <th style="width: 300px">Турист (Контактна особа)</th>
                <td><span x-text="clientName"></span></td>
            </tr>
            <tr>
                <th>Телефон</th>
                <td>
                    <template x-if="data.phone">
                        <a :href="'tel:'+data.phone" x-text="data.phone" target="_blank"></a>
                    </template>
                    <template x-if="!data.phone">
                        <span>-</span>
                    </template>

            </tr>
            <tr>
                <th>Е-пошта</th>
                <td>
                    <template x-if="data.email">
                        <a :href="'mailto:'+data.email" x-text="data.email"
                           target="_blank"
                           @click.prevent="$store.crmEmail.show(data.email)"
                           data-bs-toggle="modal"
                           data-bs-target="#crm-email-modal"
                        ></a>
                    </template>
                    <template x-if="!data.email">
                        <span>-</span>
                    </template>
                </td>
            </tr>
            <tr>
                <th>Viber</th>
                <td><span x-text="data.viber || '-'"></span></td>
            </tr>
            <tr>
                <th>Компанія</th>
                <td><span x-text="data.company || '-'"></span></td>
            </tr>
            <tr>
                <th>Статус замовлення</th>
                <td>
                    <span class="badge fs-14 me-3" x-bind:class="'bg-status-'+status" x-text="statusText"></span>
                    <a href="#edit-status-modal" class="text-success" data-bs-toggle="modal">змінити статус</a>
                </td>
            </tr>

            <tr>
                <th>Дата замовлення</th>
                <td>{{$order->created_at ? $order->created_at?->format('d.m.Y H:i') : '-'}}</td>
            </tr>
            <tr>
                <th>Код туру</th>
                <td><span x-text="data.tour_id || '-'"></span></td>
            </tr>
            <tr>
                <th>Назва туру</th>
                <td><span x-text="tour ? tour.title.uk : '-'"></span></td>
            </tr>
            <tr>
                <th>Дата виїзду</th>
                <td><span x-text="schedule ? schedule.start_title : '-'"></span></td>
            </tr>
            <tr>
                <th>Осіб</th>
                <td><span x-text="totalPlaces"></span></td>
            </tr>
            <tr>
                <th>Менеджер туру</th>
                <td>{{$tour && $tour->tour_manager ? $tour->tour_manager->name : '-'}}</td>
            </tr>
            </tbody>
        </table>

        @include('admin.crm.order.includes.basic-modal')
        @include('admin.crm.order.includes.status-modal')
    </div>
</div>
