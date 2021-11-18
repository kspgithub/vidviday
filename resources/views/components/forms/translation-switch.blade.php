@props([
    'rowClass'=>'row mb-3',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])
<div class="form-group {{$rowClass}}">
    <div class="col-form-label {{$labelCol }}">
        @lang('Translations')
    </div>

    <div class="{{$inputCol}}">
        <div class="d-flex align-items-center">
            @foreach(siteLocales() as $lang)
                <a href="#" x-on:click.prevent="trans_locale = '{{ $lang }}'"
                   :class="{['btn-primary']: trans_locale === '{{ $lang }}'}"
                   :disabled="trans_locale === '{{ $lang }}'"
                   class="btn btn-md btn-default">{{strtoupper($lang)}}</a>
            @endforeach
        </div>
    </div>
</div>
