<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $discount->title)" maxlength="255" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $discount->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>

        <x-forms.text-group name="percentage" :label="__('Percentage')" :value="old('percentage', $discount->percentage)" type="number"></x-forms.text-group>
        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $discount->price)" type="number" required></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $discount->currency)" :options="$currencies" type="number"></x-forms.select-group>
        <x-forms.switch-group name="published" :label="__('Published')" :active="$discount->published"></x-forms.switch-group>

        <x-forms.datepicker-group
            :label="__('Start Date')"
            id="start_date"
            name="start_date"
            placeholder="{{ __('Start Date')}}"
            value="{{$discount->start_date}}"
            class="me-2"
        />
        <x-forms.datepicker-group
            :label="__('End Date')"
            id="end_date"
            name="end_date"
            placeholder="{{ __('End Date')}}"
            value="{{$discount->end_date}}"
        />
    </x-slot>
</x-bootstrap.card>





