@props([
    'name' => '',
    'id' => null,
    'value' => null,
    'item' => null,
    'label'=>'',
    'placeholder' => '',
    'type'=>'text',
    'readonly'=>false,
    'help'=>'',
    'options'=>[],
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'rowClass'=>'row mb-3',
    'url'=>'',
])

<div class="form-group {{$rowClass}}">
    <label :for="{{$name}}" class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="{{$inputCol}}">
        <x-input.select2 name="{{$name}}"
                         :value="$value"
                         url="{{$url}}"
        >
            @if($item)
                <option value="{{$item['value']}}" selected>
                    {{$item['text']}}
                </option>
            @endif
        </x-input.select2>
    </div>
</div><!--form-group-->

