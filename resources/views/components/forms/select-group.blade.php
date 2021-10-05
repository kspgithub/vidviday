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
    'rowClass'=>'row mb-3',
])


<div class="form-group {{$rowClass}}">
    <label for="{{$name}}" class="{{$labelCol}} col-form-label">@lang($label)@if(isset($attributes['required'])) <span
            class="text-danger">*</span>@endif</label>

    <div class="{{$inputCol}}">

        <select name="{{$name}}"
                id="{{$name}}"
            {{$readonly ? 'readonly' : ''}}
            {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' :  'form-control']) }}
        >
            {{$slot}}
            @foreach($options as $option)
                <option
                    value="{{ $option['value']}}" {{$option['value'] === $value ? 'selected' : ''}}>{{ $option['text']}}</option>
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
