@props([
    'question'=>new \App\Models\TourQuestion(),
    'rating' => true,
])
<div class="review-item">
    <div class="spacer-xs"></div>
    <div class="review">
        <div class="review-header">
            <div class="review-img">
                @if(!empty($question->user) && !empty($question->user->avatar))
                    <img loading="lazy" src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{$question->user->avatar_url}}" alt="user">
                @else
                    <span class="full-size h4">{{$question->initials}}</span>
                @endif
            </div>
            <div class="review-title">
                <span class="h4">{{$question->name}}</span>
                <span class="text text-sm">{{$question->created_at?->format('d.m.Y')}}</span>
                <span class="text text-sm">{{$question->created_at?->format('H:i')}}</span>
                @if($rating && !$question->parent_id)
                    <x-tour.star-rating :rating="$question->rating"/>
                @endif

                <span class="text" v-is="'open-tour-question-form'"
                      :parent="{{$question->id}}">@lang('forms.reply')</span>

            </div>
        </div>
        <div class="text text-md">
            <p>@if($question->parent)<span class="label">{{$question->parent->name}}</span> @endif{{$question->text}}
            </p>
        </div>
    </div>
    @if(!$question->parent_id && $question->children->count() > 0)
        <div class="load-more-wrapp">
            <div class="show-more active">
                <span>{{__('common.hide-answers')}}</span>
                <span>{{ __('common.show-answers') }}</span>
            </div>
            <div class="more-info">
                @foreach($question->children as $child)
                    <x-tour.question :question="$child"/>
                @endforeach
            </div>
        </div>
    @elseif($question->children->count() > 0)
        @foreach($question->children as $child)
            <x-tour.question :question="$child"/>
        @endforeach
    @endif
</div>
