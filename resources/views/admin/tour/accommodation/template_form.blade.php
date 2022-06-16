<div>

    <x-forms.select-group wire:model="form.country_id" name="country_id" :label="__('Country')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/countries?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'country_id' => $form['country_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'city_id' => $form['city_id'] ?? 0,
                              'accommodation_id' => $form['accommodation_id'] ?? 0,
                           ]"
                          :options="$countries">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/regions?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'country_id' => $form['country_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'city_id' => $form['city_id'] ?? 0,
                              'accommodation_id' => $form['accommodation_id'] ?? 0,
                           ]"
                          :options="$regions">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.city_id" name="city_id" :label="__('City')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/cities?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'country_id' => $form['country_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'city_id' => $form['city_id'] ?? 0,
                              'accommodation_id' => $form['accommodation_id'] ?? 0,
                           ]"
                          :options="$cities">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.accommodation_id" name="accommodation_id" :label="__('Template')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/accommodations/select-box"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'country_id' => $form['country_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'city_id' => $form['city_id'] ?? 0,
                              'accommodation_id' => $form['accommodation_id'] ?? 0,
                           ]"
                          :options="$accommodations" >
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    @if($form['accommodation_id'] && $accommodation)
        <div>

            <x-forms.translation-switch/>

            <x-forms.html-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $accommodation->getTranslations('title'))"/>

            <x-forms.html-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $accommodation->getTranslations('text'))"/>
        </div>
    @endif

</div>
