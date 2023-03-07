@if($order->abolition)
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold">Скасування замовлення</h3>
            </div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th style="width: 300px">Приина</th>
                    <td>
                        <div>
                            <b>{{ $abolitionTypes[$order->abolition['cause']] ?? 'unknown' }}</b>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="width: 300px">Коментар</th>
                    <td>
                        <div>
                            <b>{{ $order->abolition['comment'] }}</b>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            @if($order->status === \App\Models\Order::STATUS_PENDING_CANCEL)
                <a href="{{ route('admin.crm.order.cancel', $order) }}" class="btn btn-sm btn-outline-primary me-3 mb-3">
                    <i class="fa fa-remove"></i> Скасувати
                </a>
            @endif
        </div>
    </div>
@endif
