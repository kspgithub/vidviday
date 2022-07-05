<div>
    <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="accommodation"
                          wire:change="updateActiveTabs('accommodation')"
                          :active="in_array('accommodation', $tour->active_tabs ?: [])"/>

    @if($edit)
        @include('admin.tour.accommodation.form')
    @endif

    @if(!$edit)
        @include('admin.tour.accommodation.list')
    @endif
</div>

