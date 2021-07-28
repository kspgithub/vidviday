<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Regions')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.select-group name="country_id" :label="__('Country')"
        :value="old('country_id', isset($region->country()->pluck('id')[0])?$region->country()->pluck('id')[0]:'')"
        :options="$countries"
        required></x-forms.select-group>

        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $region->title)" maxlength="100" required ></x-forms.text-group>

        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $region->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>

    </x-slot>

</x-bootstrap.card>

