<div>


    @if(!$edit)
        <h4 class="mb-3">@lang('Accommodation')</h4>
        <ul wire:sortable="updateOrder" class="list-group draggable-container mb-5" style="width: 500px;">
            @foreach($items as $item)
                <li class="list-group-item draggable d-flex align-items-center"
                    style="width: 500px;"
                    wire:sortable.item="{{ $item->id }}"
                    wire:key="accomm-{{ $item->id }}">
                    <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                    <span class="me-3">{{$item->title}}</span>
                    <a href="#" class="text-success ms-auto" wire:click.prevent="editItem({{$item->id}})">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="#deleteModal" wire:click="deleteId({{$item->id}})" data-bs-toggle="modal"
                       class="text-danger ms-3"><i class="fas fa-trash"></i></a>
                </li>
            @endforeach
        </ul>
        <button type="button" wire:click.prevent="addItem()" class="btn btn-primary">@lang('Add')</button>
    @else
        <h4 class="mb-3">@if($selectedId > 0)
                @lang('Editing Record')
            @else
                @lang('Creating Record')
            @endif</h4>
        <form wire:submit.prevent="saveItem()">
            <div class="row mb-3">
                <label class="col-md-2" for="accommodation_id">@lang('Accommodation') <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <x-input.select2wire name="accommodation_id" id="accommodation_id" wire:model="accommodation_id"
                                         required>
                        <option value="0">Оберіть садибу</option>
                        @foreach($options as $value=>$text)
                            <option
                                value="{{$value}}" {{$value === $accommodation_id ? 'selected' : ''}}>{{$text}}</option>
                        @endforeach
                    </x-input.select2wire>


                </div>
            </div>
            @foreach(siteLocales() as $locale)

                <x-forms.text-group wire:model.defer="title_{{$locale}}"
{{--                                    required--}}
                                    name="title_{{$locale}}"
                                    label="Суфікс {{strtoupper($locale)}}"
                />
            @endforeach
            <button type="submit" class="btn btn-primary me-3">@lang('Save')</button>
            <button type="button" wire:click.prevent="cancelEdit()" class="btn btn-secondary">@lang('Cancel')</button>


        </form>

    @endif

    @include('livewire-tables::bootstrap-5.includes.delete-modal')
</div>
