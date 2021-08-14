<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $eventGroup->title)" maxlength="100" required ></x-forms.text-group>
<x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $eventGroup->slug)"
                    :help="__('Leave blank for automatic generation')"
                    maxlength="100" ></x-forms.text-group>

<x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $eventGroup->text)"  ></x-forms.editor-group>
<x-forms.switch-group name="published" :label="__('Published')" :active="$eventGroup->published"></x-forms.switch-group>
<x-forms.text-group name="seo_h1" :label="__('SEO H1')" :value="old('seo_h1', $eventGroup->seo_h1)"></x-forms.text-group>
<x-forms.text-group name="seo_title" :label="__('SEO Title')" :value="old('seo_title', $eventGroup->seo_title)"></x-forms.text-group>
<x-forms.text-group name="seo_description" :label="__('SEO Description')" :value="old('seo_description', $eventGroup->seo_description)"></x-forms.text-group>
<x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')" :value="old('seo_keywords', $eventGroup->seo_keywords)"></x-forms.text-group>

