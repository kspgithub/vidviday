<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3 fw-bold">Поселення</h3>


        @foreach($roomTypes as $roomType)
            <div class="row mb-3">
                <div class="col-2">
                    {{$roomType['text']}}
                </div>
                <div class="col-10">
                    <input type="number" class="form-control"
                           name="accommodation[{{str_replace('-', '_', $roomType['value'])}}]"
                        {!! 'x-model.number="accommodation[\''.str_replace('-', '_', $roomType['value']).'\']"' !!}
                    >
                    <div class="form-text">{{$roomType['description']}}</div>

                </div>
            </div>

        @endforeach


        <x-forms.textarea-group label="Інше" name="accommodation[other_text]" x-model="accommodation.other_text"/>
    </x-slot>
</x-bootstrap.card>

