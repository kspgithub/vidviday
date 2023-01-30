<div class="form-check form-switch"
     x-data="publishable({checked: {{$model->export ? 'true' : 'false'}}, name: 'export', url: '{{$updateUrl}}'})">
    <input class="form-check-input" type="checkbox" id="model-{{$model->id}}"
           x-model="checked" x-on:change="change"
           x-ref="checkboxEl"
        {{$model->export ? 'checked': ''}}
    >
    <label class="form-check-label" for="model-{{$model->id}}"></label>
</div>
