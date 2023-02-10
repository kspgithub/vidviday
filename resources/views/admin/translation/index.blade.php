@extends('admin.layout.app')

@section('title', __('Translations'))

@section('content')
    <div class="mb-2">
        {!! breadcrumbs([
            ['url'=>route('admin.dashboard'), 'title'=>__('Home')],
            ['url'=>route('admin.translation.index'), 'title'=>__('Translations')],
        ]) !!}
    </div>
    <div class="d-flex justify-content-between">
        <h1>@lang('Translations')</h1>

        <div class="d-flex align-items-center">
            @if(current_user()->isMasterAdmin() && false)
                <a href="{{route('admin.translation.create')}}" class="btn btn-sm btn-outline-info"><i
                        data-feather="feather"></i> Створити переклад</a>
            @endif
            @if(current_user()->isAdmin())
                <x-utils.form-button button-class="btn btn-sm btn-outline-primary"
                                     action="{{route('admin.translation.publish')}}">
                    Опублікувати переклади
                </x-utils.form-button>

                <x-utils.form-button button-class="btn btn-sm btn-outline-primary"
                                     action="{{route('admin.translation.build')}}">
                    Оновити кеш
                </x-utils.form-button>

            @endif
        </div>
    </div>

    <x-bootstrap.card>
        <x-slot name="body">
            {{--            <livewire:language-line-table />--}}

            <div x-data='translations({
                locales: @json(siteLocales()),
                params: @json(request()->all()),
                groups: @json($groups)
                })'>
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <input type="text" class="form-control" name="q" x-model.debounce.500ms="q"
                               placeholder="Пошук...">
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group d-inline-flex align-items-center">
                            <label for="group" class="me-2">Група</label>
                            <select name="group" id="group" class="form-control" x-model="group"
                                    @change="filterChange()">
                                @foreach($groups as $group)
                                    <option value="{{$group}}">{{Str::ucfirst(str_replace('-', ' ', $group))}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="list-group mb-3">
                    <template x-for="item in items">
                        <div class="list-group-item" :key="'ll-'+item.id">
                            <div class="row mb-1">
                                <div class="col-2 col-lg-1 text-bold">Ключ:</div>
                                <div class="col-10 col-lg-11">
                                    <input type="text" class="form-control form-control-sm" readonly
                                           :value="item.group === '*' ? item.key : item.group + '.'+item.key">
                                </div>
                            </div>
                            <template x-for="locale in locales">
                                <div class="row mb-1" :key="'ll-'+item.id+'-'+locale">
                                    <div class="col-2 col-lg-1 text-bold" x-text="locale.toUpperCase()"></div>
                                    <div class="col-10 col-lg-11">
                                        <input type="text" class="form-control form-control-sm"
                                               readonly
                                               x-model="item.text[locale]">
                                    </div>
                                </div>
                            </template>
                            <div class="row">
                                <div class="col-2 col-lg-1 text-bold">Дії:</div>
                                <div class="col-10 col-lg-11">
                                    <a href="#" @click="editItem(item)" class="btn btn-sm btn-outline-primary">Редагувати</a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <x-alp.pagination></x-alp.pagination>

                @include('admin.translation.includes.edit-modal')

            </div>
        </x-slot>
    </x-bootstrap.card>


@endsection
