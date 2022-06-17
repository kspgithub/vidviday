<div>

    <x-forms.translation-switch/>

    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/regions?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'region_id' => $form['region_id'] ?? 0,
                              'ticket_id' => $form['ticket_id'] ?? 0,
                           ]"
                          :options="$regions">
    </x-forms.select-group>

    <x-forms.text-loc-group wire:model="form.title" name="title" :label="__('Title')" :required-locales="$tour->locales" />

    <x-forms.textarea-loc-group wire:model="form.text" name="text" :label="__('Text')"/>

</div>

