<div>
    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/regions?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'country_id' => $form['country_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'district_id' => $form['district_id'] ?? 0,
                              'city_id' => $form['city_id'] ?? 0,
                               'place_id' => $form['place_id'] ?? 0,
                           ]"
                          :options="$regions">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.district_id" name="district_id" :label="__('District')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/districts?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'country_id' => $form['country_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'district_id' => $form['district_id'] ?? 0,
                              'city_id' => $form['city_id'] ?? 0,
                              'place_id' => $form['place_id'] ?? 0,
                          ]"
                          :options="$districts" >
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.place_id" name="place_id" :label="__('Template')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/places/select-box"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'country_id' => $form['country_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'district_id' => $form['district_id'] ?? 0,
                              'city_id' => $form['city_id'] ?? 0,
                              'place_id' => $form['place_id'] ?? 0,
                          ]"
                          :options="$places" >
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    @if($form['place_id'] && $place)
        <div>

            <x-forms.translation-switch/>

            <x-forms.html-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $place->getTranslations('title'))"/>

            <x-forms.html-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $place->getTranslations('text'))"/>
        </div>
    @endif

</div>
