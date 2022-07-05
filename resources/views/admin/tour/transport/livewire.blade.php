<div>
    <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="transport"
                          wire:change="updateActiveTabs('transport')"
                          :active="in_array('transport', $tour->active_tabs ?: [])"/>

    @if($edit)
        @include('admin.tour.transport.form')
    @endif

    @if(!$edit)
        @include('admin.tour.transport.list')
    @endif
</div>
