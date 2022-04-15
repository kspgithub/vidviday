<div class="location-group no-map">

    <x-forms.select-group name="country_id" :label="__('Country')"
                          :options="$countries"
                          wire:model="selectedCountry"
                          required>
        <option value="">Не вибрано</option>
    </x-forms.select-group>


    <x-forms.select-group name="region_id" :label="__('Region')"
                          :options="$regions"
                          wire:model="selectedRegion"
                          required>
        <option value="">Не вибрано</option>
    </x-forms.select-group>


    <x-forms.select-group name="district_id" :label="__('District')"
                          :options="$districts"
                          wire:model="selectedDistrict"
                          required>
        <option value="">Не вибрано</option>
    </x-forms.select-group>


    <x-forms.select-group name="city_id" :label="__('City')"
                          :options="$cities"
                          wire:model="selectedCity"
                          required>
        <option value="">Не вибрано</option>
    </x-forms.select-group>
</div>

