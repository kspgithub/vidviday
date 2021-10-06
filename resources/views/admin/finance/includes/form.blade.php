<x-forms.select-group name="type_id" :label="__('Type')" :options="$types" :value="$model->type_id">
    <option value="">Не вибрано</option>
</x-forms.select-group>

<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $model->title)"
                    required></x-forms.text-group>
<x-forms.editor-group name="text" :label="__('Description')" :value="old('text', $model->text)"></x-forms.editor-group>
<x-forms.switch-group name="published" :label="__('Published')" :active="$model->published"></x-forms.switch-group>

{{--@if($model->id > 0)--}}
{{--    <hr>--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-2">--}}
{{--            @lang('Зображення')--}}
{{--        </div>--}}
{{--        <div class="col-md-10">--}}
{{--            <x-utils.media-library--}}
{{--                :store-url="route('admin.media.store', ['model_type'=>get_class($model), 'model_id'=>$model->id])"--}}
{{--                :destroy-url="route('admin.media.destroy', 0)"--}}
{{--                :update-url="route('admin.media.update', 0)"--}}
{{--                :items="$model->getMedia()"--}}
{{--            ></x-utils.media-library>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--@else--}}
{{--    <x-forms.files-group name="media[]" id="media" label="Зображення" multiple accept=".jpg,.jpeg,.png"/>--}}
{{--@endif--}}
