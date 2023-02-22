<div>

    <x-forms.select-group wire:model="form.day" name="day" :label="__('Day')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$days">
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.time_id" name="time_id" :label="__('Time')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$foodTimes">
    </x-forms.select-group>

    {{--    <x-forms.select-group wire:model="form.country_id" name="country_id" :label="__('Country')"--}}
    {{--                          wire:ignore--}}
    {{--                          :select2="true"--}}
    {{--                          :allowClear="true"--}}
    {{--                          :placeholder="__('Не вибрано')"--}}
    {{--                          :options="$countries">--}}
    {{--    </x-forms.select-group>--}}

    {{--    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"--}}
    {{--                          wire:ignore--}}
    {{--                          :select2="true"--}}
    {{--                          :allowClear="true"--}}
    {{--                          :placeholder="__('Не вибрано')"--}}
    {{--                          :options="$regions">--}}
    {{--    </x-forms.select-group>--}}


    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model.defer="form.title" name="title" :label="__('Title')"/>

    <x-forms.textarea-loc-group wire:model.defer="form.text" name="text" :label="__('Text')"/>

    <x-forms.text-group wire:model="form.price" name="price" :label="__('Price')"
                        required
                        type="number"></x-forms.text-group>


    <x-forms.select-group wire:model="form.currency" name="currency" :label="__('Currency')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$currencies" type="text">
    </x-forms.select-group>


    @if($model->exists)
        <hr>
        <div class="row">
            <div class="col-md-2">
                @lang('Gallery')

            </div>
            <div class="col-md-10">
                <x-utils.media-library
                    :model="$model"
                ></x-utils.media-library>
            </div>
        </div>
    @endif
</div>

