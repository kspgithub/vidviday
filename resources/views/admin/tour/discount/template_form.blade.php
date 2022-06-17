<div>

    <x-forms.select-group wire:model="form.discount_id" name="discount_id" :label="__('Template')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$discounts" >
    </x-forms.select-group>

    @if($form['discount_id'] && $discount)
        <div>

            <x-forms.translation-switch/>

            <x-forms.html-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $discount->getTranslations('title'))"/>
        </div>
    @endif

</div>
