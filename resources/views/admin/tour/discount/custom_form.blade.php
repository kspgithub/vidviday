<div>


    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model="form.title" name="title" :label="__('Title')" :required-locales="$tour->locales" />

    <x-forms.select-group wire:model="form.type" name="type" :label="__('Type')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$discountTypes" >
    </x-forms.select-group>

    <x-forms.text-group wire:model="form.price" name="price" :label="__('Price')" type="number" required/>

    <x-forms.select-group wire:model="form.currency" name="currency" :label="__('Currency')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$currencies" type="text">
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.category" name="category" :label="__('Category')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$categories" type="text">
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.duration" name="duration" :label="__('Duration')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$durations" type="text">
    </x-forms.select-group>

    <x-forms.switch-group wire:model="form.age_limit" name="age_limit"
                          label="Обмеження за віком"></x-forms.switch-group>

    <x-forms.text-group wire:model="form.age_start" name="age_start" label="Вік з"
{{--                        :value="old('age_start', $discount->age_start)"--}}
                        type="number"></x-forms.text-group>

    <x-forms.text-group wire:model="form.age_end" name="age_end" label="Вік по"
{{--                        :value="old('age_end', $discount->age_end)"--}}
                        type="number"></x-forms.text-group>

    <x-forms.datepicker-group wire:model="form.start_date"
                              :label="__('Start Date')"
                              id="start_date"
                              name="start_date"
                              placeholder="{{ __('Start Date')}}"
                              class="me-2"
    />

    <x-forms.datepicker-group wire:model="form.end_date"
                              :label="__('End Date')"
                              id="end_date"
                              name="end_date"
                              placeholder="{{ __('End Date')}}"
    />
</div>

