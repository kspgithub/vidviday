<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $page->title)" maxlength="100" required ></x-forms.text-group>
<x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $page->slug)" maxlength="100" required ></x-forms.text-group>

<x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $page->text)" ></x-forms.editor-group>

<x-forms.text-group name="seo_h1" :label="__('SEO H1')" :value="old('seo_h1', $page->seo_h1)"></x-forms.text-group>
<x-forms.text-group name="seo_title" :label="__('SEO Title')" :value="old('seo_title', $page->seo_title)"></x-forms.text-group>
<x-forms.text-group name="seo_description" :label="__('SEO Description')" :value="old('seo_description', $page->seo_description)"></x-forms.text-group>
<x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')" :value="old('seo_keywords', $page->seo_keywords)"></x-forms.text-group>

