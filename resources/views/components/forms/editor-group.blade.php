@props([
    'name' => '',
    'id' => null,
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'options'=>[],
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'rows'=>5,
    'ignore'=>'wire:ignore'
])

<div class="form-group row mb-3" {{$ignore}}>
    <label for="{{$id ?? $name}}-editor" class="{{$labelCol}} col-form-label">
        @lang($label)
        @if(isset($attributes['required']) && $attributes['required'])
            <span x-text="locales.indexOf('{{$id}}'.split('_').pop()) > -1 ? '*' : ''" class="text-danger"></span>
        @endif
    </label>

    <div class="{{$inputCol}} ">
        <div x-data="tiny({uploadUrl: '{{route('admin.editor.upload')}}'})">
                        <textarea name="{{$name}}"
                                  x-ref="valueRef"
                                  x-model="value"
                                  id="{{$id ?? $name}}-editor"
                                  rows="10"
                                  placeholder="{{ !empty($placeholder) ? $placeholder : ''}}"
                          {{ $attributes->merge(['class' => 'form-control'])}}
                        >{!! $value ?? '' !!}</textarea>
        </div>
        @error($name)
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror

    </div>
</div><!--form-group-->
