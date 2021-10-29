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

    <hr>
    <div class="row align-items-end">
        <div class="col-12 mb-3">
            <label for="region_id">@lang('Region')</label>
            <select name="region_id" id="region_id" wire:model="region_id" class="form-control">
                <option value="0">Оберіть область</option>
                @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->title}}</option>
                @endforeach
            </select>

        </div>
        <div class="col-12 mb-3">
            <label for="region_id">@lang('District')</label>
            <select name="district_id" id="district_id" wire:model="district_id"
                    class="form-control" {{$region_id > 0 ? '' : 'disabled'}}>
                <option value="0">Оберіть район</option>
                @foreach($this->filteredDistricts as $district)
                    <option value="{{$district->id}}">{{$district->title}}</option>
                @endforeach
            </select>

        </div>
        <div class="col-12 mb-3">
            <label for="place_id">@lang('Place')</label>
            <div wire:ignore>
                <div
                    x-data="tourPlaces({value: @entangle('item_id')})"

                >
                    <select name="place_id" id="place_id"
                            class="form-control"
                            x-ref="input"
                            x-bind:value="value"
                            wire:model="item_id"
                            x-change="onChange"
                    >
                        <option value="0">Оберіть місце</option>
                    </select>
                </div>
            </div>

        </div>
        <div class="col-12 mb-3">
            <button type="button" class="btn btn-primary" wire:click.prevent="attachItem()">@lang('Add Place')</button>
        </div>
    </div>
</div>

