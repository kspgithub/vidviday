<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $tourSubject->title)" maxlength="100" required ></x-forms.text-group>
<x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $tourSubject->slug)"
                    :help="__('Leave blank for automatic generation')"
                    maxlength="100" ></x-forms.text-group>

<x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $tourSubject->text)"  ></x-forms.editor-group>

<x-forms.text-group name="seo_h1" :label="__('SEO H1')" :value="old('seo_h1', $tourSubject->seo_h1)"></x-forms.text-group>
<x-forms.text-group name="seo_title" :label="__('SEO Title')" :value="old('seo_title', $tourSubject->seo_title)"></x-forms.text-group>
<x-forms.text-group name="seo_description" :label="__('SEO Description')" :value="old('seo_description', $tourSubject->seo_description)"></x-forms.text-group>
<x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')" :value="old('seo_keywords', $tourSubject->seo_keywords)"></x-forms.text-group>


