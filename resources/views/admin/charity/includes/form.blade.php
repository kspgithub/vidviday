<div>
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Basic Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $charity->getTranslations('title'))"
                                    required/>
            <x-forms.text-loc-group name="slug" :label="__('Url')" :value="old('slug', $charity->getTranslations('slug'))"
                                    maxlength="100"
                                    :help="__('Leave blank for automatic generation')"/>
            <x-forms.editor-loc-group name="text" :label="__('Full Text')"
                                      :value="old('text', $charity->getTranslations('text'))" required/>

            <x-forms.textarea-loc-group name="short_text" :label="__('Short Text')"
                                        :value="old('short_text', $charity->getTranslations('short_text'))"
                                        :help="__('Leave blank for automatic generation')"
                                        rows="5"
            ></x-forms.textarea-loc-group>

            <x-forms.switch-group name="published" :label="__('Published')"
                                  :active="$charity->published"></x-forms.switch-group>
            <x-forms.single-image-upload name="main_image"
                                         :preview="!empty($charity->main_image) ? $charity->main_image_url : ''"
                                         :value="$charity->main_image"
                                         :label="__('Main Image')"/>

            <x-forms.single-image-upload name="mobile_image"
                                         :preview="!empty($charity->mobile_image) ? $charity->mobile_image_url : ''"
                                         :value="$charity->mobile_image"
                                         :label="__('Mobile Image')"
                                         help="320x320"
                                         imgstyle="height: 200px; width: 200px; object-fit: cover;"
            />
        </x-slot>
    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $charity->getTranslations('seo_h1'))"/>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $charity->getTranslations('seo_title'))"/>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $charity->getTranslations('seo_description'))"/>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords',  $charity->getTranslations('seo_keywords'))"/>
            <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                      :value="old('seo_text', $charity->getTranslations('seo_text'))"></x-forms.editor-loc-group>
        </x-slot>
    </x-bootstrap.card>
    @if($charity->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Pictures')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$charity"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif

</div>



