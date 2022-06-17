<div>
    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/regions?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'region_id' => $form['region_id'] ?? 0,
                              'ticket_id' => $form['ticket_id'] ?? 0,
                           ]"
                          :options="$regions">
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.ticket_id" name="ticket_id" :label="__('Template')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/tickets/select-box"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'region_id' => $form['region_id'] ?? 0,
                              'ticket_id' => $form['ticket_id'] ?? 0,
                          ]"
                          :options="$tickets" >
    </x-forms.select-group>

    @if($form['ticket_id'] && $ticket)
        <div>

            <x-forms.translation-switch/>

            <x-forms.html-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $ticket->getTranslations('title'))"/>

            <x-forms.html-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $ticket->getTranslations('text'))"/>
        </div>
    @endif

</div>
