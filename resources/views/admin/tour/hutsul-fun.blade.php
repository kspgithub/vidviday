@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Hutsul Fun'))



@section('content')
    {!! breadcrumbs([
   ['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
   ['url'=>route('admin.tour.index'), 'title'=>__('Tours')],
   ['url'=>route('admin.tour.edit', $tour), 'title'=>$tour->title],
   ['url'=>'#', 'title'=>__('Hutsul Fun')],
   ]) !!}
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Hutsul Fun')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">

                    <div>
                        <form method="post" action="{{route('admin.tour.hutsul-fun.update', $tour)}}">
                            @csrf
                            @method('PATCH')

                            <x-forms.switch-group name="active_tabs[]" :label="__('Active')" active-value="hutsul_fun"
                                                  :active="in_array('hutsul_fun', $tour->active_tabs ?: [])"/>

                            @foreach(siteLocales() as $locale)
                                <x-forms.text-group name="hutsul_fun_title[{{$locale}}]"
                                                    id="hutsul_fun_title_{{ $locale }}"
                                                    label="Назва {{strtoupper($locale)}} {{in_array($locale,$tour->locales) ? '*' : ''}}"
                                                    :value="array_key_exists($locale, $titles) ? $titles[$locale] : ''"
                                >

                                </x-forms.text-group>

                            @endforeach

                            @foreach(siteLocales() as $locale)
                                <x-forms.editor-group name="hutsul_fun_text[{{$locale}}]"
                                                      id="hutsul_fun_text_{{ $locale }}"
                                                      label="Текст {{strtoupper($locale)}}"
                                                      :value="array_key_exists($locale, $translations) ? $translations[$locale] : ''"
                                >

                                </x-forms.editor-group>

                            @endforeach


                            <div class="row">
                                <div class="col-md-10 offset-md-2">
                                    <button type="submit" class="btn btn-primary me-3">@lang('Save')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </x-slot>
            </x-bootstrap.card>
        </div>
    </div>


@endsection

