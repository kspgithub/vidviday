<div class="card" x-data='crmCorporateBasic({
        order: @json($order),
        statuses: @json($statuses),
        includes: @json($includes),
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
                <th>Тип програми</th>
                <td><span x-text="data.program_type === 1 ? 'Скласти тур' : 'Готовий тур'"></span></td>
            </tr>
            <template x-if="data.program_type === 0">
                <tr>
                    <th>Код туру</th>
                    <td><span x-text="data.tour_id || '-'"></span></td>
                </tr>
            </template>
            <template x-if="data.program_type === 0">
                <tr>
                    <th>Назва туру</th>
                    <td><span x-text="tour ? tour.title.uk : '-'"></span></td>
                </tr>
            </template>
            <template x-if="data.program_type === 1">
                <tr>
                    <th>План туру</th>
                    <td><span x-text="data.tour_plan"></span></td>
                </tr>
            </template>
            <tr>
                <th>Дата виїзду</th>
                <td>
                    <div class="d-flex">
                        <span x-text="data.start_date || '-'"></span>
                        <div x-show="data.start_place" class="ms-3">
                            <b>Місце виїзду:</b>
                            <span x-text="data.start_place"></span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr x-show="order.end_date">
                <th>Дата повернення</th>
                <td>
                    <div class="d-flex">
                        <span x-text="data.end_date || '-'"></span>
                        <div x-show="data.end_place" class="ms-3">
                            <b>Місце виїзду:</b>
                            <span x-text="data.end_place"></span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Осіб</th>
                <td><span x-text="totalPlaces"></span></td>
            </tr>
            <tr>
                <th>Особливості групи</th>
                <td><span x-text="data.group_comment"></span></td>
            </tr>
            <tr>
                <th>Побажання</th>
                <td><span x-text="data.program_comment"></span></td>
            </tr>
            <tr>
                <th>Включити у вартість</th>
                <td><span x-text="includeTitle"></span></td>
            </tr>
            {{--            <tr>--}}
            {{--                <th>Менеджер туру</th>--}}
            {{--                <td>{{$tour && $tour->tour_manager ? $tour->tour_manager->name : '-'}}</td>--}}
            {{--            </tr>--}}
            </tbody>
        </table>

        @include('admin.crm.corporate.includes.basic-modal')
        @include('admin.crm.order.includes.status-modal')
    </div>
</div>
