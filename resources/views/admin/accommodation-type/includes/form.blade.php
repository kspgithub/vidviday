
<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $type->title)" maxlength="100" required ></x-forms.text-group>
<x-forms.textarea-group name="description" :label="__('Description')" :value="old('description', $type->description)" maxlength="500" required ></x-forms.textarea-group>

<x-forms.text-group name="slug" :label="__('Key')" :value="old('slug', $type->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>
