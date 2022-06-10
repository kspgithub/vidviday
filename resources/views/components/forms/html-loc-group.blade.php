@props([
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])

<div class="form-group row mb-3">
    <div class="{{$labelCol}} col-form-label">
        {{$label}}
    </div>

    <div class="{{$inputCol}}">
        @foreach(siteLocales() as $lang)
            <div class="mb-3 row"data-lang="{{$lang}}"
                 x-show="trans_locale == '{{ $lang }}' || trans_expanded">
                <div class="col-auto">{{$lang}}</div>
                <div class="col">
                    <div class="border p-2">{!! $value[$lang] ?? $placeholder !!}</div>
                </div>
            </div>
        @endforeach

    </div>
</div><!--form-group-->
