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
        @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
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
                    {{ $attributes->merge(['class' => 'form-control', 'type'=>$type])->except( $lang === 'uk' ? [] :['required']) }}
                />
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
