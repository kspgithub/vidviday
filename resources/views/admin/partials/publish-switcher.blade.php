<div class="form-check form-switch">
    <input class="form-check-input"
           type="checkbox"
           id="model-{{$model->id}}"
           wire:model="published"
           wire:change="update()"
    >
    <label class="form-check-label" for="model-{{$model->id}}"></label>
</div>
