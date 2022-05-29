<div x-data='tourLanding({
    locales: @json(siteLocales()),
    landing: @json($model->landing),
    model: @json($model),
    landings: @json($landings),
    options: @json($options),
})'>
    <x-forms.translation-switch/>

    <x-forms.select-group :value="old('landing_id', $model->landing_id)"
                          select2="true"
                          name="landing_id"
                          x-model.number="model.landing_id"
                          :label="__('Template')">
        <option value="0">Не вибано</option>
        <template x-for="option in options">
            <option x-bind:value="option.value" x-bind:selected="option.value === model.landing_id"
                    x-text="option.text"></option>
        </template>
    </x-forms.select-group>

    <template x-if="model.landing_id === 0 || !landing">
        <div>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $model->getTranslations('title'))"/>
            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $model->getTranslations('text'))"/>
        </div>
    </template>
    <template x-if="model.landing_id > 0 && landing">
        <div>
            <x-forms.text-loc-group name="title" :label="__('Суфікс')"
                                    :value="old('title', $model->getTranslations('title'))"/>
            <div class="row mb-3">
                <div class="col-md-2">@lang('Text')</div>
                <div class="col-md-10">
                    <template x-for="loc in locales">
                        <div class="mb-3 row">
                            <div x-text="loc.toUpperCase()" class="col-auto"></div>
                            <div class="col">
                                <div x-html="landing?.description[loc] || ''" class="border p-2"></div>
                            </div>

                        </div>

                    </template>

                </div>
            </div>
        </div>

    </template>


</div>
