@props([
    'name' => '',
    'id' => null,
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'type'=>'text',
    'readonly'=>false,
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'rowClass'=>'row mb-3',
])

<div class="form-group {{$rowClass}}">
    <label for="{{$id ?? $name}}" class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </label>

    <div class="{{$inputCol}}">
        <input name="{{$name}}"
               id="{{$id ?? $name}}"
               placeholder="{{ !empty($placeholder) ? $placeholder : '' }}"
               value="{{ $value}}"
            {{$readonly ? 'readonly' : ''}}
            {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' :  'form-control', 'type'=>$type]) }}
        />
        @if(!empty($help))
            <div class="form-text">{{$help}}</div>
        @endif
        @error($name)
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror

    </div>
</div><!--form-group-->
