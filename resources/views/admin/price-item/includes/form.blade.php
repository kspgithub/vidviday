<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $priceItem->title)" maxlength="255" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $priceItem->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>


        <x-forms.text-group name="places" :label="__('Places')" :value="old('places', $priceItem->places)" type="number" ></x-forms.text-group>
        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $priceItem->price)" type="number" ></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $priceItem->currency)" :options="$currencies" type="text"></x-forms.select-group>
        <x-forms.switch-group name="published" :label="__('Published')" :active="$priceItem->published"></x-forms.switch-group>
        <x-forms.switch-group name="limited" :label="__('Limited')" :active="$priceItem->limited"></x-forms.switch-group>
        <x-forms.select-group name="tour_id" :label="__('Title Tour')" :value="old('tour_id', $priceItem->tour_id)" :options="$tours" type="number" required></x-forms.select-group>


    </x-slot>
</x-bootstrap.card>





