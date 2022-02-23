<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.switch-group name="published" label="Опублікований" :active="old('published', $place->published)"/>

        <x-forms.translation-switch/>
        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $place->getTranslations('title'))" maxlength="100"
                                required/>
        <x-forms.text-loc-group name="slug" :label="__('Url')" :value="old('slug', $place->getTranslations('slug'))"
                                maxlength="100"
                                required/>
        <x-forms.editor-loc-group name="text" :label="__('Text')" :value="old('text', $place->getTranslations('text'))"
                                  required/>

        <x-forms.select-group name="direction_id" :label="__('Direction')"
                              :value="old('direction_id', $place->direction_id)"
                              :options="$directions"
                              required></x-forms.select-group>


        <x-forms.location-group
            :city-id="old('city_id', $place->city_id)"
            :city="$place->city"
            :region-id="old('region_id', $place->region_id)"
            :region="$place->region"
            :regions="$regions"
            :district-id="old('district_id', $place->district_id)"
            :district="$place->district"
            :districts="$districts"
            :lat="old('lat', $place->lat)"
            :lng="old('lng', $place->lng)"
        ></x-forms.location-group>

    </x-slot>
</x-bootstrap.card>


<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Seo Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.translation-switch/>
        <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                :value="old('seo_h1', $place->getTranslations('seo_h1'))"></x-forms.text-loc-group>
        <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                :value="old('seo_title', $place->getTranslations('seo_title'))"></x-forms.text-loc-group>
        <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                :value="old('seo_description', $place->getTranslations('seo_description'))"></x-forms.text-loc-group>
        <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                :value="old('seo_keywords', $place->getTranslations('seo_keywords'))"></x-forms.text-loc-group>
    </x-slot>
</x-bootstrap.card>

@if($place->id > 0)
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Gallery')</h3>
        </x-slot>
        <x-slot name="body">
            <x-utils.media-library
                :model="$place"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>
@endif
