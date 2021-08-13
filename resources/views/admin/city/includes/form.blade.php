<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Country, Region, Place, City (Title)')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.select-group name="country_id" :label="__('Country')"
        :value="old('country_id', isset($city->country()->pluck('id')[0])?$city->country()->pluck('id')[0]:'')"
        :options="$countries"
        required></x-forms.select-group>

        <x-forms.select-group name="region_id" :label="__('Region')"
        :value="old('region_id', isset($city->region()->pluck('id')[0])?$city->region()->pluck('id')[0]:'')"
        :options="$regions"
        required></x-forms.select-group>
        <x-forms.select-group name="place_id" :label="__('Place')"
        :value="old('place_id', isset($city->place()->pluck('id')[0])?$city->place()->pluck('id')[0]:'')"
        :options="$places"
        required></x-forms.select-group>

        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $city->title)" maxlength="100" required ></x-forms.text-group>

        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $city->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>

    </x-slot>

</x-bootstrap.card>

