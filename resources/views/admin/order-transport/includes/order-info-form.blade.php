<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Інформація про замовлення</h3>
        <div class="form-group row mb-3">
            <label for="status" class="col-md-2 col-form-label">Статус</label>
            <div class="col-md-10">
                <select name="order.status" id="status" wire:model.defer="order.status" class="form-control">
                    @foreach($orderStatuses as $value=>$text)
                        <option value="{{$value}}">{{$text}}</option>
                    @endforeach
                </select>
            </div>
        </div><!--form-group-->

        <div class="form-group row mb-3">
            <label for="start_date" class="col-md-2 col-form-label">Дата виїзду</label>
            <div class="col-md-10">
                <x-input.datepicker name="order.start_date" wire:model.defer="order.start_date"/>
            </div>
        </div><!--form-group-->

        <div class="form-group row mb-3">
            <label for="end_date" class="col-md-2 col-form-label">Дата повернення</label>
            <div class="col-md-10">
                <x-input.datepicker name="order.end_date" wire:model.defer="order.end_date"/>
            </div>
        </div><!--form-group-->
        <x-forms.text-group :label="__('forms.duration')" name="duration" wire:model.defer="order.duration"/>
        <x-forms.text-group label="Кількість пасажирів" name="places" wire:model.defer="order.places" required/>
        <x-forms.text-group :label="__('forms.route')" name="route" wire:model.defer="order.route"/>
        <div class="form-group row mb-3 align-items-center">
            <div class="m-0 col-md-2 col-form-label">
                <span class="form-check-label">Вікова група</span>
            </div>
            <div class="m-0 col-md-10">
                @foreach($ageGroups as $value=>$text)
                    <div class="form-check ms-1">
                        <input class="form-check-input" name="age_group[]"
                               wire:model.defer="order.age_group"
                               value="{{$value}}" type="checkbox" id="age_group_{{$value}}">
                        <label class="form-check-label" for="age_group_{{$value}}">{{$text}}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <x-forms.textarea-group label="Коментар" name="comment" wire:model.defer="order.comment"/>


    </x-slot>
</x-bootstrap.card>
