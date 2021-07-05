@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'options'=>[],
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])

<div class="form-group row mb-3">
    <label for="{{$name}}-editor" class="{{$labelCol}} col-form-label">@lang($label)@if(isset($attributes['required'])) <span class="text-danger">*</span>@endif</label>

    <div class="{{$inputCol}} ">
        <textarea id="{{$name}}-editor"
                  name="{{$name}}"
                  placeholder="{{$placeholder}}"
                      {{ $attributes->except('required')->merge(['class' => 'form-control text-editor']) }}
        >{!! $value !!}</textarea>

        @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror

    </div>
</div><!--form-group-->

@push('after-scripts')
    <script>
        tinymce.init({
            selector: '#{{$name}}-editor',
            language: '{{app()->getLocale()}}',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | preview media fullpage | ' +
                'forecolor backcolor emoticons | help',
            menubar: 'favs file edit view insert format tools table help',
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;

                xhr.open('POST', '{{route('admin.editor.upload')}}');
                xhr.setRequestHeader('X-CSRF-TOKEN', document.head.querySelector('meta[name="csrf-token"]').content);

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }
            //content_css: 'css/content.css'
        });
    </script>
@endpush

