<div class="location-group {{$useMap ? '' : 'no-map'}}">

    @if($useCountry)
        <x-forms.select-group name="country_id" :label="__('Country')"
                              :options="$countries"
                              wire:model="selectedCountry"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useRegion)
        <x-forms.select-group name="region_id" :label="__('Region')"
                              :options="$regions"
                              wire:model="selectedRegion"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useDistrict)
        <x-forms.select-group name="district_id" :label="__('District')"
                              :options="$districts"
                              wire:model="selectedDistrict"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useCity)
        <x-forms.select-group name="city_id" :label="__('City')"
                              :options="$cities"
                              wire:model="selectedCity"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>
    @endif

    @if($useMap)
        <div class="row mb-1">
            <div class="col-6">
                <x-forms.text-group name="{{$latName}}" :label="__('Latitude')" :value="$lat" :readonly="true"
                                    label-col="col-4" input-col="col-8"></x-forms.text-group>
            </div>
            <div class="col-6">
                <x-forms.text-group name="{{$lngName}}" :label="__('Longitude')" :value="$lng" :readonly="true"
                                    label-col="col-4" input-col="col-8"></x-forms.text-group>
            </div>
        </div>

        <div class="map"></div>
    @endif
</div>
