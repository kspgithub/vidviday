<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Country')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $country->title)" maxlength="100" required ></x-forms.text-group>

        <x-forms.text-group name="iso" :label="__('Iso')" :value="old('slug', $country->iso)" maxlength="10" required ></x-forms.text-group>

        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $country->slug)" maxlength="100" required ></x-forms.text-group>

    </x-slot>

</x-bootstrap.card>

