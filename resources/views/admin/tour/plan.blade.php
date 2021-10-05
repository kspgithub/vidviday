@extends('admin.layout.app')

@section('title', __('Editing tour') .'-'.__('Plan'))



@section('content')
    <h1 class="mb-3">@lang('Editing tour') "{{$tour->title}}" - @lang('Plan')</h1>
    <div class="row">
        <div class="col-12 col-md-3 col-xl-2">
            @include('admin.tour.includes.edit-tabs')
        </div>
        <div class="col-12 col-md-9 col-xl-10">
            <x-bootstrap.card>
                <x-slot name="body">
                    <h2 class="mb-2">@lang('Tour Plan')</h2>
                    <div>
                        <form method="post" action="{{route('admin.tour.plan.update', $tour)}}">
                            @csrf
                            @method('PATCH')
                            @foreach($locales as $locale)
                                <x-forms.editor-group name="text[{{$locale}}]"
                                                      id="text_{{ $locale }}"
                                                      label="Text {{strtoupper($locale)}}"
                                                      :value=" array_key_exists($locale, $translations) ? $translations[$locale] : ''"
                                                      required
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

