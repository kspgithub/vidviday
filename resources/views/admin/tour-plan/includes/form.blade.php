<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $tourPlan->title)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $tourPlan->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>
        <x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $tourPlan->text)"></x-forms.editor-group>
        <x-forms.select-group name="tour_id" :label="__('Title Tour')" :value="old('tour_id', $tourPlan->tour_id)" :options="$tours" type="number" required></x-forms.select-group>
        <x-forms.switch-group name="published" :label="__('Published')" :active="$tourPlan->published"></x-forms.switch-group>
        <x-forms.location-default-group
            :lat="old('lat', $tourPlan->lat)"
            :lng="old('lng', $tourPlan->lng)"
        ></x-forms.location-default-group>

    </x-slot>
</x-bootstrap.card>

