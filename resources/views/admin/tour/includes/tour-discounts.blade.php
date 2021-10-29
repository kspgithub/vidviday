<div>
    <ul wire:sortable="updateOrder" class="list-group draggable-container mb-5" style="width: 500px;">
        @foreach($items as $item)
            <li class="list-group-item draggable d-flex align-items-center"
                style="width: 500px;"
                wire:sortable.item="{{ $item->id }}"
                wire:key="item-{{ $item->id }}">
                <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                <span
                    class="me-3">{{$item->price . ($item->type === 1 ? '%' : $item->currency).', '.$item->title}}</span>
                <a href="#" class="text-danger ms-auto" wire:click.prevent="detachItem({{$item->id}})">
                    <i class="fa fa-times"></i>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="row align-items-end">
        <div class="col-12 col-xl-auto">
            <label for="place_id">@lang('Знижки')</label>
            <select name="place_id" id="place_id" class="form-control" wire:model="item_id" style="width: 500px;">
                <option value="0">Оберіть знижку</option>
                @foreach($options as $option)
                    <option value="{{$option->id}}">
                        {{$option->price . ($option->type === 1 ? '%' : $option->currency).', '.$option->title}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-xl-auto">
            <button type="button" class="btn btn-primary"
                    wire:loading.class="disabled"
                    wire:click.prevent="attachItem()">@lang('Add Discount')</button>
        </div>
    </div>
</div>

