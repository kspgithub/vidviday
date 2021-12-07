@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'options'=>[],
    'inline'=>false,
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'rowClass'=>' row mb-3 align-items-center',
    ])
<div class="{{$rowClass}}">
    <div class="m-0 col-form-label {{$labelCol}}">
        <span class="form-check-label">
            {{$label}}
            @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
                <span class="text-danger">*</span>
            @endif
        </span>
    </div>
    <div class="m-0 {{$inputCol}}">
        {{$slot}}
        @foreach($options as $option)
            @php
                $option_value = is_string($option) ? $option : $option['value'];
                $option_text = is_string($option) ? $option : $option['text'];
                $option_key = str_slug($name.'-'.$option_value)
            @endphp
            <div class="form-check  {{$inline ? 'form-check-inline me-4' : ''}}">
                <input class="form-check-input" {{$option_value == $value ? 'checked' : ''}} name="{{$name}}"
                       {{$attributes->whereStartsWith('x-')}}
                       value="{{$option_value}}" type="radio" id="{{$option_key}}">
                <label class="form-check-label" for="{{$option_key}}">{{$option_text}}</label>
            </div>
        @endforeach


        @error($name)
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror
    </div>
</div>

