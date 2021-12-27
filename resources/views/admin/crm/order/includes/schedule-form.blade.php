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
        <div class="row mb-3">
            <div class="col-md-2 col-form-label">Тур <span class="text-danger">*</span></div>
            <div class="col-md-10">
                <select name="tour_id" x-model="order.tour_id" id="tourSelectBox" class="form-control"
                        @change="loadSchedules()"
                        required>
                    @if($order->tour)
                        <option value="{{$order->tour->id}}" selected>
                            {{$order->tour->title}} - {{$order->tour->price}} {{$order->tour->currency}}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-form-label">Дата виїзду <span class="text-danger">*</span></div>
            <div class="col-md-10">

                <select name="schedule_id" x-model="order.schedule_id" class="form-control" required>
                    <option value="">оберіть дату виїзду</option>
                    <template x-for="sch in schedules" :key="'shc-'+sch.id">
                        <option :value="sch.id" x-text="sch.start_title"
                                x-bind:selected="sch.id === order.schedule_id"></option>
                    </template>
                </select>
            </div>
        </div>
        <x-forms.text-group type="number" x-model.number="order.places" name="places" label="Дорослих" required/>
        <div class="row mb-3">
            <div class="col-md-2 col-form-label">З дітьми</div>
            <div class="col-md-10">
                <x-input.switch id="children" x-model="order.children"/>
                <input type="hidden" name="children" :value="order.children ? 1 : 0">
            </div>
        </div>
        <template x-if="order.children">
            <x-forms.text-group label="Діти до 6 років" name="children_young" x-model.number="order.children_young"/>
        </template>
        <template x-if="order.children">
            <x-forms.text-group label="Діти від 6 до 12 років" name="children_older"
                                x-model.number="order.children_older"/>
        </template>
    </div>

</div>

