@extends('admin.layout.app')

@section('title', 'Дані про виїзд: '.$tour->title.', '.$schedule->start_title)

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.crm.schedule.index'), 'title'=>'Список збірних виїздів'],
  ['url'=>route('admin.crm.schedule.show', $schedule), 'title'=>$tour->title.' - '.$schedule->start_title],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>Дані про виїзд: {{$tour->title}}, {{$schedule->start_title}}</h1>
    </div>
    <div x-data='crmScheduleItem({
        params: @json(request()->all()),
        schedule: @json($schedule),
        orders: @json($orders),
        statuses: @json($statuses),
        roomTypes: @json($roomTypes),
        countOrders: @json($countOrders),
        })'>


        <div class="card">
            <div class="card-body">
                <div data-ps="{suppressScrollY: true}" class="pb-5">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>Назва туру</th>
                            <th>Дата проведення</th>
                            <th>Вартість</th>
                            <th>Комісія</th>
                            <th>Знижка</th>
                            <th>Додатково</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="{{route('admin.tour.edit', $tour)}}" target="_blank">{{$tour->title}}</a></td>
                            <td>{{$schedule->title}}</td>
                            <td>{{$schedule->price}} {{$schedule->currency}}</td>
                            <td>{{$schedule->commission}} {{$schedule->currency}}</td>
                            <td>{!! $tour->discount_title !!}</td>
                            <td>
                            <textarea type="text" x-model.debounce.500ms="schedule.admin_comment"
                                      class="form-control form-control-sm mw-200px"></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <nav class="btn-group mb-4">
                    <a class="btn btn-outline-primary"
                       :class="{active: currentTab === 'common'}"
                       @click.prevent="setTab('common')"
                       href="#">Основний список <span x-show="countOrders.common"
                                                      x-text="`(${countOrders.common})`"></span></a>
                    <a class="btn btn-outline-primary"
                       :class="{active: currentTab === 'reserve'}"
                       @click.prevent="setTab('reserve')"
                       href="#">Резерв <span x-show="countOrders.reserve"
                                             x-text="`(${countOrders.reserve})`"></span></a>
                    <a class="btn btn-outline-primary"
                       :class="{active: currentTab === 'interested'}"
                       @click.prevent="setTab('interested')"
                       href="#">Цікавилися <span x-show="countOrders.interested"
                                                 x-text="`(${countOrders.interested})`"></span></a>
                    <a class="btn btn-outline-primary"
                       :class="{active: currentTab === 'cancel'}"
                       @click.prevent="setTab('cancel')"
                       href="#">Скасування <span x-show="countOrders.cancel" x-text="`(${countOrders.cancel})`"></span></a>
                </nav>

                <div class="crm-orders-table">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>{!! alpineSortLink('id', 'ID') !!}</th>
                            <th>{!! alpineSortLink('status', 'Статус') !!}</th>
                            <th>{!! alpineSortLink('places', 'Осіб') !!}</th>
                            <th>ПІБ</th>
                            <th>Контакти</th>
                            <th>Пошта</th>
                            <th></th>
                            <th>{!! alpineSortLink('created_at', 'Дата') !!}</th>
                            <th>Нічліг</th>
                            <th>Сума загалом</th>
                            <th>Опл. ФОП</th>
                            <th>Опл. ТОВ</th>
                            <th>Опл. в офісі</th>
                            <th>Дозбирати</th>
                            <th>Примітки</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="order in orders" :key="'order-'+order.id">
                            <tr x-bind:class="'order-row-'+order.status">
                                <td>
                                    <a :href="`/admin/crm/schedules/${order.schedule_id}/order/${order.id}`"
                                       target="_blank"
                                       x-text="order.id"></a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm dropdown-toggle"
                                                :class="'bg-status-'+order.status"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <span x-text="statusText(order.status)"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <template x-for="status in statuses">
                                                <li :class="'bg-status-'+status.value">
                                                    <a class="dropdown-item"
                                                       @click.prevent="updateOrder(order.id, {status: status.value})"
                                                       x-text="status.text"></a>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>
                                </td>
                                <td x-text="order.total_places" class="text-center"></td>
                                <td class="text-nowrap" x-text="order.last_name + ' ' + order.first_name"></td>
                                <td>
                                    <div x-show="order.phone" class="text-nowrap">
                                        <b>Тел:</b>
                                        <a :href="'tel:'+order.phone" x-text="order.phone" target="_blank"></a>
                                    </div>
                                    <div x-show="order.viber" class="text-nowrap">
                                        <b>Viber:</b>
                                        <span x-text="order.viber"></span>
                                    </div>
                                </td>
                                <td>
                                    <a x-show="order.email" :href="'mailto:'+order.email" x-text="order.email"
                                       target="_blank"></a>
                                </td>
                                <td>
                                    <a href="#" class="text-success"
                                       data-bs-toggle="modal" data-bs-target="#editModal"
                                       @click.prevent="editOrder(order)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <span x-text="formatDate(order.created_at)" class="text-nowrap"></span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            <template x-for="(val, key) in order.accommodation">
                                                <template x-if="val > 0 && key !== 'other' && key !== 'other_text'">
                                                    <div class="text-nowrap">
                                                        <b x-text="roomTitle(key)+':'"></b>
                                                        <span x-text="val"></span>
                                                    </div>
                                                </template>
                                                <template x-if="!!order.accommodation['other']">
                                                    <div :key="'ord-accomm-other-'+order.id">
                                                        <b>Інше:</b>
                                                        <span x-text="order.accommodation['other-text']"></span>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                        <div>
                                            <a href="#" data-bs-toggle="modal"
                                               class="text-success ms-2"
                                               data-bs-target="#roomModal" @click.prevent="editOrder(order)">
                                                <i class="fa fa-pen-alt"></i>
                                            </a>
                                        </div>
                                    </div>


                                </td>
                                <td class="text-nowrap text-right">
                                    <span x-text="order.total_price"></span>
                                    <span x-text="order.currency"></span>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-right mw-80px w-80px"
                                           @blur="updateOrder(order.id, {payment_fop: order.payment_fop})"
                                           x-model.debounce.500ms="order.payment_fop">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-right mw-80px w-80px"
                                           @blur="updateOrder(order.id, {payment_tov: order.payment_tov})"
                                           x-model.debounce.500ms="order.payment_tov">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-right mw-80px w-80px"
                                           @blur="updateOrder(order.id, {payment_office: order.payment_office})"
                                           x-model.debounce.500ms="order.payment_office">
                                </td>
                                <td class="text-right text-nowrap">
                                    <span x-text="paymentGet(order)"></span>
                                    <span x-text="order.currency"></span>
                                </td>
                                <td>
                                    <textarea type="text" x-model.debounce.500ms="order.admin_comment"
                                              @blur="updateOrder(order.id, {admin_comment: order.admin_comment})"
                                              class="form-control form-control-sm mw-200px"></textarea>
                                </td>

                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('admin.crm.schedule.includes.modal-contacts')
        @include('admin.crm.schedule.includes.modal-rooms')

    </div>
@endsection