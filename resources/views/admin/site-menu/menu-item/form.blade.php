<x-bootstrap.card>
    <x-slot name="body">

        <x-forms.translation-switch/>

        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $item->getTranslations('title'))"
                                required></x-forms.text-loc-group>

        <x-forms.text-loc-group name="slug" :label="__('Slug')"
                                :value="old('slug', $item->getTranslations('slug'))"
                                required
                                help="наприклад: /populyarni-turi"
        ></x-forms.text-loc-group>

        @if($item->parent_id > 0)
            <x-forms.radio-group name="side" :label="__('Column')"
                                 :value="old('title', $item->side)"></x-forms.radio-group>
        @endif
        <input type="hidden" name="parent_id" value="{{$item->parent_id}}">

        <x-forms.switch-group name="published" :label="__('Published')" :active="$item->published"/>
    </x-slot>
</x-bootstrap.card>

