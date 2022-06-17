<div class="social style-1">
    <span>{{__('Поділитись')}}:</span>

    <x-tour.share :share-url="route('tour-group.show', $group)" :share-title="$group->title"/>
</div>
