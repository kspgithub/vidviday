<div x-data='@json($page)'>
    <x-bootstrap.card>
        <x-slot name="header"><h3>@lang('Basic Information')</h3></x-slot>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $page->getTranslations('title'))"
                                    maxlength="100"
                                    required></x-forms.text-loc-group>
            <x-forms.text-loc-group name="slug" :label="__('Url')" :value="old('slug', $page->getTranslations('slug'))"
                                    maxlength="100"
                                    required></x-forms.text-loc-group>

            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $page->getTranslations('text'))"></x-forms.editor-loc-group>
            
        </x-slot>

    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $page->getTranslations('seo_h1'))"/>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $page->getTranslations('seo_title'))"/>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $page->getTranslations('seo_description'))"/>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords',  $page->getTranslations('seo_keywords'))"/>
        </x-slot>
    </x-bootstrap.card>
    @if($page->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Pictures')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$page"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif
</div>
