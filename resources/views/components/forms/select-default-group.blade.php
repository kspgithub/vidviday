@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'type'=>'text',
    'readonly'=>false,
    'help'=>'',
    'options'=>[],
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])


<div class="form-group row mb-3">
    <label for="{{$name}}" class="{{$labelCol}} col-form-label">@lang($label)@if(isset($attributes['required'])) <span class="text-danger">*</span>@endif</label>

    <div class="{{$inputCol}}">

        <select name="{{$name}}"
                id="{{$name}}"
            {{$readonly ? 'readonly' : ''}}
            {{ $attributes->merge(['class' => 'form-control']) }}
        >
            {{$slot}}
            <option value="0" selected >{{ __("Open this select")}}</option>
            @foreach($options as $option)
                <option value="{{ $option['value']}}" {{$option['value'] === $value ? 'selected' : ''}}>{{ $option['text']}}</option>
            @endforeach
        </select>

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
