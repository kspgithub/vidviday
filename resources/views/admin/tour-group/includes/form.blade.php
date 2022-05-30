<div>
    <x-bootstrap.card>
        <x-slot name="header"><h3>@lang('Basic Information')</h3></x-slot>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $tourGroup->getTranslations('title'))"
                                    required></x-forms.text-loc-group>
            <x-forms.text-loc-group name="slug" :label="__('Url')"
                                    :value="old('slug', $tourGroup->getTranslations('slug'))"
                                    required></x-forms.text-loc-group>

            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $tourGroup->getTranslations('text'))"></x-forms.editor-loc-group>

        </x-slot>

    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $tourGroup->getTranslations('seo_h1'))"/>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $tourGroup->getTranslations('seo_title'))"/>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $tourGroup->getTranslations('seo_description'))"/>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords',  $tourGroup->getTranslations('seo_keywords'))"/>
            <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                      :value="old('seo_text', $tourGroup->getTranslations('seo_text'))"></x-forms.editor-loc-group>
        </x-slot>
    </x-bootstrap.card>

    @if($tourGroup->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Pictures')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$tourGroup"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif
</div>


