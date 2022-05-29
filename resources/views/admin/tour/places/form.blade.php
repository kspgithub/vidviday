<div x-data='tourPlaces({
    locales: @json(siteLocales()),
    place: @json($model->place),
    model: @json($model),
    regions: @json($regions),
    districts: @json($districts),
    places: @json($places),
})'>
    <x-forms.translation-switch/>

    <x-forms.select-group :value="old('region_id', $model->region_id)"
                          select2="true"
                          name="region_id"
                          x-model.number="model.region_id"
                          :label="__('Region')">
        <option value="0">Не вибано</option>
        <template x-for="option in regions">
            <option x-bind:value="option.value" x-bind:selected="option.value == model.region_id"
                    x-html="option.text"></option>
        </template>
    </x-forms.select-group>

    <x-forms.select-group :value="old('district_id', $model->district_id)"
                          select2="true"
                          name="district_id"
                          x-model.number="model.district_id"
                          :label="__('District')">
        <option value="0">Не вибано</option>
        <template x-for="option in districts">
            <option x-bind:value="option.value" x-bind:selected="option.value == model.district_id"
                    x-html="option.text"></option>
        </template>
    </x-forms.select-group>

    <x-forms.select-group :value="old('place_id', $model->place_id)"
                          select2="true"
                          name="place_id"
                          x-model.number="model.place_id"
                          :label="__('Template')">
        <option value="0">Не вибано</option>
        <template x-for="option in placeOptions(model)">
            <option x-bind:value="option.value" x-bind:selected="option.value == model.place_id"
                    x-html="option.text"></option>
        </template>
    </x-forms.select-group>


    <template x-if="model.place_id === 0 || !place">
        <div>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $model->getTranslations('title'))"/>
            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $model->getTranslations('text'))"/>
        </div>
    </template>
    <template x-if="model.place_id > 0 && place">
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
                                <div x-html="place?.text[loc] || ''" class="border p-2"></div>
                            </div>

                        </div>

                    </template>

                </div>
            </div>
        </div>

    </template>


</div>
