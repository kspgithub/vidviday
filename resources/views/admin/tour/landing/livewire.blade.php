<div>
    <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="landings"
                          wire:change="updateActiveTabs('landings')"
                          :active="in_array('landings', $tour->active_tabs ?: [])"/>

    @if($edit)
        @include('admin.tour.landing.form')
    @endif

    @if(!$edit)
        @include('admin.tour.landing.list')
    @endif
</div>
