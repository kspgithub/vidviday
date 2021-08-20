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
        <div class="col-12 col-xl-auto">
            <label for="place_id">@lang('Place')</label>
            <select name="place_id" id="place_id" class="form-control" wire:model.defer="item_id" style="width: 500px;">
                <option value="0">Оберіть місце</option>
                @foreach($options as $option)
                    <option value="{{$option->id}}">
                        {{$option->title}} ({{$option->region->title}})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-xl-auto">
            <button type="button" class="btn btn-primary" wire:click.prevent="attachItem()">@lang('Add Place')</button>
        </div>
    </div>
</div>

