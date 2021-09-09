<div>
    <x-forms.text-group wire:model.lazy="name" :label="__('Name')" required/>
    <x-forms.text-group wire:model.lazy="email" :label="__('Email')" required/>
    <x-forms.textarea-group wire:model.lazy="text" :label="__('Text')" required/>

    <a href="#" class="btn btn-primary me-2" wire:loading.class="disabled"
       wire:click.prevent="saveItem()">@lang('Save')</a>
    <a href="#" class="btn btn-secondary" wire:click.prevent="cancelEdit()">@lang('Cancel')</a>

</div>
