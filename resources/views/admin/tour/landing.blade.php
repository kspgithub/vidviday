@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Places'))



@section('content')
    {!! breadcrumbs([
   ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
   ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
   ['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
   ['url'=>'#', 'title'=>'Місця висадки'],
   ]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Місця посадки')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <div x-data='tourLanding({
                        tour: @json($tour)
                        })'>
                        <div>
                            <div class="list-group draggable-container mb-5" style="width: 500px;" x-ref="sortable">
                                <template x-for="item in items" :key="'it-'+item.id">
                                    <li class="list-group-item draggable d-flex align-items-center" :data-id="item.id">
                                        <i class="fa fa-bars cursor-move me-3 handle"></i>
                                        <span x-text="item.title" class="me-3"></span>
                                        <a href="#" class="text-danger ms-auto" @click.prevent="detachItem(item.id)">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </li>
                                </template>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <select class="form-control" x-ref="select" x-model.number="selectedId">
                                    <option value="0">Оберіть місце</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="button" @click.prevent="attachItem(selectedId)" class="btn btn-success"
                                        :disabled="!selectedId">Додати
                                </button>
                            </div>
                        </div>
                    </div>

                </x-slot>
            </x-bootstrap.card>


        </div>
    </div>


@endsection

