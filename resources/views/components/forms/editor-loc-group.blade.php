@props([
    'name' => '',
    'value' => [],
    'label'=>'',
    'placeholder' => '',
    'options'=>[],
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])

<div class="form-group row mb-3">
    <div class="{{$labelCol}} col-form-label">
        {{$label}}
        @if(isset($attributes['required'])) <span class="text-danger">*</span>@endif
    </div>

    <div class="{{$inputCol}}">

        @foreach(siteLocales() as $lang)
            <div class="input-group mb-3 multilingual" data-lang="{{$lang}}"
                 x-show="trans_locale == '{{ $lang }}'">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ strtoupper($lang) }}</span>
                </div>
                <div x-data="tiny({uploadUrl: '{{route('admin.editor.upload')}}'})">
                        <textarea name="{{$name}}[{{$lang}}]"
                                  x-ref="valueRef"
                                  x-model="value"
                                  id="{{$name}}-{{$lang}}-editor"
                                  rows="10"
                                  placeholder="{{ !empty($placeholder) ? $placeholder : ''}}"
                          {{ $attributes->merge(['class' => 'form-control'])->except( $lang === 'uk' ? [] :['required']) }}
                        >{!! $value[$lang] ?? '' !!}</textarea>
                </div>

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


