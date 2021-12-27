<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Інформація про корпоратив</h3>
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
        <div class="row mb-3">
            <div class="col-md-2 col-form-label">Тип програми</div>
            <div class="col-md-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" x-model.number="order.program_type" type="radio"
                           name="program_type" value="0" id="program_type_0">
                    <label class="form-check-label" for="program_type_0">
                        Готовий тур
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" x-model.number="order.program_type" type="radio"
                           name="program_type" value="1" id="program_type_1">
                    <label class="form-check-label" for="program_type_1">
                        Скласти тур
                    </label>
                </div>
            </div>

        </div>


        <div class="row mb-3" x-show="order.program_type === 0">
            <div class="col-md-2 col-form-label">Тур <span class="text-danger">*</span></div>
            <div class="col-md-10">
                <select name="tour_id" x-model.number="order.tour_id" id="tourSelectBox" class="form-control"
                        :required="order.program_type === 0">
                    @if($order->tour)
                        <option value="{{$order->tour->id}}" selected>
                            {{$order->tour->title}} - {{$order->tour->price}} {{$order->tour->currency}}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-3" x-show="order.program_type === 1">
            <div class="col-md-2 col-form-label">План туру <span class="text-danger">*</span></div>
            <div class="col-md-10">
                <textarea x-model="order.tour_plan" name="tour_plan" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-form-label">
                Дата виїзду <span class="text-danger">*</span>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                            <input name="start_date" x-model="order.start_date" type="text" required
                                   x-ref="startDateRef" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row mb-3">
                            <div class="col-4 col-form-label">Місце виїзду</div>
                            <div class="col-8">
                                <input name="start_place" x-model="order.start_place" type="text"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row mb-3">
            <div class="col-md-2 col-form-label">Дата повернення <span class="text-danger">*</span>
            </div>
            <div class="col-md-10">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                            <input name="end_date" x-model="order.end_date" type="text" required
                                   x-ref="endDateRef" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row mb-3">
                            <div class="col-4 col-form-label">Місце повернення</div>
                            <div class="col-8">
                                <input name="end_place" x-model="order.end_place" type="text"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <x-forms.text-group type="number" x-model.number="order.places" name="places" label="Кількість осіб"/>

        <div class="row mb-3">
            <div class="col-md-2 col-form-label">Особливості групи</div>
            <div class="col-md-10">
                <textarea x-model="order.group_comment" name="group_comment" class="form-control"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-form-label">Побажання</div>
            <div class="col-md-10">
                <textarea x-model="order.program_comment" name="program_comment" class="form-control"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2 col-form-label">Включити у вартість</div>
            <div class="col-md-10">
                <template x-for="inc in includes" :key="'inc-'+inc.value">
                    <div class="form-check form-check-inline me-5 mb-2">
                        <input class="form-check-input" x-model.number="order.price_include" type="checkbox"
                               name="price_include[]" :value="inc.value" :id="'inc-'+inc.value">
                        <label class="form-check-label" :for="'inc-'+inc.value" x-text="inc.text"></label>
                    </div>
                </template>
            </div>
        </div>
    </div>

</div>

