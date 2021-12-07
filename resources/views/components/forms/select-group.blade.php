@props([
    'name' => '',
    'id' => null,
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
    'select2'=>false
])


<div class="form-group {{$rowClass}}">
    <div class="{{$labelCol}} col-form-label">
        @lang($label)
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </div>

    <div class="{{$inputCol}}">
        <div
            @if($select2)
            x-data="{value: ''}"
            x-init="
                jQuery($refs.input).select2({
                    theme: 'bootstrap-5',
                });
             "
            @endif
        >
            <select name="{{$name}}"
                    id="{{$id ?? $name}}"
                    {{$readonly ? 'readonly' : ''}}
                    {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' :  'form-control']) }}
                    @if($select2)
                    x-ref="input"
                @endif
            >
                {{$slot}}
                @foreach($options as $option)
                    <option
                        value="{{ $option['value']}}" {{$option['value'] === $value ? 'selected' : ''}}>{{ $option['text']}}</option>
                @endforeach
            </select>
        </div>
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
