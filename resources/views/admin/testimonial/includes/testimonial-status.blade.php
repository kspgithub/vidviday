@switch($model->status)
    @case(\App\Models\TourQuestion::STATUS_NEW)
    <span class="badge bg-info">new</span>
    @break
    @case(\App\Models\TourQuestion::STATUS_PUBLISHED)
    <span class="badge bg-success">published</span>
    @break
    @case(\App\Models\TourQuestion::STATUS_BLOCKED)
    <span class="badge bg-danger">blocked</span>
    @break
@endswitch

@if($model->imported == 1)
    <span class="badge bg-warning">imported</span>
@endif