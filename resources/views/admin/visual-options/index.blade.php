@php use App\Models\VisualOption; @endphp
@extends('admin.layout.app')
@section('content')
    <div class="dashboard d-flex justify-content-between">
        <h1>@lang('Налаштування відображення')</h1>

    </div>

    <div class="card">
        <div class="card-body">
            <form class="form mb-3" action="{{route('admin.visual-options.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                @foreach($visual_options as $visual_option)
                    <div class="row mb-2">
                        <label class="col-md-4 col-xl-3 mb-2">
                            {{$visual_option->title}}
                        </label>
                        <div class="col-md-6 mb-2">
                            @switch($visual_option->type)
                                @case('boolean')
                                <div class="form-check form-switch">
                                    <input type="hidden" name="options[{{$visual_option->key}}]" value="0">
                                    <input class="form-check-input" name="options[{{$visual_option->key}}]"
                                           value="1" type="checkbox"
                                           id="options_{{$visual_option->key}}"
                                        {{$visual_option->value ? 'checked' : ''}}>
                                    <label class="form-check-label" for="options_{{$visual_option->key}}"></label>
                                </div>
                                @break
                                @case('text')
                                <textarea name="options[{{$visual_option->key}}]" rows="8"
                                          class="form-control">{!! $visual_option->value !!}</textarea>
                                @break
                                @case('date')
                                    <x-forms.datepicker-group name="options[{{$visual_option->key}}]"
                                                        value="{{$visual_option->value}}"
                                    />
                                @break
                                @case(VisualOption::TYPE_IMAGE)
                                    <x-forms.single-image-upload name="options[{{$visual_option->key}}]"
                                                                 :preview="!empty($visual_option->value) ? Storage::url($visual_option->value) : ''"
                                                                 :value="$visual_option->value"/>
                                @break
                                @default
                                <input name="options[{{$visual_option->key}}]" type="text" class="form-control"
                                       value="{{$visual_option->value}}">
                            @endswitch

                        </div>
                    </div>

                @endforeach

                <button type="submit" class="btn btn-primary">@lang('Save')</button>
            </form>
        </div>
    </div>
@endsection
