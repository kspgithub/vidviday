<div>
    <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="ticket"
                          wire:change="updateActiveTabs('ticket')"
                          :active="in_array('ticket', $tour->active_tabs ?: [])"/>
    @if($edit)
        @include('admin.tour.ticket.form')
    @endif

    @if(!$edit)
        @include('admin.tour.ticket.list')
    @endif
</div>
