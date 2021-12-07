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
])

<div class="form-group row mb-3">
    <div for="{{$id ?? $name}}" class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </div>

    <div class="{{$inputCol}}">
       <textarea name="{{$name}}"
                 id="{{$id ?? $name}}"
                 placeholder="{{ !empty($placeholder) ? $placeholder : $label }}"
                {{$readonly ? 'readonly' : ''}}
           {{ $attributes->merge(['class' => 'form-control', 'type'=>$type]) }}
            >{!! $value ?? '' !!}</textarea>

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
