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

    <div class="btn-group mb-4">
        <a href="{{route('admin.crm.client.show', ['client'=>$client, 'type'=>'team'])}}"
           class="btn btn-outline-primary {{$group_type == 0 ? 'active' : ''}}">Збірні тури</a>
        <a href="{{route('admin.crm.client.show', ['client'=>$client, 'type'=>'corporate'])}}"
           class="btn btn-outline-primary {{$group_type == 1 ? 'active' : ''}}">Корпоративи</a>
    </div>


    @if($group_type == 1)
        @include('admin.crm.corporate.includes.list')
    @else
        @include('admin.crm.order.includes.list')
    @endif
@endsection
