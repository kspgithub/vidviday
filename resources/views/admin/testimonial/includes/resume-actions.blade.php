<a href="{{ route('admin.testimonial.resume.edit', $model) }}" class="btn btn-sm btn-outline-primary m-1" title="Редагувати"><i class="fa fa-eye"></i></a>

@if($model->status === \App\Models\UserQuestion::STATUS_NEW)
    <a href="#" class="btn btn-sm btn-outline-success m-1"
       wire:click.prevent="publishItem({{$model->id}})" title="Обработано"><i class="fa fa-check"></i></a>
    <a href="#" class="btn btn-sm btn-outline-danger m-1"
       wire:click.prevent="blockItem({{$model->id}})" title="Отложить"><i class="fa fa-trash"></i></a>
@endif

@if($model->status !== \App\Models\UserQuestion::STATUS_NEW)
    <a href="#" class="btn btn-sm btn-outline-warning m-1"
       wire:click.prevent="undoItem({{$model->id}})" title="Вернуть"><i class="fa fa-undo"></i></a>
@endif

{{-- 
<a href="#deleteModal" class="btn btn-sm btn-outline-danger m-1" data-bs-toggle="modal"
   wire:click.prevent="deleteId({{$model->id}})" title="Видалити"><i class="fa fa-trash"></i></a> --}}
