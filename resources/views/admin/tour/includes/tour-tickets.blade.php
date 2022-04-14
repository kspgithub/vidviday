<div>
    <ul wire:sortable="updateOrder" class="list-group draggable-container mb-5" style="width: 500px;">
        @foreach($items as $item)
            <li class="list-group-item draggable d-flex align-items-center"
                style="width: 500px;"
                wire:sortable.item="{{ $item->id }}"
                wire:key="place-{{ $item->id }}">
                <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                <span
                    class="me-3">{{$item->title}}, {{$item->price}}{{$item->currency}} ({{$item->region->title}})</span>
                <a href="#" class="text-danger ms-auto" wire:click.prevent="detachItem({{$item->id}})">
                    <i class="fa fa-times"></i>
                </a>
            </li>
        @endforeach
    </ul>
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

        <div class="col-12 col-xl-auto">
            <label for="place_id">@lang('Ticket')</label>
            <div wire:ignore>
                <div
                    x-data="tourTickets({value: @entangle('item_id')})"

                >
                    <select name="item_id" id="item_id"
                            class="form-control"
                            x-ref="input"
                            x-bind:value="value"
                            wire:model="item_id"
                            x-change="onChange"
                            style="width: 500px;"
                    >
                        <option value="0">Оберіть квиток</option>
                        @foreach($options as $option)
                            <option value="{{$option->id}}">
                                {{$option->title}} ({{$option->region ? $option->region->title : '-'}})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-auto">
            <button type="button" class="btn btn-primary" wire:loading.class="disabled"
                    wire:click.prevent="attachItem()">@lang('Add Ticket')</button>
        </div>
    </div>
</div>

