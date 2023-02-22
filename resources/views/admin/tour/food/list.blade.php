<div>

    <x-bootstrap.card>
        <x-slot name="body">
            <h2 class="mb-2">@lang('food')</h2>
            <table class="table table-sm mb-3">
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('Day')</th>
                    <th>@lang('Time')</th>
                    <th>@lang('Food')</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody wire:sortable="updateOrder">
                @foreach($items as $item)
                    <tr class="draggable" wire:sortable.item="{{ $item->original_id }}"
                        wire:key="food-{{ $item->original_id }}">
                        <td>
                            <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                        </td>
                        <td>{{$item->day}}-й день</td>
                        <td>{{$item->time->title}}</td>
                        <td>{{$item->title.', '.$item->price.$item->currency}}</td>
                        <td style="width: 150px">
                            <a href="#" wire:click.prevent="editItem({{$item->original_id}})"
                               class="btn btn-sm btn-outline-primary m-1"><i
                                    class="fa fa-edit"></i></a>

                            <a href="#deleteModal" wire:click="deleteId({{$item->original_id}})" data-bs-toggle="modal"
                               class="btn btn-sm btn-danger m-2"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

            <a href="#" wire:click.prevent="addItem()" class="btn btn-primary m-2">
                @lang('Create Record')
            </a>
        </x-slot>
    </x-bootstrap.card>


    @include('livewire-tables::bootstrap-5.includes.delete-modal')
</div>

