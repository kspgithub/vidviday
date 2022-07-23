@switch($model->status)
    @case(\App\Models\TourVoting::STATUS_NEW)
    <span class="badge bg-info">new</span>
    @break
    @case(\App\Models\TourVoting::STATUS_PUBLISHED)
    <span class="badge bg-success">published</span>
    @break
    @case(\App\Models\TourVoting::STATUS_BLOCKED)
    <span class="badge bg-danger">blocked</span>
    @break
@endswitch
