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
])

<div class="form-group row mb-3">
    <label for="{{$name}}" class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required'])) <span class="text-danger">*</span>@endif
    </label>

    <div class="{{$inputCol}}">
         <textarea name="{{$name}}"
                   id="{{$name}}"
                   {{$readonly ? 'readonly' : ''}}
                   placeholder="{{ !empty($placeholder) ? $placeholder : ''}}"
                      {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' :  'form-control']) }}
            >{{ $value }}</textarea>
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
