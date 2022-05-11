<div x-data='crmOrderList({
        params: @json(request()->all()),
        statuses: @json($statuses),
    })'>
    <div class="row mb-3">
        <div class="col-auto">
            <select x-model="status"
                    class="form-control form-control-sm"
                    @change.debounce="filterChange()"
            >
                <option value="">Статус</option>
                @foreach($statuses as $status)
                    <option value="{{$status['value']}}">{{$status['text']}}</option>
                @endforeach
            </select>
        </div>
        @if(!current_user()->isTourManager())
            <div class="col-auto">
                <select x-model="manager_id"
                        class="form-control form-control-sm"
                        @change.debounce="filterChange()"
                >
                    <option value="0">Менеджер</option>
                    @foreach($managers as $manager)
                        <option value="{{$manager['value']}}">{{$manager['text']}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-auto max-300px">
            <select x-model="tour_id"
                    class="form-control form-control-sm"
                    @change.debounce="filterChange()"
            >
                <option value="0">Тур</option>
                @foreach($tours as $tour)
                    <option value="{{$tour['value']}}">{{html_entity_decode($tour['text'])}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center">
                <div class="me-2">Дата виїзду</div>
                <div>
                    <input x-model="dates" type="search"
                           class="form-control form-control-sm"
                           @input.debounce="filterChange()"
                           x-ref="datesRef">
                </div>
                <a href="#" x-show="dates" @click.prevent="clearDates()" class="text-danger ms-2">
                    <i class="fa fa-times"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div data-ps="{suppressScrollY: true}">
                <table class="table table-sm" x-bind:class="{loading: loading}">
                    <thead>
                    <tr>
                        <th>{!! alpineSortLink('id', 'ID') !!}</th>
                        <th>{!! alpineSortLink('status', 'Статус') !!}</th>
                        <th>{!! alpineSortLink('created_at', 'Дата замовлення') !!}</th>
                        <th>Тур</th>
                        <th>Менеджер</th>
                        <th>{!! alpineSortLink('start_date', 'Дата виїзду') !!}</th>
                        <th>{!! alpineSortLink('places', 'Осіб') !!}</th>
                        <th>Турист (Контактна особа)</th>
                        <th>Турфірма</th>
                        <th>Примітки</th>
                        <th>Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="order in items" :key="'ord-'+order.id">
                        <tr x-bind:class="'order-row-'+order.status">
                            <td>
                                <a :href="`/admin/crm/order/${order.id}`" x-text="order.id" target="_blank"></a>
                            </td>
                            <td>
                                <span x-text="statusText(order.status)"></span>
                            </td>
                            <td>
                                <span x-text="formatDate(order.created_at)"></span>
                            </td>
                            <td>
                                <span x-text="order.tour ? order.tour.title.uk : '-'"></span>
                            </td>
                            <td>
                                <span x-text="order.tour_manager ? order.tour_manager.name : '-'"></span>
                            </td>
                            <td>
                                <span x-text="order.start_date || '-'"></span>
                            </td>
                            <td>
                                <span x-text="order.total_places"></span>
                            </td>
                            <td>
                                <div x-text="contactName(order)" class="mb-1"></div>
                                <a :href="'tel:'+ order.phone" target="_blank" x-text="order.phone"></a>
                            </td>
                            <td>
                                <span x-text="tourFirm(order)"></span>
                            </td>
                            <td>
                                <div x-text="order.admin_comment"></div>
                            </td>
                            <td class="text-nowrap">
                                <a :href="`/admin/crm/order/${order.id}`"
                                   class="btn btn-sm btn-success my-2 me-2"><i class="fa fa-eye"></i></a>

                                <a :href="`/admin/crm/order/${order.id}/edit`"
                                   class="btn btn-sm btn-primary my-2 me-2"><i class="fa fa-pen"></i></a>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {!! alpinePagination() !!}
</div>
