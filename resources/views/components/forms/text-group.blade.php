@props([
    'name' => '',
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
    <label for="{{$name}}" class="{{$labelCol}} col-form-label">@lang($label)@if(isset($attributes['required'])) <span
            class="text-danger">*</span>@endif</label>

    <div class="{{$inputCol}}">
        <input name="{{$name}}"
               id="{{$name}}"
               placeholder="{{ !empty($placeholder) ? $placeholder : '' }}"
               value="{{ $value}}"
            {{$readonly ? 'readonly' : ''}}
            {{ $attributes->merge(['class' => 'form-control', 'type'=>$type]) }}
        />
        @if(!empty($help))
            <div class="form-text">{{$help}}</div>
        @endif
        @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror

    </div>
</div><!--form-group-->
