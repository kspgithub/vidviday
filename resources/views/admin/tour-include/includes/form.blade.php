<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $tourInclude->title)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $tourInclude->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>
        <x-forms.select-group name="tour_id" :label="__('Tour')" :value="old('tour_id', $tourInclude->tour_id)" :options="$tours" type="number" required></x-forms.select-group>
        <x-forms.select-group name="type_id" :label="__('Include type')" :value="old('type_id', $tourInclude->type_id)" :options="$includeTypes" type="number" required></x-forms.select-group>
        <x-forms.switch-group name="published" :label="__('Published')" :active="$tourInclude->published"></x-forms.switch-group>
    </x-slot>
</x-bootstrap.card>

