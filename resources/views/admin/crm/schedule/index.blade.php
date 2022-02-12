@extends('admin.layout.app')

@section('title', __('Список збірних виїздів'))

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.crm.schedule.index'), 'title'=>'Список збірних виїздів'],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>Список збірних виїздів</h1>
    </div>
    <div x-data='crmSchedules({
        params: @json(request()->all()),
    })'>
        <div class="row mb-3">
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
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="only-booked" x-model="booked"
                           @change.debounce="filterChange()">
                    <label class="form-check-label" for="only-booked">Приховати виїзди без бронювань</label>
                </div>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <div class="me-2">Дати</div>
                    <div>
                        <input x-model="dates" type="text"
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
                <div class="row mb-4">
                    <div class="col-12 col-lg-8 mb-2">
                        <nav class="btn-group">
                            <a class="btn btn-outline-primary"
                               :class="{active: currentTab === 'recruited'}"
                               @click.prevent="setTab('recruited')"
                               href="#">Набираються</a>

                            <a class="btn btn-outline-primary"
                               :class="{active: currentTab === 'progress'}"
                               @click.prevent="setTab('progress')"
                               href="#">Проводяться</a>

                            <a class="btn btn-outline-primary"
                               :class="{active: currentTab === 'canceled'}"
                               @click.prevent="setTab('canceled')"
                               href="#">Скасовані</a>

                            <a class="btn btn-outline-primary"
                               :class="{active: currentTab === 'finished'}"
                               @click.prevent="setTab('finished')"
                               href="#">Проведені</a>

                        </nav>
                    </div>
                    <div class="col-12 col-lg-4 mb-2 text-lg-end">

                    </div>
                </div>

                <div data-ps="{suppressScrollY: true}">
                    <table class="table table-sm" x-bind:class="{loading: loading}">
                        <thead>
                        <tr>
                            <th>{!! alpineSortLink('id', 'ID') !!}</th>
                            <th>{!! alpineSortLink('start_date', 'Дата туру') !!}</th>
                            <th class="mw-200px">Тур</th>
                            <th>Менеджер</th>
                            <th class="text-right text-nowrap">Вільн.</th>
                            <th class="text-right text-nowrap">Нові</th>
                            <th class="text-right">Бронь</th>
                            <th class="text-right">Оплата</th>
                            <th class="text-right">Ліміт</th>
                            <th class="text-right">Резерв</th>
                            <th>Гід</th>
                            <th>Автобус</th>
                            <th class="text-nowrap">Черговий - транспорт</th>
                            <th class="text-nowrap">Черговий - дзвінки</th>
                            <th>Примітки</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template x-for="item in items" :key="'sch-'+item.id">
                            <tr x-data='crmScheduleRow(item)'>
                                <td>
                                    <a :href="scheduleUrl" x-text="schedule.id" target="_blank"></a>
                                </td>
                                <td class="text-nowrap">
                                    <span x-text="schedule.start_title"></span>
                                </td>
                                <td>
                                    <a :href="tourUrl" x-text="tourTitle" target="_blank"></a>
                                </td>
                                <td>
                                    <span class="text-nowrap" x-text="tourManager"></span>
                                </td>
                                <td class="text-center">
                                    <span x-text="placesAvailable"></span>
                                </td>
                                <td class="text-center">
                                    <span x-text="schedule.places_new"></span>
                                </td>
                                <td class="text-center">
                                    <span x-text="schedule.places_booked"></span>
                                </td>
                                <td class="text-center">
                                    <span x-text="schedule.places_payed"></span>
                                </td>
                                <td>
                                    <input type="text" x-model.debounce.500ms="schedule.places"
                                           class="form-control form-control-sm mw-50px text-right">
                                </td>
                                <td class="text-center">
                                    <span x-text="schedule.places_reserved"></span>
                                </td>
                                <td>
                                     <textarea type="text" x-model.debounce.500ms="schedule.guide"
                                               class="form-control form-control-sm mw-150px "></textarea>
                                </td>
                                <td>
                                     <textarea type="text" x-model.debounce.500ms="schedule.bus"
                                               class="form-control form-control-sm mw-150px "></textarea>
                                </td>
                                <td>
                                <textarea type="text" x-model.debounce.500ms="schedule.duty_transport"
                                          class="form-control form-control-sm mw-150px "></textarea>
                                </td>
                                <td>
                                <textarea type="text" x-model.debounce.500ms="schedule.duty_call"
                                          class="form-control form-control-sm mw-150px "></textarea>
                                </td>
                                <td>
                                <textarea type="text" x-model.debounce.500ms="schedule.admin_comment"
                                          class="form-control form-control-sm mw-150px "></textarea>
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
@endsection
