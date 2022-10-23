<div>
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Basic Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.translation-switch />

            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $news->getTranslations('title'))"
                                    required/>
            <x-forms.text-loc-group name="slug" :label="__('Url')" :value="old('slug', $news->getTranslations('slug'))"
                                    maxlength="100"
                                    :help="__('Leave blank for automatic generation')"/>
            <x-forms.editor-loc-group name="text" :label="__('Full Text')"
                                      :value="old('text', $news->getTranslations('text'))" required/>

            <x-forms.textarea-loc-group name="short_text" :label="__('Short Text')"
                                        :value="old('short_text', $news->getTranslations('short_text'))"
                                        :help="__('Leave blank for automatic generation')"
                                        rows="5"
            ></x-forms.textarea-loc-group>

            <x-forms.switch-group name="published" :label="__('Published')"
                                  :active="$news->exists ? $news->published : true"></x-forms.switch-group>

            <x-forms.single-image-upload name="main_image"
                                         :preview="!empty($news->main_image) ? $news->main_image_url : ''"
                                         :value="$news->main_image"
                                         :label="__('Main Image')"/>

            <x-forms.single-image-upload name="mobile_image"
                                         :preview="!empty($news->mobile_image) ? $news->mobile_image_url : ''"
                                         :value="$news->mobile_image"
                                         :label="__('Mobile Image')"
                                         help="320x320"
                                         imgstyle="height: 200px; width: 200px; object-fit: cover;"
            />

            <x-forms.text-group name="video" :label="__('Youtube Video')"
                                :value="old('video', $news->video)"></x-forms.text-group>

            <x-forms.datepicker-group name="created_at"
                                      :label="__('Created At')"
                                      :value="old('created_at', $news->created_at?->format('d.m.Y'))"
            />

        </x-slot>
    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $news->getTranslations('seo_h1'))"/>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $news->getTranslations('seo_title'))"/>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $news->getTranslations('seo_description'))"/>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords',  $news->getTranslations('seo_keywords'))"/>
            <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                      :value="old('seo_text', $news->getTranslations('seo_text'))"></x-forms.editor-loc-group>
        </x-slot>
    </x-bootstrap.card>
    @if($news->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Pictures')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$news"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif

</div>



