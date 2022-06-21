<div x-data='@json($eventGroup)'>
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Basic Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $eventGroup->getTranslations('title'))"
                                    required/>
            <x-forms.text-loc-group name="slug" :label="__('Url')"
                                    :value="old('slug',$eventGroup->getTranslations('slug'))"
                                    :help="__('Leave blank for automatic generation')"/>

            <x-forms.editor-loc-group name="text" :label="__('Full Text')"
                                      :value="old('text', $eventGroup->getTranslations('text'))"/>

        </x-slot>
    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $eventGroup->getTranslations('seo_h1'))"/>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $eventGroup->getTranslations('seo_title'))"/>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $eventGroup->getTranslations('seo_description'))"/>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords',  $eventGroup->getTranslations('seo_keywords'))"/>
            <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                      :value="old('seo_text', $eventGroup->getTranslations('seo_text'))"></x-forms.editor-loc-group>
        </x-slot>
    </x-bootstrap.card>

    @if($eventGroup->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Pictures')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$eventGroup"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif


</div>
