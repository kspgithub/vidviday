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

        <x-forms.textarea-group label="Коментар" name="comment" wire:model.defer="order.comment"/>


    </x-slot>
</x-bootstrap.card>
