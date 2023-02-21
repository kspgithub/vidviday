<div>

    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model.defer="form.title" name="title" :label="__('Title')" :required-locales="$tour->locales" />

    <x-forms.textarea-loc-group wire:model.defer="form.text" name="text" :label="__('Text')"/>

    @if($model->exists)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Gallery')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library
                    :model="$model"
                ></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif
</div>

