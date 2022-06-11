<div x-data='tourPlaces({
    locales: @json(siteLocales()),
    place: @json($model->place),
    model: @json($model),
    regions: @json($regions),
    districts: @json($districts),
    places: @json($places),
})'>
    <x-forms.translation-switch/>

    <pre x-html="JSON.stringify(model)"></pre>

    <x-forms.select-group x-model="model.type_id" name="type_id" :label="__('Type')"
                          :options="$types">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group :value="old('region_id', $model->region_id)"
                          select2="true"
                          name="region_id"
                          x-model="model.region_id"
                          :label="__('Region')">
        <option value="0">Оберіть область</option>
        <template x-for="option in regions">
            <option x-bind:value="option.value" x-bind:selected="option.value == model.region_id"
                    x-html="option.text"></option>
        </template>
    </x-forms.select-group>

    <x-forms.select-group name="district_id" :label="__('District')"
                          x-model="model.district_id"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/districts?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="['region_id']"
                          :options="$districts" />

    <x-forms.select-group name="place_id" :label="__('Template')"
                          x-model="model.place_id"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/places/select-box"
                          :placeholder="__('Не вибрано')"
                          :filters="['region_id', 'district_id']"
                          :options="$places"  />


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
            <x-forms.text-loc-group name="title" :label="__('Title')"
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
