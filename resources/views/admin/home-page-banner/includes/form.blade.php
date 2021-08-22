<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $homePageBanner->title)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $homePageBanner->slug)" maxlength="100" required ></x-forms.text-group>
        <x-forms.editor-group name="text" :label="__('Full Text')" :value="old('text', $homePageBanner->text)" required></x-forms.editor-group>
        <x-forms.textarea-group name="short_text" :label="__('Short Text')" :value="old('short_text', $homePageBanner->short_text)"
                                :help="__('Leave blank for automatic generation')"
                                rows="5"
        ></x-forms.textarea-group>

        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $homePageBanner->price)" type="number" required></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $homePageBanner->currency)" :options="$currencies" type="number"></x-forms.select-group>
        <x-forms.switch-group name="published" :label="__('Published')" :active="$homePageBanner->published"></x-forms.switch-group>
        <x-forms.single-image-upload name="main_image" :value="$homePageBanner->main_image"  :label="__('Main Image')" />

    </x-slot>
</x-bootstrap.card>





