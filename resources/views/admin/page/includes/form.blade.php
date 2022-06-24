<div x-data='@json($page)'>
    <x-bootstrap.card>
        <x-slot name="header"><h3>@lang('Basic Information')</h3></x-slot>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $page->getTranslations('title'))"
                                    maxlength="100"
                                    :required-locales="siteLocales()"
                                    required/>
            <x-forms.text-loc-group name="slug" :label="__('Url')" :value="old('slug', $page->getTranslations('slug'))"
                                    :required-locales="siteLocales()"
                                    maxlength="100"
                                    required/>
            @if(empty($page->key))
                <x-forms.text-group name="key" :label="__('Key')"
                                    :value="old('key', $page->key)" required></x-forms.text-group>
            @endif
            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $page->getTranslations('text'))"></x-forms.editor-loc-group>

            <x-forms.text-group name="video" :label="__('Youtube Video')"
                                :value="old('video', $page->video)"></x-forms.text-group>


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
            <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                      :value="old('seo_text', $page->getTranslations('seo_text'))"></x-forms.editor-loc-group>
        </x-slot>
    </x-bootstrap.card>
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Right Sidebar')</h3>
            <x-slot name="body">
                <x-forms.switch-group :label="__('Show sidebar')" name="sidebar"
                                      :active="$page->sidebar"
                                      help="Цей параметр не впливає на деякі сторінки"
                ></x-forms.switch-group>


                <x-forms.switch-group :label="__('Share')" name="sidebar_items[]"
                                      :active-value="'share'"
                                      :inactive-value="null"
                                      :active="in_array('share', $page->sidebar_items ?? [])"></x-forms.switch-group>

                <x-forms.switch-group :label="__('Testimonials')" name="sidebar_items[]"
                                      :active-value="'testimonials'"
                                      :inactive-value="null"
                                      :active="in_array('testimonials',$page->sidebar_items ?? [])"></x-forms.switch-group>

                <x-forms.switch-group :label="__('Contacts')" name="sidebar_items[]"
                                      :active-value="'contacts'"
                                      :inactive-value="null"
                                      :active="in_array('contacts', $page->sidebar_items ?? [])"></x-forms.switch-group>

                <x-forms.select-group name="staff_id"
                                      :label="__('Contact Manager')"
                                      :value="old('staff_id', $page->staff_id ?? 0)"
                                      :options="$managers">
                    <option value="">Не вибрано</option>
                </x-forms.select-group>
            </x-slot>
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

    @if($page->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Gallery')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$page" collection="gallery"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif
</div>
