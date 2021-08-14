<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $menu->title)" maxlength="100" required ></x-forms.text-group>
<x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $menu->slug)" maxlength="100" ></x-forms.text-group>

<x-forms.textarea-group name="description" :label="__('Description')" :value="old('description', $menu->description)" ></x-forms.textarea-group>

