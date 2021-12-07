<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Додаткова інформація</h3>


        <x-forms.textarea-group label="Примітки" name="comment" wire:model="order.comment"/>

        <div class="form-group row mb-3">
            <label for="offer_date" class="col-md-2 col-form-label">Дата пропозиції</label>
            <div class="col-md-10">
                <x-input.datepicker name="offer_date" wire:model="order.offer_date" :value="$order->offer_date"/>
                <div class="form-text">До якої дати надіслати пропозицію</div>
            </div>
        </div><!--form-group-->

        <div class="form-group row mb-3">
            <div class="col-md-2 col-form-label">Тип підтвердження</div>
            <div class="col-md-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="confirmation_type" value="1"
                           wire:model="order.confirmation_type"
                           id="confirmation_type_1">
                    <label class="form-check-label" for="confirmation_type_1">Email</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="confirmation_type" value="2"
                           wire:model="order.confirmation_type"
                           id="confirmation_type_2">
                    <label class="form-check-label" for="confirmation_type_2">Viber</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="confirmation_type" value="3"
                           wire:model="order.confirmation_type"
                           id="confirmation_type_3">
                    <label class="form-check-label" for="confirmation_type_3">Телефон</label>
                </div>
            </div>
        </div><!--form-group-->

        <x-forms.text-group label="Підтвердити на" name="order.confirmation_contact"
                            wire:model="order.confirmation_contact"/>

        <div class="form-group row mb-3">
            <label for="conf_status" class="col-md-2 col-form-label">Статус підтвер.</label>
            <div class="col-md-10">
                <select name="confirmation_status" id="conf_status" wire:model="order.confirmation_status"
                        class="form-control">
                    <option value="0">Очікує на підтвердження</option>
                    <option value="1">Підтверджено</option>
                    <option value="2">Скасовано</option>
                </select>
            </div>
        </div><!--form-group-->

        @if($order->group_type === 1)
            <x-forms.textarea-group label="Група" name="group_comment" wire:model="order.group_comment"/>
            <x-forms.textarea-group label="Побажання" name="program_comment" wire:model="order.program_comment"/>

            <div class="form-group row mb-3">
                <div class="col-md-2 col-form-label">Включити до вартості</div>
                <div class="col-md-10">
                    @foreach($includeTypes as $value=>$text)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="price_include[]" value="{{$value}}"
                                   wire:model="priceInclude"
                                   id="price_include_{{$value}}">
                            <label class="form-check-label" for="price_include_{{$value}}">{{$text}}</label>
                        </div>
                    @endforeach
                </div>
            </div><!--form-group-->


        @endif
    </x-slot>
</x-bootstrap.card>
