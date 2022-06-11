<div class="location-group {{$useMap ? '' : 'no-map'}}">

    @if($useCountry)
        <x-forms.select-group wire:model="selectedCountry" name="country_id" :label="__('Country')"
                              :select2="true"
                              :allowClear="true"
                              autocomplete="/api/location/countries?paginate=1"
                              :placeholder="__('Не вибрано')"
                              :options="$countries">
            <option value="0">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useRegion)
        <x-forms.select-group wire:model="selectedRegion" name="region_id" :label="__('Region')"
                              :select2="true"
                              :allowClear="true"
                              autocomplete="/api/location/regions?paginate=1"
                              :placeholder="__('Не вибрано')"
                              :filters="[
                                  'country_id' => $selectedCountry ?? 0,
                                  'region_id' => $selectedRegion ?? 0,
                                  'district_id' => $selectedDistrict ?? 0,
                                  'city_id' => $city_id ?? 0,
                              ]"
                              :options="$regions">
            <option value="0">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useDistrict)
        <x-forms.select-group wire:model="selectedDistrict" name="district_id" :label="__('District')"
                              :select2="true"
                              :allowClear="true"
                              autocomplete="/api/location/districts?paginate=1"
                              :placeholder="__('Не вибрано')"
                              :filters="[
                                  'country_id' => $selectedCountry ?? 0,
                                  'region_id' => $selectedRegion ?? 0,
                                  'district_id' => $selectedDistrict ?? 0,
                                  'city_id' => $city_id ?? 0,
                              ]"
                              :options="$districts" >
            <option value="0">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useCity)
        <x-forms.select-group wire:model="city_id" name="city_id" :label="__('City')"
                              :select2="true"
                              :allowClear="true"
                              autocomplete="/api/location/cities?paginate=1"
                              :placeholder="__('Не вибрано')"
                              :filters="[
                                  'country_id' => $selectedCountry ?? 0,
                                  'region_id' => $selectedRegion ?? 0,
                                  'district_id' => $selectedDistrict ?? 0,
                                  'city_id' => $city_id ?? 0,
                              ]"
                              :options="$cities" >
            <option value="0">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useMap)
        <div class="row mb-1">
            <div class="col-6">
                <x-forms.text-group wire:model="lat" name="{{$latName}}" :label="__('Latitude')" :value="$lat" :readonly="true"
                                    label-col="col-4" input-col="col-8"
                ></x-forms.text-group>
            </div>
            <div class="col-6">
                <x-forms.text-group wire:model="lng" name="{{$lngName}}" :label="__('Longitude')" :value="$lng" :readonly="true"
                                    label-col="col-4" input-col="col-8"
                ></x-forms.text-group>
            </div>
        </div>

        <div class="map"></div>
    @endif
</div>
