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

</div>

