<div x-data='tourLanding({
    locales: @json(siteLocales()),
    landing: @json($model->landing),
    model: @json($model),
    landings: @json($landings),
})'>
    <x-forms.translation-switch/>

    <x-forms.select-group name="type_id"
                          :label="__('Type')"
                          :value="old('type', $model->type)"
                          x-model="model.type"
                          x-on:change="onTypeChange"
                          required
                          :options="$types">
        <option value="0">Не вибано</option>
    </x-forms.select-group>

    <template x-if="model.type == {{$model::TYPE_TEMPLATE}}">
        <div>
            <x-forms.select-group :value="old('landing_id', $model->landing_id)"
                                  select2="true"
                                  name="landing_id"
                                  x-model="model.landing_id"
                                  :label="__('Template')">
                <option value="0">Не вибано</option>
                <template x-for="option in landingOptions">
                    <option x-bind:value="option.value" x-bind:selected="option.value === model.landing_id"
                            x-html="option.text"></option>
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
                    <x-forms.text-loc-group name="title" :label="__('title')"
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
    </template>


    <template x-if="model.type == {{$model::TYPE_CUSTOM}}">
        <div>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $model->getTranslations('title'))"
                                    required></x-forms.text-loc-group>

            <x-forms.editor-loc-group name="description" :label="__('Description')"
                                      :value="old('text', $model->getTranslations('text'))"/>

            <livewire:location-group :model="$model"/>

            {{--            <x-forms.text-group name="lat" :label="__('Latitude')" :value="old('lat', $model->lat)" required/>--}}
            {{--            <x-forms.text-group name="lng" :label="__('Longitude')" :value="old('lng', $model->lng)" required/>--}}

            <x-forms.switch-group name="published" :label="__('Published')" :active="$model->published"/>

        </div>
    </template>


</div>
