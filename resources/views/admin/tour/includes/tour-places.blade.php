<div>
    <ul wire:sortable="updateOrder" class="list-group draggable-container mb-5" style="width: 500px;">
        @foreach($items as $item)
            <li class="list-group-item draggable d-flex align-items-center"
                style="width: 500px;"
                wire:sortable.item="{{ $item->id }}"
                wire:key="place-{{ $item->id }}">
                <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                <span class="me-3">{{$item->title}} ({{$item->region->title}})</span>
                <a href="#" class="text-danger ms-auto" wire:click.prevent="detachItem({{$item->id}})">
                    <i class="fa fa-times"></i>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="row align-items-end">
        {{--        <div class="col-12 col-xl-4">--}}
        {{--            <label for="region_id">@lang('Region')</label>--}}
        {{--            <select name="region_id" id="region_id" wire:model="region_id" class="form-control">--}}
        {{--                <option value="0">Оберіть область</option>--}}
        {{--                @foreach($regions as $region)--}}
        {{--                    <option value="{{$region->id}}">{{$region->title}}</option>--}}
        {{--                @endforeach--}}
        {{--            </select>--}}

        {{--        </div>--}}
        <div class="col-12 col-xl-6">
            <label for="place_id">@lang('Place')</label>
            <x-input.select2 name="place_id" wire:model="item_id"
                             url="/api/places/select-box">
                <option value="0">Оберіть місце</option>
            </x-input.select2>

        </div>
        <div class="col-12 col-xl-auto">
            <button type="button" class="btn btn-primary" wire:click.prevent="attachItem()">@lang('Add Place')</button>
        </div>
    </div>
</div>

