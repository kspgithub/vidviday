@switch($model->status)
    @case(\App\Models\UserQuestion::STATUS_NEW)
    <span class="badge bg-info">@lang('resume.new')</span>
    @break
    @case(\App\Models\UserQuestion::STATUS_RESOLVED)
    <span class="badge bg-success">@lang('resume.resolved')</span>
    @break
    @case(\App\Models\UserQuestion::STATUS_ARCHIVED)
    <span class="badge bg-danger">@lang('resume.archived')</span>
    @break
@endswitch
