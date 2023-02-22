<div>

    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model.defer="form.title" name="title" :label="__('Title')"
                            :required-locales="$tour->locales"/>

    <x-forms.textarea-loc-group wire:model.defer="form.description" name="description" :label="__('Description')"/>

    <x-forms.text-group wire:model="form.time" name="time" :label="__('Time')"/>

    <div>
        <livewire:location-group :model="$model"
                                 :lat="$form['lat']"
                                 :lng="$form['lng']"
        />
    </div>
</div>

