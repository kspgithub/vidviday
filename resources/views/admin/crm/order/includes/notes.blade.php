<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Примітки</h3>
            <div>

            </div>
        </div>

        <table class="table table-hover mb-5">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Текст</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->notes as $order_note)
                <tr>
                    <td style="width: 300px;">{{$order_note->created_at ? $order_note->created_at?->format('d.m.Y H:i') : '-'}}</td>
                    <td>
                        {!! $order_note->text !!}
                    </td>
                </tr>
            @endforeach
            @if($order->notes->count() === 0)
                <tr>
                    <td colspan="3">Немає записів</td>
                </tr>
            @endif
            </tbody>
        </table>


    </div>
</div>
