@props([
    'name' => '',
    'id' => null,
    'label'=>'',
    'placeholder' => '',
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'rowClass'=>'row mb-3',
])

<div class="form-group {{$rowClass}}">
    <label for="{{$id ?? $name}}" class="{{$labelCol}} col-form-label">
        @lang($label)
        @if(isset($attributes['required']))<span lass="text-danger">*</span>@endif
    </label>

    <div class="{{$inputCol}}">
        <input name="{{$name}}"
               id="{{$id ?? $name}}"
               placeholder="{{ !empty($placeholder) ? $placeholder : '' }}"
               type="file"
            {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' :  'form-control']) }}
        />
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
