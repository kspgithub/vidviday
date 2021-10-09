<div class="form-group row mb-3">
    <label for="name" class="col-md-2 col-form-label">
        @lang('Translations')
    </label>

    <div class="col-md-10">
        <div class="d-flex align-items-center">
            @foreach(siteLocales() as $lang)
                <a href="#" @click="trans_locale = '{{ $lang }}'"
                   :class="{['btn-primary']: trans_locale === '{{ $lang }}'}"
                   :disabled="trans_locale === '{{ $lang }}'"
                   class="btn btn-md btn-default">{{strtoupper($lang)}}</a>
            @endforeach
        </div>
    </div>
</div>
