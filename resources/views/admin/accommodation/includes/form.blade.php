<x-forms.translation-switch/>
<x-forms.text-loc-group name="title" :label="__('Title')"
                        :value="old('title', $accommodation->getTranslations('title'))" maxlength="200"
                        required></x-forms.text-loc-group>

<x-forms.text-loc-group name="slug" :label="__('Slug')" :value="old('slug',  $accommodation->getTranslations('slug'))"
                        maxlength="100"
                        :help="__('Leave blank for automatic generation')"></x-forms.text-loc-group>

<x-forms.text-loc-group name="title_where" :label="__('Title Where')"
                        :value="old('title_where',  $accommodation->getTranslations('title_where'))"
                        maxlength="200"
                        help="Наприклад: в садибах Берегівського р-ну"
                        required></x-forms.text-loc-group>

<x-forms.editor-loc-group name="text" :label="__('Description')"
                          :value="old('text',  $accommodation->getTranslations('text'))"
                          maxlength="500"></x-forms.editor-loc-group>

<x-forms.location-group
    :city-id="$accommodation->city_id"
    :city="$accommodation->city"
    :region-id="$accommodation->region_id"
    :region="$accommodation->region"
    :regions="$regions"
    :map="false"
></x-forms.location-group>



@if($accommodation->id > 0)
    <div class="form-group row mb-3">
        <div class="col-md-2 col-form-label">@lang('Pictures')</div>
        <div class="col-md-10">
            <x-utils.media-library
                :model="$accommodation"
            ></x-utils.media-library>
        </div>
    </div>
@endif
