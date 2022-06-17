<div>

    <x-forms.select-group wire:model="form.landing_id" name="landing_id" :label="__('Template')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/landings/select-box"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'landing_id' => $form['landing_id'] ?? 0,
                          ]"
                          :options="$landings" >
    </x-forms.select-group>

    @if($form['landing_id'] && $landing)
        <div>

            <x-forms.translation-switch/>

            <x-forms.html-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $landing->getTranslations('title'))"/>

            <x-forms.html-loc-group name="description" :label="__('Description')"
                                    :value="old('description', $landing->getTranslations('description'))"/>
        </div>
    @endif

</div>
