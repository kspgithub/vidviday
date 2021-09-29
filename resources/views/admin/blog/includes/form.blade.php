<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $blog->title)"  required ></x-forms.text-group>
<x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $blog->slug)"  :help="__('Leave blank for automatic generation')" ></x-forms.text-group>
<x-forms.editor-group name="text" :label="__('Full Text')" :value="old('text', $blog->text)"></x-forms.editor-group>

<x-forms.textarea-group name="short_text" :label="__('Short Text')" :value="old('short_text', $blog->short_text)"
                        :help="__('Leave blank for automatic generation')"
                        rows="5"
></x-forms.textarea-group>

<x-forms.switch-group name="published" :label="__('Published')" :active="$blog->published"></x-forms.switch-group>
<x-forms.single-image-upload name="main_image" :value="$blog->main_image"  :label="__('Main Image')" />
<x-forms.single-image-upload name="mobile_image" :value="$blog->mobile_image"  :label="__('Mobile Image')"
                             help="320x320"
                             imgstyle="height: 200px; width: 200px; object-fit: cover;"
/>


<x-forms.text-group name="seo_h1" :label="__('SEO H1')" :value="old('seo_h1', $blog->seo_h1)"></x-forms.text-group>
<x-forms.text-group name="seo_title" :label="__('SEO Title')" :value="old('seo_title', $blog->seo_title)"></x-forms.text-group>
<x-forms.text-group name="seo_description" :label="__('SEO Description')" :value="old('seo_description', $blog->seo_description)"></x-forms.text-group>
<x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')" :value="old('seo_keywords', $blog->seo_keywords)"></x-forms.text-group>
