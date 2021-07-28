@props([
    'cityId'=>0,
    'city'=>null,
    'lat'=>48.736383466532274,
    'lng'=>31.460746106250006,
    'latName'=>'lat',
    'lngName'=>'lng',
    'required'=>false
])

<div class="location-group">
    <x-forms.select-group :options="[]" :value="$cityId" name="city_id" required :label="__('City')">
        @if($city !== null)
            <option value="{{$city->id}}">{{$city->title}} ({{$city->region->title}})</option>
        @endif
    </x-forms.select-group>

    <div class="row mb-1">
        <div  class="col-6">
            <x-forms.text-group name="{{$latName}}" :label="__('Latitude')"  :value="$lat" :readonly="true" label-col="col-4" input-col="col-8"></x-forms.text-group>
        </div>
        <div  class="col-6">
            <x-forms.text-group name="{{$lngName}}" :label="__('Longitude')" :value="$lng" :readonly="true"  label-col="col-4" input-col="col-8"></x-forms.text-group>
        </div>

    </div>
    <div class="map">

    </div>
</div>


