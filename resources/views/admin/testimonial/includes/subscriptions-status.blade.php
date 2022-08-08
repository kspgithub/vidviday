@switch($model->status)
    @case(\App\Models\UserSubscription::STATUS_ACTIVE)
    <span class="badge bg-success">active</span>
    @break
    @case(\App\Models\UserSubscription::STATUS_INACTIVE)
    <span class="badge bg-danger">inactive</span>
    @break
@endswitch
