<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Resume')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.text-group name="name" :label="__('Name')" :value="old('name', $testimonial->name)"></x-forms.text-group>

        <x-forms.text-group name="email" :label="__('Email')" :value="old('email', $testimonial->email)"></x-forms.text-group>

        <x-forms.textarea-group name="text" :label="__('Text')" :value="old('text', $testimonial->comment)"></x-forms.textarea-group>

        <div class="form-group row mb-3">
            <div for="text" class="col-md-2 col-form-label">
                Файл
            </div>
        
            <div class="col-md-10">
                <x-utils.link
                    :text="$testimonial->attachment_name"
                    :href="asset($testimonial->attachment_url)"
                    :target="'download'"
                ></x-utils.link>
            </div>
        </div>

        <x-forms.datepicker-group name="created_at" :label="__('Created At')"
                                  :value="old('created_at', $testimonial->created_at?->format('d.m.Y H:i'))"
                                  :format="'d.m.Y H:i'"
                                  :time="'true'"
                                  :close-on-change="'false'"
        ></x-forms.datepicker-group>

    </x-slot>

</x-bootstrap.card>
