@extends('admin.layout.app')
@section('content')
    <div class="dashboard d-flex justify-content-between">
        <h1>@lang('Popup messages')</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form x-data="translatable({})" class="form mb-3" action="{{route('admin.popup-messages')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-forms.translation-switch />

                @foreach($popupMessages as $popupMessage)

                    <div>
                        <h4>{{ $popupMessage->type->name }}</h4>

                        <div>
                            <x-forms.text-loc-group name="messages[{{ $popupMessage->type->value }}][title]" :label="__('Title')" :value="$popupMessage->getTranslations('title')" />

                            <x-forms.textarea-loc-group name="messages[{{ $popupMessage->type->value }}][description]" :label="__('Description')" :value="$popupMessage->getTranslations('description')" />
                        </div>
                    </div>

                @endforeach

                <button type="submit" class="btn btn-primary">@lang('Save')</button>
            </form>
        </div>
    </div>
@endsection
