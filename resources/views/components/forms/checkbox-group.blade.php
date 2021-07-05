@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'options'=>[],
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])
<div class="form-group row mb-3 align-items-center">
    <div class="m-0 {{$labelCol}} col-form-label">
        <span class="form-check-label">{{$label}}</span>
    </div>
    <div class="m-0 {{$inputCol}}">
        @foreach($options as $option)
            @php
                $option_value = is_string($option) ? $option : $option['value'];
                $option_text = is_string($option) ? $option : $option['text'];
                $option_key = str_slug($name.'-'.$option_value)
            @endphp
            <div class="form-check ms-1">
                <input class="form-check-input" {{ (is_array($value) ?  in_array($option_value, $value) :  $option_value == $value) ? 'checked' : ''}} name="{{$name}}"
                       value="{{$option_value}}" type="checkbox" id="{{$option_key}}">
                <label class="form-check-label" for="{{$option_key}}">{{$option_text}}</label>
            </div>
        @endforeach
    </div>
</div>

