<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $discount->title)" maxlength="255" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $discount->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>

        <x-forms.text-group name="duration" :label="__('Duration, days')" :value="old('duration', $discount->duration)" type="number" required></x-forms.text-group>
        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $discount->price)" type="number" required></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $discount->currency)" :options="$currencies" type="number"></x-forms.select-group>
        <x-forms.select-group name="model_nameable_type" :label="__('Model')" :value="old('model_nameable_type', $discount->model_nameable_type)" :options="$modelsNames" type="text"></x-forms.select-group>
        <x-forms.select-group name="model_nameable_id" :label="__('Title Model')" :value="old('model_nameable_id', $discount->model_nameable_id)" :options="$model" type="number"></x-forms.select-group>
    </x-slot>
</x-bootstrap.card>





