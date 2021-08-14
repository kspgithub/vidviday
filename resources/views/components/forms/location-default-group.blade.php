@props([
    'lat'=>48.736383466532274,
    'lng'=>31.460746106250006,
    'latName'=>'lat',
    'lngName'=>'lng',
    'required'=>false
])

<div class="location-group">

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


