<div class="form-check form-switch">
    <input class="form-check-input" wire:change="publish({{$model->id}}, $event.target.checked)" type="checkbox" id="model-{{$model->id}}" {{$model->published ? 'checked' : ''}}>
    <label class="form-check-label" for="model-{{$model->id}}"></label>
</div>

