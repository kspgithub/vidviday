
<div style="max-width: 768px">
    <ul wire:sortable="updateOrder" class="list-group draggable-container mb-5" style="width: 500px;">
        @foreach($items as $item)
            <li class="list-group-item draggable d-flex align-items-center"
                style="width: 500px;"
                wire:sortable.item="{{ $item->id }}"
                wire:key="place-{{ $item->id }}">
                <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                <span class="me-3">{{$item->title}}, {{$item->price}}{{$item->currency}}</span>
                <a href="#" class="text-danger ms-auto" wire:click.prevent="detachItem({{$item->id}})">
                    <i class="fa fa-times"></i>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="row align-items-end">
        <div class="col-12 col-xl-6">
            <label for="place_id">@lang('Place')</label>
            <x-input.select2wire name="tour_id" wire:model="tourId"
                                 url="/api/tours/select-box">
                <option value="0">Оберіть тур</option>
            </x-input.select2wire>
        </div>
        <div class="col-12 col-xl-auto">
            <button type="button" class="btn btn-primary" wire:click.prevent="attachItem()">@lang('Add')</button>
        </div>
    </div>
</div>
