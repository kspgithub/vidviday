@extends('admin.layout.app')

@section('title', __('Editing tour') .' - '.__('Question about the tour'))



@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
['url'=>'#', 'title'=>__('Questions')],
]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Question about the tour')</h1>

    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <h2 class="mb-5">@lang('Questions')</h2>
                    <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="faq"
                                          onchange="updateActiveTabs('faq')"
                                          :active="in_array('faq', $tour->active_tabs ?: [])"/>

                    <livewire:tour-faq-table :tour="$tour"/>
                </x-slot>
            </x-bootstrap.card>
        </div>
    </div>


@endsection

@push('after-scripts')
    <script>
        function updateActiveTabs(tab) {
            axios.patch("{{route('admin.tour.update-tabs', [$tour, ''])}}/"+tab).then((res) => toast[res.data.type](res.data.message))
        }
    </script>
@endpush
