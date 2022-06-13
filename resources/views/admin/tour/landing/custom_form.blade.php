<div>

    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model="form.title" name="title" :label="__('Title')" :required-locales="$tour->locales" />

    <x-forms.textarea-loc-group wire:model="form.description" name="description" :label="__('Description')"/>

</div>

