@props([
    'name' => '',
    'value' => '',
    'label' => '',
    'placeholder' => '',
    'type' => 'text',
    'readonly' => false,
    'requiredLocales' => ['uk'],
    'help' => '',
    'labelCol' => 'col-md-2',
    'inputCol' => 'col-md-10',
    'wireModel' => $attributes->wire('model'),
])

<div class="form-group row mb-3">
    <label for="{{$name}}" class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <template x-if="locales.includes(trans_locale)">
                <span class="text-danger">*</span>
            </template>
        @endif
    </label>

    <div class="{{$inputCol}}">
        @foreach(siteLocales() as $lang)
            <div class="input-group multilingual mb-1" data-lang="{{$lang}}"
                 x-show="trans_locale == '{{ $lang }}' || trans_expanded">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ strtoupper($lang) }}</span>
                </div>
                <input name="{{$name}}[{{$lang}}]"
                       id="{{$name}}-{{$lang}}"
                       placeholder="{{ !empty($placeholder) ? $placeholder : $label }}"
                       value="{{ $value[$lang] ?? '' }}"
                       {{$readonly ? 'readonly' : ''}}
                       {{ $attributes->merge(['class' => 'form-control', 'type' => $type])->except(['required', ...($wireModel->directive ? [$wireModel->directive] : [])]) }}
                       x-bind:required="{{ $attributes['required'] ? 'true' : 'false' }} && locales.includes('{{ $lang }}')"
                @if($wireModel->value)
                    {{ $wireModel->directive }}="{{ $wireModel->value }}.{{$lang}}"
                @endif
                />
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
