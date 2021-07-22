<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Badge')</h3>
    </x-slot>

    <x-slot name="body">

        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $badge->title)" maxlength="100" required ></x-forms.text-group>

        <x-forms.text-group type="color" class="form-control form-control-color" name="color" :label="__('Color')" :value="old('color', $badge->color)" maxlength="10" required ></x-forms.text-group>

        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $badge->slug)" maxlength="100" required ></x-forms.text-group>

    </x-slot>

</x-bootstrap.card>

