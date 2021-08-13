<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $document->title)" maxlength="100" required ></x-forms.text-group>

        <x-forms.single-image-upload name="image" :value="$document->image"  :label="__('Image')" required/>

    </x-slot>
</x-bootstrap.card>






