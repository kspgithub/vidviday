<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $model->title)"
                    required></x-forms.text-group>
<x-forms.editor-group name="text" :label="__('Description')" :value="old('text', $model->text)"
                      required></x-forms.editor-group>

<input type="hidden" name="published" value="1">

@if($model->id > 0)
    <hr>
    <div class="row">
        <div class="col-md-2">
            @lang('Gallery')

        </div>
        <div class="col-md-10">
            <x-utils.media-library
                :store-url="route('admin.media.store', ['model_type'=>get_class($model), 'model_id'=>$model->id])"
                :destroy-url="route('admin.media.destroy', 0)"
                :update-url="route('admin.media.update', 0)"
                :items="$model->getMedia()"
            ></x-utils.media-library>
        </div>
    </div>


@else
    <x-forms.files-group name="media[]" id="media" label="Зображення" multiple accept=".jpg,.jpeg,.png"/>
@endif
