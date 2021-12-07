<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Staff Type')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $staffType->title)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $staffType->slug)" maxlength="100" required ></x-forms.text-group>

    </x-slot>

</x-bootstrap.card>

