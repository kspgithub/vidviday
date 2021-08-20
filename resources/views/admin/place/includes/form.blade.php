<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $place->title)" maxlength="100"
                            required></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $place->slug)" maxlength="100"
                            :help="__('Leave blank for automatic generation')"></x-forms.text-group>
        <x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $place->text)"
                              required></x-forms.editor-group>

        <x-forms.select-group name="direction_id" :label="__('Direction')"
                              :value="old('direction_id', $place->direction_id)"
                              :options="$directions"
                              required></x-forms.select-group>


        <x-forms.location-group
            :city-id="$place->city_id"
            :city="$place->city"
            :region-id="$place->region_id"
            :region="$place->region"
            :regions="$regions"
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
        <x-forms.text-group name="seo_h1" :label="__('SEO H1')"
                            :value="old('seo_h1', $place->seo_h1)"></x-forms.text-group>
        <x-forms.text-group name="seo_title" :label="__('SEO Title')"
                            :value="old('seo_title', $place->seo_title)"></x-forms.text-group>
        <x-forms.text-group name="seo_description" :label="__('SEO Description')"
                            :value="old('seo_description', $place->seo_description)"></x-forms.text-group>
        <x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')"
                            :value="old('seo_keywords', $place->seo_keywords)"></x-forms.text-group>
    </x-slot>
</x-bootstrap.card>

@if($place->id > 0)
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Gallery')</h3>
        </x-slot>
        <x-slot name="body">
            <x-utils.media-library
                :store-url="route('admin.media.store', ['model_type'=>get_class($place), 'model_id'=>$place->id])"
                :destroy-url="route('admin.media.destroy', 0)"
                :update-url="route('admin.media.update', 0)"
                :items="$place->getMedia()"
            ></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>
@endif
