@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'type'=>'text',
    'readonly'=>false,
    'requiredLocales'=>['uk'],
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'wireModel' => $attributes->wire('model'),
])

<div class="form-group row mb-3">
    <div class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </div>

    <div class="{{$inputCol}}">
        @foreach(siteLocales() as $lang)
            <div class="input-group mb-3 multilingual" data-lang="{{$lang}}"
                 x-show="trans_locale == '{{ $lang }}' || trans_expanded">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ strtoupper($lang) }}</span>
                </div>
                <textarea name="{{$name}}[{{$lang}}]"
                          id="{{$name}}-{{$lang}}"
                          {{$readonly ? 'readonly' : ''}}
                          placeholder="{{ !empty($placeholder) ? $placeholder : ''}}"
                          {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' :  'form-control'])->except(['required', ...($wireModel->directive ? [$wireModel->directive] : [])]) }}
                          x-bind:required="{{ $attributes['required'] ? 'true' : 'false' }} && locales.includes('{{ $lang }}')"
                @if($wireModel->value)
                    {{ $wireModel->directive }}="{{ $wireModel->value }}.{{$lang}}"
                @endif
                >{{  $value[$lang] ?? '' }}</textarea>

                @error($name. '.' . $lang)
                <div class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
                @error('form.' . $name. '.' . $lang)
                <div class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror

            </div>
        @endforeach

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
