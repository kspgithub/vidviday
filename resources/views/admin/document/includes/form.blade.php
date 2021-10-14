<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.translation-switch/>
        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $document->getTranslations('title'))" maxlength="100"
                                required></x-forms.text-loc-group>
        <x-forms.switch-group name="published" :label="__('Published')"
                              :active="$document->published"></x-forms.switch-group>
        <x-forms.single-image-upload name="image" :value="$document->image" :label="__('Preview')"/>
        <x-forms.single-file-upload name="file" :value="$document->file" :label="__('File')"/>

    </x-slot>
</x-bootstrap.card>






