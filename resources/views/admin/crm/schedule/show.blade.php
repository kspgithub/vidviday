@extends('admin.layout.app')

@section('title', 'Дані про виїзд: '.$tour->title.', '.$schedule->start_title)

@section("content")

    <div x-data='crmScheduleItem({
        params: @json(request()->all()),
        schedule:@json($schedule->asCrmSchedule()),
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
                            <th>Допл. за поселення</th>
                            <th>Знижка</th>
                            <th>Ліміт</th>
                            <th>Авто</th>
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
                            <td class="text-nowrap" x-text="schedule.price + ' ' + schedule.currency"></td>
                            <td class="text-nowrap" x-text="schedule.commission + ' ' + schedule.currency"></td>
                            <td class="text-nowrap" x-text="schedule.accomm_price + ' ' + schedule.currency"></td>
                            <td>{!! $tour->discount_title !!}</td>
                            <td>
                                <input type="text" x-model.debounce.500ms="schedule.places"
                                       @change="updateSchedule({places: schedule.places})"
                                       class="form-control form-control-sm mw-50px"/>
                            </td>
                            <td class="text-nowrap">
                                <div class="d-flex align-items-center">

                                    <input type="text" x-model.debounce.500ms="schedule.auto_limit"
                                           @change="updateSchedule({auto_limit: schedule.auto_limit})"
                                           class="form-control form-control-sm mw-50px me-1 text-right d-inline-block">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               @change="updateSchedule({auto_booking: schedule.auto_booking})"
                                               x-model="schedule.auto_booking" :id="'auto-'+schedule.id">
                                        <label class="form-check-label" :for="'auto-'+schedule.id"></label>
                                    </div>
                                </div>

                            </td>
                            <td>
                            <textarea type="text" x-model.debounce.500ms="schedule.admin_comment"
                                      x-bind:readonly="!(schedule.manager?.user_id === $store.crmUser.user.id || $store.crmUser.isAdmin)"
                                      @change="updateSchedule({admin_comment: schedule.admin_comment})"
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
                <form method="post" @submit.prevent="uploadInfoList">
                    <x-forms.single-file-upload name="info_sheet" :value="$schedule->info_sheet"
                                                :label="__('Info list')"/>

                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </form>
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
                           @click.prevent="exportOrders"
                           target="_blank" class="btn btn-outline-success">
                            <i class="far fa-file-excel"></i> Експортувати в Excel
                        </a>
                    </div>
                </div>


                <div class="crm-orders-table" data-ps="{suppressScrollY: true}">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th><input type="checkbox" @change="selectAllOrders"></th>
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
                            <th>Коментарі (черг.)</th>
                            <th>Примітки (мен.)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="order in orders" :key="'order-'+order.id">
                            <tr x-bind:class="'order-row-'+order.status">
                                <td><input type="checkbox" x-bind:value="order.id" x-model="selectedOrders"></td>
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
                                        <a :href="'tel:'+clearPhone(order.phone)" x-text="clearPhone(order.phone)"
                                           target="_blank"></a>
                                    </div>
                                    <div x-show="order.email" class="text-nowrap">
                                        <a x-show="order.email" :href="'mailto:'+order.email" x-text="order.email"
                                           target="_blank"></a>
                                    </div>
                                    <div x-show="order.viber" class="text-nowrap">
                                        <span x-text="clearPhone(order.viber)"></span>
                                    </div>
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
                                                <a :href="'tel:'+clearPhone(order.agency_data.manager_phone)"
                                                   x-text="clearPhone(order.agency_data.manager_phone)"
                                                   target="_blank"></a>
                                            </div>
                                            <div class="text-nowrap" x-show="order.agency_data.manager_email">
                                                <a :href="'mailto:'+order.agency_data.manager_email"
                                                   x-text="order.agency_data.manager_email" target="_blank"></a>
                                            </div>
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
                                                <template
                                                    x-if="val > 0 && key && key !== 'other' && key !== 'other_text'">
                                                    <div class="text-nowrap">
                                                        <b x-text="roomTitle(key)+':'"></b>
                                                        <span x-text="val"></span>
                                                    </div>
                                                </template>
                                            </template>
                                            <template x-if="!!order.accommodation?.other">
                                                <div :key="'ord-accomm-other-'+order.id">
                                                    <b>Інше:</b>
                                                    <span x-text="order.accommodation?.other_text || ''"></span>
                                                </div>
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
                                           @click="if ($event.target.value == 0) $event.target.value = ''"
                                           x-model.debounce.500ms="order.payment_fop" placeholder="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-right mw-80px w-80px"
                                           @blur="updateOrder(order.id, {payment_tov: order.payment_tov})"
                                           @click="if ($event.target.value == 0) $event.target.value = ''"
                                           x-model.debounce.500ms="order.payment_tov" placeholder="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-right mw-80px w-80px"
                                           @blur="updateOrder(order.id, {payment_office: order.payment_office})"
                                           @click="if ($event.target.value == 0) $event.target.value = ''"
                                           x-model.debounce.500ms="order.payment_office" placeholder="0">
                                </td>
                                <td class="text-right text-nowrap">
                                    <span x-text="paymentGet(order)"></span>
                                    <span x-text="order.currency"></span>
                                </td>
                                <td>
                                    <textarea type="text" x-model.debounce.500ms="order.duty_comment"
                                              @blur="updateOrder(order.id, {duty_comment: order.duty_comment})"
                                              x-bind:readonly="!$store.crmUser.isDutyManager && !$store.crmUser.isAdmin"
                                              class="form-control form-control-sm mw-200px"></textarea>
                                </td>
                                <td>
                                    <textarea type="text" x-model.debounce.500ms="order.admin_comment"
                                              @blur="updateOrder(order.id, {admin_comment: order.admin_comment})"
                                              x-bind:readonly="!$store.crmUser.isTourManager && !$store.crmUser.isAdmin"
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
