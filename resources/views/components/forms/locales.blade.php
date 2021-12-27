@props([
    'value'=>[],
    'title'=>'Мовні версії',
    'fallback_locale'=>config('app.fallback_locale'),
    'locales'=>siteLocales(),
])
<div class="row mb-3">
    <div class="col-md-2">{{$title}}</div>
    <div class="col-md-10">
        <input type="hidden" name="locales[]" value="{{$fallback_locale}}">
        @foreach($locales as $lang)
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="locales[]" type="checkbox"
                       value="{{$lang}}" id="{{'locale-'.$lang}}"
                    {{$lang == $fallback_locale ? 'disabled checked' : (in_array($lang, $value) ? 'checked' : '')}}

                >
                <label class="form-check-label" for="{{'locale-'.$lang}}">
                    {{strtoupper($lang)}}
                </label>
            </div>
        @endforeach
    </div>
</div>
