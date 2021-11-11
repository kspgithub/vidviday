<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Інформація про замовлення</h3>
        <div class="form-group row mb-3">
            <label for="status" class="col-md-2 col-form-label">Статус</label>
            <div class="col-md-10">
                <select name="order.status" id="status" wire:model="order.status" class="form-control">
                    @foreach($orderStatuses as $value=>$text)
                        <option value="{{$value}}">{{$text}}</option>
                    @endforeach
                </select>
            </div>
        </div><!--form-group-->
        <div class="form-group row mb-3">
            <div class="col-12 col-md-2">Тип групи</div>
            <div class="col-12 col-md-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model="order.group_type"
                           name="order.group_type" id="group_type_0" value="0">
                    <label class="form-check-label" for="group_type_0">
                        Збірна
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model="order.group_type"
                           name="order.group_type" id="group_type_1" value="1">
                    <label class="form-check-label" for="group_type_1">
                        Корпоративна
                    </label>
                </div>
            </div>
        </div>
        @if((int) $order->group_type === 1)
            <div class="form-group row mb-3">
                <div class="col-12 col-md-2">Тип програми</div>
                <div class="col-12 col-md-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="order.program_type"
                               name="order.program_type" id="program_type_0" value="0">
                        <label class="form-check-label" for="program_type_0">
                            Готовий тур
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="order.program_type"
                               name="order.program_type" id="program_type_1" value="1">
                        <label class="form-check-label" for="program_type_1">
                            Скласти тур
                        </label>
                    </div>
                </div>
            </div>
        @endif
        @if((int) $order->program_type === 0 || (int) $order->group_type === 0)
            <div class="form-group row mb-3">
                <label for="tour_id" class="col-md-2 col-form-label">Тур</label>
                <div class="col-md-10">
                    <x-input.select2wire name="order.tour_id" wire:model="order.tour_id"
                                         url="/api/tours/select-box"
                    >
                        @if($this->tour)
                            <option value="{{$this->tour->id}}" selected>
                                {{$this->tour->title}} - {{$this->tour->price}} {{$this->tour->currency}}
                            </option>
                        @endif
                    </x-input.select2wire>
                </div>
            </div><!--form-group-->


            <x-forms.select-group label="Дата виїзду" name="order.schedule_id" wire:model="order.schedule_id"
                                  :row-class="(int)$order->group_type === 0 ? 'row mb-3' : 'row mb-3 d-none'">
                <option value="">Не вибрано</option>
                @foreach($this->schedules as $schedule)
                    <option value="{{$schedule->id}}">
                        {{$schedule->start_title}} - {{$schedule->price}} {{$schedule->currency}}
                    </option>
                @endforeach
            </x-forms.select-group>
        @endif
        <div class="form-group row mb-3 {{(int)$order->group_type === 0 ? 'd-none' : '' }}">
            <label for="start_date" class="col-md-2 col-form-label">Дата виїзду</label>
            <div class="col-md-10">
                <x-input.datepicker name="order.start_date" wire:model="order.start_date"/>
            </div>
        </div><!--form-group-->

        <div class="form-group row mb-3 {{(int)$order->group_type === 0 ? 'd-none' : '' }}">
            <label for="start_place" class="col-md-2 col-form-label">Місце виїзду</label>
            <div class="col-md-10">
                <x-input.text name="order.start_place" wire:model="order.start_place"/>
            </div>
        </div><!--form-group-->

        <div class="form-group row mb-3 {{(int)$order->group_type === 0 ? 'd-none' : '' }}">
            <label for="end_date" class="col-md-2 col-form-label">Дата повернення</label>
            <div class="col-md-10">
                <x-input.datepicker name="order.end_date" wire:model="order.end_date"/>
            </div>
        </div><!--form-group-->

        <div class="form-group row mb-3 {{(int)$order->group_type === 0 ? 'd-none' : '' }}">
            <label for="end_place" class="col-md-2 col-form-label">Місце повернення</label>
            <div class="col-md-10">
                <x-input.text name="order.end_place" wire:model="order.end_place"/>
            </div>
        </div>


        <x-forms.text-group label="Кількість місць" name="places" wire:model="order.places" required/>
        <div class="form-group row mb-3">
            <div class="col-12 col-md-2">Діти</div>
            <div class="col-12 col-md-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model="order.children"
                           name="order.children" id="children_0" value="0">
                    <label class="form-check-label" for="children_0">Ні</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" wire:model="order.children"
                           name="order.children" id="children_1" value="1">
                    <label class="form-check-label" for="children_1">Так</label>
                </div>
            </div>
        </div>
        @if((int)$order->children === 1)
            <x-forms.text-group label="Діти до 6" name="order.children_young" wire:model="order.children_young"
                                required/>
            <x-forms.text-group label="Діти від 6 до 12" name="order.children_older"
                                wire:model="order.children_older" required/>
        @endif
        <x-forms.select-group label="Валюта" name="currency" wire:model="order.currency" required>
            @foreach($currencies as $iso=>$title)
                <option value="{{$iso}}">{{$title}}</option>
            @endforeach
        </x-forms.select-group>

        <x-forms.text-group label="Сума замовлення" name="order.price" wire:model="order.price" required
                            help="(повна вартість, без знижок та комісій)"/>
        <x-forms.text-group label="Комісія агента" name="order.commission" wire:model="order.commission" required/>
        <x-forms.text-group label="Сума знижки" name="order.discount" wire:model="order.discount" required/>
        <x-forms.text-group label="До сплати" name="order.price_total" value="{{$this->total}}" readonly/>

        <div class="form-group row mb-3">
            <div class="col-12 col-md-2">Тип оплати</div>
            <div class="col-12 col-md-10">
                @foreach($paymentTypes as $value=>$text)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" wire:model="order.payment_type"
                               name="order.payment_type" id="payment_type_{{$value}}" value="{{$value}}">
                        <label class="form-check-label" for="payment_type_{{$value}}">{{$text}}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="pay_status" class="col-md-2 col-form-label">Статус оплати</label>
            <div class="col-md-10">
                <select name="order.payment_status" id="pay_status" wire:model="order.payment_status"
                        class="form-control">
                    <option value="0">Очікує</option>
                    <option value="1">Сплачено</option>
                    <option value="2">Повернено</option>
                </select>
            </div>
        </div><!--form-group-->
    </x-slot>
</x-bootstrap.card>
