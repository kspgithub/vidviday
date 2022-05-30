<div>

    <x-bootstrap.card>
        <x-slot name="body">
            <h2 class="mb-2">@lang('ticket')</h2>
            <table class="table table-sm mb-3">
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('Title') {{strtoupper(app()->getLocale())}}</th>
                    <th>@lang('Text') {{strtoupper(app()->getLocale())}}</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody wire:sortable="updateOrder">
                @foreach($items as $item)
                    <tr class="draggable" wire:sortable.item="{{ $item->id }}" wire:key="ticket-{{ $item->id }}">
                        <td>
                            <i class="fa fa-bars cursor-move me-3" wire:sortable.handle></i>
                        </td>
                        <td>{!! $item->title !!}</td>
                        <td>{!! $item->text !!}</td>
                        <td style="width: 150px">

                            <a href="{{route('admin.tour.ticket.edit', [$tour, $item])}}"
                               class="btn btn-success m-2"><i
                                    class="fas fa-file-alt"></i></a>
                            <a href="#deleteModal" wire:click="deleteId({{$item->id}})" data-bs-toggle="modal"
                               class="btn btn-danger m-2"><i
                                    class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

            <a href="{{route('admin.tour.ticket.create', $tour)}}" class="btn btn-primary me-2">
                @lang('Create Record')
            </a>
        </x-slot>
    </x-bootstrap.card>


    @include('livewire-tables::bootstrap-5.includes.delete-modal')
</div>

