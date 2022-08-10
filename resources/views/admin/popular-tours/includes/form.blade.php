<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Popular Tours')</h3>
    </x-slot>
    <x-slot name="body">

        <x-forms.switch-group name="published" label="Опублікований" :active="old('published', $model->published)"/>

        <x-forms.select-group name="tour_id" :label="__('Tour')"
                              :value="old('tour_id', $model->tour_id)"
                              :options="$tours"
                              :select2="true"
                              required></x-forms.select-group>
    </x-slot>
</x-bootstrap.card>
