<x-bootstrap.card>
    <x-slot name="body">
        <h3 class="mb-3">Знижки</h3>

        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th>Назва</th>
                    <th style="width: 200px">Значення</th>
                    <th style="width: 200px">Дії</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($discounts))
                    @foreach($discounts as $index=>$discount)
                        <tr>
                            <td>{{$discount['title']}}</td>
                            <th>{{$discount['value']}} {{$order->currency}}</th>
                            <td>
                                <a href="#" class="ms-3 text-danger"
                                   wire:click.prevent="removeDiscount({{$index}})">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="3">Немає знижок</td>
                    </tr>
                @endif
                <tr>
                    <td class="border-0 pt-4">
                        <input type="text" class="form-control form-control-sm" required
                               wire:model.defer="discountTitle" placeholder="Назва">
                    </td>
                    <td class="border-0 pt-4">
                        <input type="number" class="form-control form-control-sm" required
                               wire:model.defer="discountValue" placeholder="Значення">
                    </td>
                    <td class="border-0 pt-4">
                        <button type="submit" wire:click.prevent="addDiscount()" class="btn btn-sm btn-primary">
                            Додати знижку
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </x-slot>
</x-bootstrap.card>

