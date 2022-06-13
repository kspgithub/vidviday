@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Finance'))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
['url'=>'#', 'title'=>__('Finance')],
]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Місця посадки')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <livewire:tour-places :tour="$tour"/>
        </div>
    </div>

@endsection

@push('after-scripts')

    <script>
        window.addEventListener('updateType', (event) => {
            const type_id = event.detail.type_id
            window.Livewire.emit('updateType', type_id)
        })
    </script>
@endpush
