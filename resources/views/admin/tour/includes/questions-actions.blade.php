<a href="#" class="btn btn-sm btn-outline-primary m-1"
   wire:click.prevent="createItem({{$model->id}})" title="Відповісти"><i class="fa fa-comment"></i></a>

@if($model->status === \App\Models\TourQuestion::STATUS_NEW)
    <a href="#" class="btn btn-sm btn-outline-success m-1"
       wire:click.prevent="publishItem({{$model->id}})" title="Опублікувати"><i class="fa fa-check"></i></a>

@endif
<a href="#" class="btn btn-sm btn-outline-danger m-1"
   wire:click.prevent="blockItem({{$model->id}})" title="Заблокувати"><i class="fa fa-ban"></i></a>


<a href="#" class="btn btn-sm btn-outline-danger m-1"
   wire:click.prevent="deleteId({{$model->id}})" title="Видалити"><i class="fa fa-trash"></i></a>
