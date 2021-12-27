@extends('admin.layout.app')

@section('title',  'Картка корпоративу: #'.$order->id)

@section("content")
    {!! breadcrumbs([
      ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
      ['url'=>route('admin.crm.corporate.index'), 'title'=>'Корпоративи'],
      ['url'=>route('admin.crm.corporate.show', $order), 'title'=>'Корпоратив #'.$order->id],
    ]) !!}
    <div class="text-center mb-3">
        <h1>Картка корпоративу: #{{$order->id}}</h1>
        @if($tour)
            <h2 class="text-muted">{{$tour->title}}</h2>
        @endif
    </div>

    @include('admin.crm.corporate.card')

@endsection
