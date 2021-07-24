<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Faq')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.text-group name="section" :label="__('section')" :value="old('section', $faqitem->section)" maxlength="100" required ></x-forms.text-group>

        <x-forms.text-group name="question" :label="__('question')" :value="old('question', $faqitem->question)" maxlength="100" required ></x-forms.text-group>

        <x-forms.text-group name="answer" :label="__('answer')" :value="old('answer', $faqitem->answer)" maxlength="100" ></x-forms.text-group>

    </x-slot>

</x-bootstrap.card>

