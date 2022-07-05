<div>
    <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="places"
                          wire:change="updateActiveTabs('places')"
                          :active="in_array('places', $tour->active_tabs ?: [])"/>

    @if($edit)
        @include('admin.tour.places.form')
    @endif

    @if(!$edit)
        @include('admin.tour.places.list')
    @endif
</div>

