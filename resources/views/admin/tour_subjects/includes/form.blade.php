<div>
    <x-bootstrap.card>
        <x-slot name="header"><h3>@lang('Basic Information')</h3></x-slot>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $tourSubject->getTranslations('title'))"
                                    required></x-forms.text-loc-group>
            <x-forms.text-loc-group name="slug" :label="__('Url')"
                                    :value="old('slug', $tourSubject->getTranslations('slug'))"
                                    :help="__('Leave blank for automatic generation')"
                                    required></x-forms.text-loc-group>

            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $tourSubject->getTranslations('text'))"></x-forms.editor-loc-group>

        </x-slot>

    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $tourSubject->getTranslations('seo_h1'))"/>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $tourSubject->getTranslations('seo_title'))"/>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $tourSubject->getTranslations('seo_description'))"/>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords',  $tourSubject->getTranslations('seo_keywords'))"/>
        </x-slot>
    </x-bootstrap.card>

    @if($tourSubject->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Pictures')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$tourSubject"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif
</div>



