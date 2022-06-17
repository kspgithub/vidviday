<div>
    <x-forms.select-group wire:model="form.transport_id" name="transport_id" :label="__('Template')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$transports" >
    </x-forms.select-group>

    @if($form['transport_id'] && $transport)
        <div>

            <x-forms.translation-switch/>

            <x-forms.text-loc-group wire:model="form.title" name="title" :label="__('Prefix')" :required-locales="$tour->locales" />


            <x-forms.html-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $transport->getTranslations('title'))"/>

            <x-forms.html-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $transport->getTranslations('text'))"/>
        </div>
    @endif

</div>
