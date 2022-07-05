<div>
    <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="food"
                          wire:change="updateActiveTabs('food')"
                          :active="in_array('food', $tour->active_tabs ?: [])"/>

    @if($edit)
        @include('admin.tour.food.form')
    @endif

    @if(!$edit)
        @include('admin.tour.food.list')
    @endif
</div>

