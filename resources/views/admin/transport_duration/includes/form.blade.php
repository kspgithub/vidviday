<x-bootstrap.card>
    <x-slot name="body">
        <x-forms.translation-switch/>

        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $transportDuration->getTranslations('title'))" maxlength="100"
                                required></x-forms.text-loc-group>

        <x-forms.text-group name="value" :label="__('Value')"
                                :value="old('value', $transportDuration->value)" maxlength="100"
                                required></x-forms.text-group>


        <x-forms.switch-group name="published" :label="__('Published')" :active="$transportDuration->published"/>
    </x-slot>
</x-bootstrap.card>
