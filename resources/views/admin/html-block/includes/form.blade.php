<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $htmlBlock->title)" maxlength="100"
                    required></x-forms.text-group>
<x-forms.text-group name="slug" :label="__('Key')" :value="old('slug', $htmlBlock->slug)"
                    maxlength="100"></x-forms.text-group>

<x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $htmlBlock->text)"></x-forms.editor-group>
