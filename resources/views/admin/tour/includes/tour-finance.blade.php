<div>

    <x-bootstrap.card>
        <x-slot name="body">
            <h2 class="mb-2">@lang('Finance')</h2>
            <table class="table table-sm mb-3">
                <thead>
                <tr>
                    <th>@lang('Type')</th>
                    <th>@lang('Text') {{strtoupper(app()->getLocale())}}</th>
                    <th>@lang('Actions')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="text-nowrap">{{$item->type_id === 1 ? 'У вартість входить' : 'У вартість НЕ входить'}}</td>
                        <td>
                            @if($item->finance)
                                {!! $item->finance->text !!}
                            @else
                                {!! $item->text !!}
                            @endif
                        </td>
                        <td style="width: 150px">

                            <a href="{{route('admin.tour.finance.edit', [$tour, $item])}}"
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

            <a href="{{route('admin.tour.finance.create', $tour)}}" class="btn btn-primary me-2">
                @lang('Create Record')
            </a>
        </x-slot>
    </x-bootstrap.card>


    @include('livewire-tables::bootstrap-5.includes.delete-modal')
</div>

