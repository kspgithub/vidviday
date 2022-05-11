<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інформація про виїзд</h3>
        </div>
        <div class="form-group row mb-3">
            <label for="status" class="col-md-2 col-form-label">Статус</label>
            <div class="col-md-10">
                <select name="status" id="status" x-model="order.status" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{$status['value']}}">{{$status['text']}}</option>
                    @endforeach
                </select>
            </div>
        </div><!--form-group-->
        <div class="form-group row mb-3">
            <div class="col-md-2 col-form-label">Тур <span class="text-danger">*</span></div>
            <div class="col-md-10">
                <select name="tour_id" x-model.number="order.tour_id" id="tourSelectBox" class="form-control"
                        @change="loadSchedules()"
                        required>
                    @if($order->tour)
                        <option value="{{$order->tour->id}}" selected>
                            {{$order->tour->title}} - {{$order->tour->price}} {{$order->tour->currency}}
                        </option>
                    @endif
                </select>
                <template x-if="tour">
                    <div class="form-text text-info">
                        Вартість - <b x-text="tour.price"></b> <b x-text="tour.currency"></b>,
                        Комісія - <b x-text="tour.commission"></b> <b
                            x-text="tour.currency"></b>,
                        Доплата за 1-місне поселення - <b x-text="tour.accomm_price"></b>
                        <b x-text="tour.currency"></b>
                    </div>
                </template>
            </div>
        </div>
        <div class="form-group row mb-3 align-items-center">
            <div class="col-md-2 col-form-label">Дата виїзду <span class="text-danger">*</span></div>
            <div class="col-md-10">

                <select name="schedule_id" x-model.number="order.schedule_id" class="form-control" required>
                    <option value="">оберіть дату виїзду</option>
                    <template x-for="sch in schedules" :key="'shc-'+sch.id">
                        <option :value="sch.id" x-text="sch.start_title"
                                x-bind:selected="sch.id === order.schedule_id"></option>
                    </template>
                </select>
                <template x-if="selectedSchedule">
                    <div class="form-text text-info">
                        Вартість - <b x-text="selectedSchedule.price"></b> <b x-text="selectedSchedule.currency"></b>,
                        Комісія - <b x-text="selectedSchedule.commission"></b> <b
                            x-text="selectedSchedule.currency"></b>,
                        Доплата за 1-місне поселення - <b x-text="selectedSchedule.accomm_price"></b> <b
                            x-text="selectedSchedule.currency"></b>,
                        Кількість вільних місць - <b x-text="selectedSchedule.places_available"></b>
                    </div>
                </template>
            </div>

        </div>
        <x-forms.text-group type="number" x-model.number="order.places" name="places" label="Дорослих" required/>
        <div class="form-group row mb-3 align-items-center">
            <div class="col-md-2 col-form-label">З дітьми</div>
            <div class="col-md-3">
                <x-input.switch id="children" x-model="order.children"/>
                <input type="hidden" name="children" :value="order.children ? 1 : 0">
            </div>
        </div>
        <template x-if="order.children">
            <div class="form-group row mb-3 align-items-center">
                <div class="col-md-2 col-form-label">Діти до 6 років<span
                        class="text-danger">*</span></div>
                <div class="col-md-3">
                    <input type="text" required class="form-control" name="children_young"
                           x-model.number="order.children_young">
                </div>
                <div class="col-auto"> з місцем в автобусі</div>
            </div>
        </template>
        <template x-if="order.children">
            <div class="form-group row mb-3 align-items-center">
                <div class="col-md-2 col-form-label">Діти до 6 років <span
                        class="text-danger">*</span></div>
                <div class="col-md-3">
                    <input type="text" required class="form-control" name="without_place_count"
                           x-model.number="order.without_place_count">
                </div>
                <div class="col-auto"> без місця в автобусі</div>
            </div>
        </template>
        <template x-if="order.children">
            <x-forms.text-group label="Діти від 6 до 12 років" name="children_older" required
                                x-model.number="order.children_older"/>
        </template>

        <template x-if="isReserve">
            <div class="row">
                <div class="offset-md-2 col-md-10">
                    <div class="text-danger">
                        Увага! Загальна кількість місць замовлення (<b x-text="totalPayedPlaces"></b>)
                        більша ніж кількість вільних місць (<b x-text="selectedSchedule.places_available"></b>). <br>
                        Замовленю буде автоматично присвоєно статус "Резерв"
                    </div>
                </div>
            </div>
        </template>
    </div>

</div>

