<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Testimonial')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.text-group name="name" :label="__('Name')" :value="old('name', $testimonial->name)"></x-forms.text-group>

        <x-forms.text-group name="email" :label="__('Email')" :value="old('email', $testimonial->email)"></x-forms.text-group>

        <x-forms.textarea-group name="text" :label="__('Text')" :value="old('text', $testimonial->text)"></x-forms.textarea-group>

        <x-forms.datepicker-group name="created_at" :label="__('Created At')" :value="old('created_at', $testimonial->created_at?->format('d.m.Y'))"></x-forms.datepicker-group>

    </x-slot>

</x-bootstrap.card>
