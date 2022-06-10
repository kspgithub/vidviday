<x-bootstrap.card>
    <x-slot name="body">
        <h2 class="mb-2">@lang('Tour places') {{ $model?->id }}</h2>
        <div x-data="translatable()">
            <form method="post" wire:submit.prevent="saveItem()">

                <x-forms.select-group wire:model="type_id" name="type_id" :label="__('Type')"
                                      :options="$types">
                    <option value="0">Не вибрано</option>
                </x-forms.select-group>

                @if($type_id == App\Models\TourPlace::TYPE_TEMPLATE)
                    @include('admin.tour.places.template_form')
                @endif

                @if($type_id == App\Models\TourPlace::TYPE_CUSTOM)
                    @include('admin.tour.places.custom_form')
                @endif

                <button type="submit" class="btn btn-primary me-3"
                        wire:loading.class="disabled">@lang('Save')</button>
                <button type="button" wire:click.prevent="cancelEdit()"
                        class="btn btn-outline-secondary">@lang('Cancel')</button>
            </form>
        </div>
    </x-slot>
</x-bootstrap.card>
