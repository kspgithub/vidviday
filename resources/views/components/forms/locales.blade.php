@props([
    'value'=>[],
    'title'=>'Мовні версії',
    'fallback_locale'=>config('app.fallback_locale'),
    'useFallback' => true,
    'locales'=>siteLocales(),
])
<div class="row mb-3">
    <div class="col-md-2">{{$title}}</div>
    <div class="col-md-10">
        @if($useFallback)
            <input type="hidden" name="locales[]" value="{{$fallback_locale}}">
        @endif
        @foreach($locales as $lang)
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="locales[]" type="checkbox" x-model="locales"
                       value="{{$lang}}" id="{{'locale-'.$lang}}"
                    {{$useFallback && ($lang == $fallback_locale) ? 'disabled checked' : (in_array($lang, $value) ? 'checked' : '')}}

                >
                <label class="form-check-label" for="{{'locale-'.$lang}}">
                    {{strtoupper($lang)}}
                </label>
            </div>
        @endforeach
    </div>
</div>
