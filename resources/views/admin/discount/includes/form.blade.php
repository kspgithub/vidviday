<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.translation-switch/>
        <x-forms.text-group name="admin_title" :label="__('Admin Title')"
                            :value="old('admin_title', $discount->admin_title)"
                            maxlength="255"
                            required></x-forms.text-group>

        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $discount->getTranslations('title'))" maxlength="255"
                                required></x-forms.text-loc-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $discount->slug)" maxlength="100"
                            :help="__('Leave blank for automatic generation')"></x-forms.text-group>

        <x-forms.select-group name="type" :label="__('Type')" :value="old('type', $discount->type)" :options="$types"/>

        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $discount->price)" type="number"
                            required></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $discount->currency)"
                              :options="$currencies" type="number"></x-forms.select-group>

        <x-forms.select-group name="category" :label="__('Category')" :value="old('category', $discount->category)"
                              :options="$categories">
            <option value="0">Не вибрано</option>
        </x-forms.select-group>
        <x-forms.select-group name="duration" :label="__('Duration')" :value="old('duration', $discount->duration)"
                              :options="$durations">
            <option value="0">Не вибрано</option>
        </x-forms.select-group>
        <x-forms.switch-group name="age_limit" label="Обмеження за віком"
                              :active="$discount->age_limit"></x-forms.switch-group>

        <x-forms.text-group name="age_start" label="Вік з" :value="old('age_start', $discount->age_start)"
                            type="number"></x-forms.text-group>
        <x-forms.text-group name="age_end" label="Вік по" :value="old('age_end', $discount->age_end)"
                            type="number"></x-forms.text-group>


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

        <x-forms.switch-group name="published" :label="__('Published')"
                              :active="$discount->published"></x-forms.switch-group>
    </x-slot>
</x-bootstrap.card>





