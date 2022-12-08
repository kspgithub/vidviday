<div x-data='tourSchedules({
    params: @json(request()->all()),
    tour: @json($tour->shortInfo()),
    canEdit: {{$can_edit ? 'true' : 'false'}},
    canDelete: {{$can_delete ? 'true' : 'false'}},
})'>
    <div class="row mb-3">
        <div class="col-6"></div>
        <div class="col-6 text-right">
            <a href="#" x-show="canEdit" class="btn btn-sm btn-primary" @click.prevent="editSchedule()">
                <i class="fa fa-plus"></i> Додати виїзд
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive  mb-4">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{!! alpineSortLink('id', 'ID')!!}</th>
                        <th>{!! alpineSortLink('start_date', 'Дата виїзду')!!}</th>
                        <th>{!! alpineSortLink('start_time', 'Час виїзду')!!}</th>
                        <th>{!!alpineSortLink('end_date', 'Дата повернення')!!}</th>
                        <th>{!!alpineSortLink('places', 'Ліміт місць')!!}</th>
                        <th>{!!alpineSortLink('price', 'Ціна')!!}</th>
                        <th>{!!alpineSortLink('commission', 'Комісія')!!}</th>
                        <th>{!!alpineSortLink('accomm_price', 'Допл. за пос.')!!}</th>
                        <th>{!!alpineSortLink('currency', 'Валюта')!!}</th>
                        <th>{!!alpineSortLink('published', 'Опубліковано')!!}</th>
                        <th>{!!alpineSortLink('auto_booking', 'Автобронь')!!}</th>
                        <th>{!!alpineSortLink('auto_limit', 'Авто лим.')!!}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <template x-for="item in items" :key="'it'+item.id">
                        <tr>
                            <td><a :href="`/admin/crm/schedules/${item.id}`" target="_blank" x-text="item.id"></a></td>
                            <td><span x-text="item.start_date"></span></td>
                            <td><span x-text="item.start_time"></span></td>
                            <td><span x-text="item.end_date"></span></td>
                            <td><span x-text="item.places"></span></td>
                            <td class="text-right"><span x-text="item.price"></span></td>
                            <td class="text-right"><span x-text="item.commission"></span></td>
                            <td class="text-right"><span x-text="item.accomm_price"></span></td>
                            <td><span x-text="item.currency"></span></td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" x-model="item.published"
                                           @change="updateSchedule(item, {published: item.published})"
                                           :id="'it-published-'+item.id">
                                    <label class="form-check-label" :for="'it-published-'+item.id"></label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" x-model="item.auto_booking"
                                           @change="updateSchedule(item, {auto_booking: item.auto_booking})"
                                           :id="'it-auto-booking-'+item.id">
                                    <label class="form-check-label" :for="'it-auto-booking-'+item.id"></label>
                                </div>
                            </td>
                            <td><span x-text="item.auto_limit"></span></td>
                            <td>
                                <template x-if="canEdit">
                                    <a href="#" class="btn btn-sm my-1 me-2 btn-outline-success"
                                       @click.prevent="editSchedule(item)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </template>

                                <template x-if="canDelete">
                                    <a href="#" class="btn btn-sm my-1 me-2 btn-outline-danger"
                                       x-bind:readonly="!$store.crmUser.isTourManager && !$store.crmUser.isAdmin"
                                       @click.prevent="deleteSchedule(item)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </template>

                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>


            </div>
            {!! alpinePagination() !!}

        </div>
    </div>

    @include('admin.tour-schedule.includes.modal-form')
</div>
