@props(['item'=>new \App\Models\Recommendation(), 'hidden'=>false])
<div class="review {{$hidden ? 'hidden' : ''}}">
    <div class="review-header">
        <div class="review-img">
            <img loading="lazy" data-img-src="{{$item->avatar_url}}" data-img-src="{{$item->avatar_url}}" alt="user">
        </div>
        <div class="review-title">
            <span class="h4">{{$item->name}}</span>
            <span class="text text-sm">{{$item->company}}</span>
        </div>
    </div>
    <div v-is="'sidebar-more-text'">
        {!! $item->text !!}
    </div>
</div>
