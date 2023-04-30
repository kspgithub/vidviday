<x-bootstrap.card>
    <x-slot name="body">

        <x-forms.translation-switch/>

        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $item->getTranslations('title'))"
                                required></x-forms.text-loc-group>

        <x-forms.text-loc-group name="slug" :label="__('Slug')"
                                :value="old('slug', $item->getTranslations('slug'))"
                                help="наприклад: /populyarni-turi"
        ></x-forms.text-loc-group>

        <x-forms.text-group name="class_name" :label="__('Class')"
                                :value="old('class_name', $item->class_name)"
        ></x-forms.text-group>

        <x-forms.select-group name="page_id" :label="__('Page')"
                              :value="old('page_id', $item->model_type === App\Models\Page::class ? $item->model_id : null)"
                              :options="$pages"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>

        <x-forms.select-group name="tour_group_id" :label="__('Category')"
                              :value="old('tour_group_id', $item->model_type === App\Models\TourGroup::class ? $item->model_id : null)"
                              :options="$categories"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>

        <x-forms.select-group name="place_id" :label="__('Place')"
                              :value="old('place_id', $item->model_type === App\Models\Place::class ? $item->model_id : null)"
                              :options="$places"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>

        <x-forms.select-group name="event_item_id" :label="__('Event')"
                              :value="old('event_item_id', $item->model_type === App\Models\EventItem::class ? $item->model_id : null)"
                              :options="$events"
        >
            <option value="">Не вибрано</option>
        </x-forms.select-group>

        @if($item->parent_id > 0)
            <x-forms.radio-group name="side" :label="__('Column')"
                                 :value="old('title', $item->side)"></x-forms.radio-group>
        @endif
        <input type="hidden" name="parent_id" value="{{$item->parent_id}}">

        <x-forms.switch-group name="published" :label="__('Published')" :active="$item->published"/>
    </x-slot>
</x-bootstrap.card>

