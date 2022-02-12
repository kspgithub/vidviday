@extends('admin.layout.app')

@section('title', 'Дані про виїзд: '.$tour->title.', '.$schedule->start_title)

@section("content")

    <div x-data='crmScheduleItem({
        params: @json(request()->all()),
        schedule: @json($schedule->shortInfo(['admin_comment', 'places']), JSON_HEX_APOS),
        statuses: @json($statuses),
        roomTypes: @json($roomTypes),
        countOrders: @json($countOrders),
        })'>
        {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.crm.schedule.index'), 'title'=>'Список збірних виїздів'],
['url'=>route('admin.crm.schedule.show', $schedule), 'title'=>$tour->title.' - <span x-text="schedule.start_title"></span>'],
]) !!}

        <div class="d-flex justify-content-between">
            <h1>Дані про виїзд: {{$tour->title}}, <span x-text="schedule.start_title"></span></h1>
            <div>
                <a href="{{route('admin.crm.order.create', ['schedule_id'=>$schedule->id])}}"
                   class="btn btn-sm btn-outline-primary">
                    <i class="fa fa-plus"></i> Створити замовлення
                </a>
            </div>
        </div>

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
                            <th>Опубліковано</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <a href="{{route('admin.tour.schedule.index', $tour)}}" target="_blank">
                                    {{$tour->title}}
                                </a>
                            </td>
                            <td class="text-nowrap">
                                <span x-text="schedule.title"></span>
                                <a href="#" @click.prevent="editSchedule()" class="text-success">
                                    <i class="fa fa-pen-alt"></i>
                                </a>
                            </td>
                            <td x-text="schedule.price + ' ' + schedule.currency"></td>
                            <td x-text="schedule.commission + ' ' + schedule.currency"></td>
                            <td>{!! $tour->discount_title !!}</td>
                            <td>
                            <textarea type="text" x-model.debounce.500ms="schedule.admin_comment"
                                      @change="updateScheduleComment()"
                                      class="form-control form-control-sm mw-200px"></textarea>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" x-model="schedule.published" class="form-check-input"
                                           @change="togglePublished()"
                                           id="schedule_published">
                                    <label class="form-check-label" for="schedule_published"></label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @include('admin.crm.schedule.includes.modal-basic')
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-12 col-lg-8 mb-2">
                        <nav class="btn-group">
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
                               href="#">Скасування <span x-show="countOrders.cancel"
                                                         x-text="`(${countOrders.cancel})`"></span></a>
                        </nav>
                    </div>
                    <div class="col-12 col-lg-4 mb-2 text-lg-end">
                        <a href="{{route('admin.crm.schedule.show', array_merge(request()->all(), ['schedule'=>$schedule, 'export'=>1]))}}"
                           target="_blank" class="btn btn-outline-success">
                            <i class="far fa-file-excel"></i> Експортувати в Excel
                        </a>
                    </div>
                </div>


                <div class="crm-orders-table" data-ps="{suppressScrollY: true}">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>{!! alpineSortLink('id', 'ID') !!}</th>
                            <th>{!! alpineSortLink('status', 'Статус') !!}</th>
                            <th>{!! alpineSortLink('places', 'Осіб') !!}</th>
                            <th>ПІБ</th>
                            <th>Дата</th>
                            <th></th>
                            <th>Контакти</th>
                            <th></th>
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
                                    <button type="button" @click.prevent="editStatus(order)" class="btn border btn-sm"
                                            :class="'bg-status-'+order.status">
                                        <span x-text="statusText(order.status)"></span>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <span x-text="order.total_places"></span>
                                    <a href="#" class="text-success" @click.prevent="editParticipants(order)">
                                        <i class="fa fa-pen-alt"></i>
                                    </a>
                                </td>
                                <td class="text-nowrap" x-html="participantNames(order)"></td>
                                <td class="text-nowrap" x-html="participantDates(order)"></td>
                                <td>
                                    <a href="#" class="text-success" @click.prevent="editParticipants(order)">
                                        <i class="fa fa-pen-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="text-nowrap">
                                        <span x-text="order.last_name + ' ' + order.first_name"></span>
                                    </div>
                                    <div x-show="order.phone" class="text-nowrap">
                                        <b>Тел:</b>
                                        <a :href="'tel:'+order.phone" x-text="order.phone" target="_blank"></a>
                                    </div>
                                    {{--                                    <div x-show="order.viber" class="text-nowrap">--}}
                                    {{--                                        <b>Viber:</b>--}}
                                    {{--                                        <span x-text="order.viber"></span>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div x-show="order.email" class="text-nowrap">--}}
                                    {{--                                        <b>Email:</b>--}}
                                    {{--                                        <a x-show="order.email" :href="'mailto:'+order.email" x-text="order.email"--}}
                                    {{--                                           target="_blank"></a>--}}
                                    {{--                                    </div>--}}
                                    <template x-if="order.agency_data && order.agency_data.title"
                                              :key="'agency-data-'+order.id">
                                        <div class="mt-1 pt-1 border-top">

                                            <div class="text-nowrap">
                                                <span x-text="order.agency_data.title"></span>
                                                <span x-show="order.agency_data.affiliate"
                                                      x-text="'('+order.agency_data.affiliate+')'"></span>
                                            </div>
                                            <div class="text-nowrap" x-show="order.agency_data.manager_name">
                                                <span x-text="order.agency_data.manager_name"></span>
                                            </div>
                                            <div class="text-nowrap" x-show="order.agency_data.manager_phone">
                                                <b>Тел:</b>
                                                <a :href="'tel:'+order.agency_data.manager_phone"
                                                   x-text="order.agency_data.manager_phone" target="_blank"></a>
                                            </div>
                                            {{--                                            <div class="text-nowrap" x-show="order.agency_data.manager_email">--}}
                                            {{--                                                <a :href="'mailto:'+order.agency_data.manager_email"--}}
                                            {{--                                                   x-text="order.agency_data.manager_email" target="_blank"></a>--}}
                                            {{--                                            </div>--}}
                                        </div>
                                    </template>
                                </td>
                                <td>
                                    <a href="#" class="text-success"
                                       data-bs-toggle="modal" data-bs-target="#editModal"
                                       @click.prevent="editOrder(order)">
                                        <i class="fa fa-pen-alt"></i>
                                    </a>
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

                @include('admin.crm.schedule.includes.statistic')
            </div>
        </div>

        @include('admin.crm.schedule.includes.modal-status')
        @include('admin.crm.schedule.includes.modal-contacts')
        @include('admin.crm.schedule.includes.modal-rooms')
        @include('admin.crm.schedule.includes.modal-participants')

    </div>
@endsection
