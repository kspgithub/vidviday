@extends('admin.layout.app')

@section('title', 'Скасовані замовлення'))

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.order.index'), 'title'=>'Замовлення'],
      ['url'=>route('admin.crm.canceled-orders'), 'title'=>'Скасовані замовлення'],
    ]) !!}
    <div class="text-center mb-3">
        <h1>Скасовані замовлення</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold">Статистика</h3>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Причина</th>
                        <th>К-ть</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($abolitionTypes as $id => $type)
                    <tr>
                        <td>{{ $type }} (id: {{ $id }})</td>
                        <td>{{ count($canceledOrders[$id] ?? []) }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
