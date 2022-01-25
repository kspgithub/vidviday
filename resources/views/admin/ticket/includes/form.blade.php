<div class="card">
    <div class="card-body">
        <x-forms.translation-switch/>
        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $ticket->getTranslations('title'))" maxlength="100"
                                required></x-forms.text-loc-group>
        {{--        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $ticket->slug)" maxlength="100"--}}
        {{--                            :help="__('Leave blank for automatic generation')"></x-forms.text-group>--}}
        <x-forms.editor-loc-group name="text" :label="__('Text')" :value="old('text', $ticket->getTranslations('text'))"
                                  required></x-forms.editor-loc-group>
        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $ticket->price)"
                            required
                            type="number"></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $ticket->currency)"
                              :options="$currencies" type="text"></x-forms.select-group>

        <x-forms.select-group name="region_id" :label="__('Region')" :value="old('region_id', $ticket->region_id)"
                              :options="$regions" type="number"></x-forms.select-group>

        <x-forms.switch-group name="published" :label="__('Published')"
                              :active="$ticket->published"></x-forms.switch-group>
    </div>
</div>
