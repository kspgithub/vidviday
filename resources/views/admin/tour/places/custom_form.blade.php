<div class="location-group">

    {{ var_dump($errors) }}
    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model="title" name="title" :label="__('Title')"
                            :value="old('title', $model->getTranslations('title'))"/>

    <x-forms.textarea-loc-group wire:model="text" name="text" :label="__('Text')"
                            :value="old('text', $model->getTranslations('text'))"/>

    <x-forms.select-group name="direction_id" :label="__('Direction')"
                          :value="old('direction_id', $model->direction_id)"
                          :options="$directions"
                          required></x-forms.select-group>

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

    <x-forms.select-group wire:model="city_id" name="city_id" :label="__('City')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/cities?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="['region_id' => $region_id, 'district_id' => $district_id, 'place_id' => $place_id, 'city_id' => $city_id]"
                          :options="$cities" />

    <div class="row mb-1">
        <div class="col-6">
            <x-forms.text-group wire:model="lat" name="lat" :label="__('Latitude')" :value="$lat" :readonly="true"
                                label-col="col-4" input-col="col-8"></x-forms.text-group>
        </div>
        <div class="col-6">
            <x-forms.text-group wire:model="lng" name="lng" :label="__('Longitude')" :value="$lng" :readonly="true"
                                label-col="col-4" input-col="col-8"></x-forms.text-group>
        </div>
    </div>

    <div class="map"></div>
</div>
