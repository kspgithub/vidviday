<div>

    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model="form.title" name="title" :label="__('Title')"/>

    <x-forms.textarea-loc-group wire:model="form.text" name="text" :label="__('Text')"/>


    <div>
        <livewire:location-group :model="$model"
                                 :country_id="$form['country_id']"
                                 :region_id="$form['region_id']"
                                 :district_id="$form['district_id']"
                                 :city_id="$form['city_id']"
                                 :lat="$form['lat']"
                                 :lng="$form['lng']"
        />
    </div>

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

