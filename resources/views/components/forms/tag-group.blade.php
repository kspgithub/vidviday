@props([
    'name' => '',
    'value' => [],
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
    <label for="{{$name}}" class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </label>

    <div class="{{$inputCol}}">
        <select name="{{$name}}"
                id="{{$name}}"
                multiple
            {{$readonly ? 'readonly' : ''}}
            {{ $attributes->merge(['class' => 'form-control select-choices']) }}
        >
            @foreach($options as $option)
                <option
                    value="{{ $option['value']}}" {{in_array($option['value'], $value) ? 'selected' : ''}}>{{ html_entity_decode($option['text'])}}</option>
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

