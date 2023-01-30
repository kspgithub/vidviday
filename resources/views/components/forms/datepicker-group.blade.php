@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'format' => 'Y-m-d',
    'type'=>'text',
    'options'=>[],
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'groupClass'=>'row',
    'time'=>'false',
    'closeOnChange'=>'true',
])

<div class="form-group {{$groupClass}} mb-3 date-picker-group"
     data-date-format="{{$format}}"
     data-time="{{$time}}"
     data-close-on-change="{{$closeOnChange}}"
     x-data="{date: '{{$value}}'}"
>
    @if($label)
        <label for="{{$name}}" class="{{$labelCol}} col-form-label">@lang($label)</label>
    @endif

    <div class="{{$label ? $inputCol : ''}}">
        <div class="input-group flatpicker">
            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
            <input name="{{$name}}"
                   data-input
                   data-date-format="{{$format}}"
                   id="{{$name}}"
                   placeholder="{{ __(!empty($placeholder) ? $placeholder : $label) }}"
                   value="{{ $value}}"
                   x-on:change="date = $event.target.value"
                {{ $attributes->merge(['class' => 'form-control', 'type'=>$type]) }} />
            <span x-show="date" class="input-group-text" data-clear><i class="fa fa-times"></i></span>
        </div>


        @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror

    </div>
</div><!--form-group-->

