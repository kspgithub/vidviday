<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Поселення</h3>


        @foreach($roomTypes as $key=>$roomType)
            <div class="row mb-3">
                <div class="col-2">
                    {{$roomType->title}}
                </div>
                <div class="col-10">
                    <input type="number" class="form-control"
                           name="accommodation[{{str_replace('-', '_', $roomType->slug)}}]"
                           wire:model="accommodation.{{str_replace('-', '_', $roomType->slug)}}">
                    <div class="form-text">{{$roomType->description}}</div>
                </div>
            </div>

        @endforeach


        <x-forms.textarea-group label="Інше" name="accommodation[other]" wire:model="order.accommodation.other"/>
    </x-slot>
</x-bootstrap.card>
