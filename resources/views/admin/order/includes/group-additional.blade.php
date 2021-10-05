<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Інформація про групу</h3>


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

    </x-slot>
</x-bootstrap.card>

