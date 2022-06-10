<x-forms.select-group wire:model="region_id" name="region_id" :label="__('Region')"
                      :options="$regions">
    <option value="0">Не вибрано</option>
</x-forms.select-group>

<x-forms.select-group wire:model="district_id" name="district_id" :label="__('District')"
                      :select2="true"
                      :allowClear="true"
                      autocomplete="/api/location/districts?paginate=1"
                      :placeholder="__('Не вибрано')"
                      :filters="['region_id' => $region_id, 'district_id' => $district_id, 'place_id' => $place_id, 'city_id' => $city_id]"
                      :options="$districts" />

<x-forms.select-group wire:model="place_id" name="place_id" :label="__('Template')"
                      :select2="true"
                      :allowClear="true"
                      autocomplete="/api/places/select-box"
                      :placeholder="__('Не вибрано')"
                      :filters="['region_id' => $region_id, 'district_id' => $district_id, 'place_id' => $place_id, 'city_id' => $city_id]"
                      :options="$places" />

@if($place_id && $place)
    <div x-data='translatable()'>

        <x-forms.translation-switch/>

        <x-forms.text-loc-group wire:model="title" name="title" :label="__('Title')"
                                :value="old('title', $place->getTranslations('title'))"/>

        <x-forms.html-loc-group name="text" :label="__('Text')"
                                :value="old('text', $place->getTranslations('text'))"
                                :readonly="true"/>
    </div>
@endif
