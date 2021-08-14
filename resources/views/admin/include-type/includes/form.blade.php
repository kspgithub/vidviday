<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $includeType->title)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $includeType->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>
    </x-slot>
</x-bootstrap.card>






