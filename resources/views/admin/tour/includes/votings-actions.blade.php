@if($model->status === \App\Models\TourVoting::STATUS_NEW)
    <a href="#" class="btn btn-sm btn-outline-success m-1"
       wire:click.prevent="publishItem({{$model->id}})" title="Опублікувати"><i class="fa fa-check"></i></a>

@endif
@if($model->status !== \App\Models\TourVoting::STATUS_BLOCKED)
    <a href="#" class="btn btn-sm btn-outline-danger m-1"
       wire:click.prevent="blockItem({{$model->id}})" title="Заблокувати"><i class="fa fa-lock"></i></a>
@else
    <a href="#" class="btn btn-sm btn-outline-warning m-1"
       wire:click.prevent="publishItem({{$model->id}})" title="Разблокувати"><i class="fa fa-unlock"></i></a>
@endif

<a href="#deleteModal" class="btn btn-sm btn-outline-danger m-1" data-bs-toggle="modal"
   wire:click.prevent="deleteId({{$model->id}})" title="Видалити"><i class="fa fa-trash"></i></a>
