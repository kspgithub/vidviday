@props([
    'name' => 'tour_id',
    'id' => null,
    'value' => null,
    'tour' => null,
    'label'=>'Тур',
    'placeholder' => '',
    'type'=>'text',
    'readonly'=>false,
    'help'=>'',
    'options'=>[],
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'rowClass'=>'row mb-3',
])

<div class="form-group {{$rowClass}}">
    <label for="tour_id" class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="{{$inputCol}}">
        <x-input.select2 name="{{$name}}"
                         :value="$value"
                         url="/api/tours/select-box"
        
        >
            @if($tour)
                <option value="{{$tour->id}}" selected>
                    {{$tour->title}} - {{$tour->price}} {{$tour->currency}}
                </option>
            @endif
        </x-input.select2>
    </div>
</div><!--form-group-->

