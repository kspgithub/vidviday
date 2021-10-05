@props([
    'regionId'=>0,
    'region'=>null,
    'cityId'=>0,
    'city'=>null,
    'lat'=>48.736383466532274,
    'lng'=>31.460746106250006,
    'latName'=>'lat',
    'lngName'=>'lng',
    'required'=>false,
    'map'=>true,
    'regions'=>[],
])

<div class="location-group {{$map ? '' : 'no-map'}}">
    @if(count($regions) > 0)
        <x-forms.select-group name="region_id" :label="__('Region')"
                              :value="old('region_id', $regionId)"
                              :options="$regions"
                              required>
            <option value="">Не вибрано</option>
        </x-forms.select-group>
    @endif

    <x-forms.select-group :options="[]" :value="$cityId" name="city_id" :label="__('City')">
        <option value="">Не вибрано</option>
        @if($city !== null)
            <option value="{{$city->id}}">{{$city->title}} ({{$city->region->title}})</option>
        @endif
    </x-forms.select-group>

    @if($map)
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

    <div class="map">

    </div>
    @endif
</div>


