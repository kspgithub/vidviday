@extends('admin.layout.app')

@section('title', "Kлієнт Bitrix ID: $client->bitrix_id - замовлення")

@section("content")
    {!! breadcrumbs([
  ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
  ['url'=>route('admin.crm.client.index'), 'title'=>__('Clients')],
  ['url'=>route('admin.crm.client.show', $client), 'title'=>'Bitrix ID: '.$client->bitrix_id],
]) !!}
    <div class="d-flex justify-content-between">
        <h1>Kлієнт Bitrix ID: {{$client->bitrix_id}} - замовлення</h1>
    </div>

    @include('admin.crm.order.includes.list')

@endsection
