<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $tour->title)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $tour->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>
        <x-forms.editor-group name="text" :label="__('Full Text')" :value="old('text', $tour->text)" required></x-forms.editor-group>
        <x-forms.textarea-group name="short_text" :label="__('Short Text')" :value="old('short_text', $tour->short_text)"
                                :help="__('Leave blank for automatic generation')"
                                rows="5"
        ></x-forms.textarea-group>
        <x-forms.text-group name="duration" :label="__('Duration, days')" :value="old('duration', $tour->duration)" type="number" required></x-forms.text-group>
        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $tour->price)" type="number" required></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $tour->currency)" :options="$currencies" type="number"></x-forms.select-group>
        <x-forms.switch-group name="new" :label="__('New')" :active="$tour->new"></x-forms.switch-group>
        <x-forms.switch-group name="bestseller" :label="__('Bestseller')" :active="$tour->bestseller"></x-forms.switch-group>
        <x-forms.single-image-upload name="main_image" :value="$tour->main_image"  :label="__('Main Image')" />
        <x-forms.single-image-upload name="mobile_image" :value="$tour->mobile_image"  :label="__('Mobile Image')"
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
        <x-forms.text-group name="seo_h1" :label="__('SEO H1')" :value="old('seo_h1', $tour->seo_h1)"></x-forms.text-group>
        <x-forms.text-group name="seo_title" :label="__('SEO Title')" :value="old('seo_title', $tour->seo_title)"></x-forms.text-group>
        <x-forms.text-group name="seo_description" :label="__('SEO Description')" :value="old('seo_description', $tour->seo_description)"></x-forms.text-group>
        <x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')" :value="old('seo_keywords', $tour->seo_keywords)"></x-forms.text-group>
    </x-slot>
</x-bootstrap.card>




