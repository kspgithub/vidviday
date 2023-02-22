@props([
    'votings' => [],
])

<div class="sidebar-item testimonials vote">
    <div class="top-part b-border">
        <div class="title h3 title-icon">
            <img src="{{ asset('img/preloader.png') }}" data-img-src="icon/done.svg" alt="done">
            <span>@lang('tours-section.voting')</span>
        </div>
        <div class="spacer-xs"></div>
        <hr>
        <div class="spacer-xs"></div>
        <div class="text">@lang('tours-section.want-to-vote') - <b>{{$votings}} {{ trans_choice('tours-section.persons', $votings) }}</b></div>
        <div class="spacer-xs"></div>
        <form action="/">
            <label data-tooltip="@lang('forms.required')">
                <i>@lang('forms.your-name')*</i>
                <input type="text" name="name" required>
            </label>

            <label data-tooltip="@lang('forms.required')">
                <i>@lang('forms.your-phone')*</i>
                <input type="tel" name="tel" required>
            </label>

            <label>
                <i>@lang('forms.email')</i>
                <input type="text" name="email">
            </label>

            <x-seo-button key="tour.vote" class="btn type-1 btn-block open-popup" data-rel="thanks-popup">@lang('tours-section.vote')</x-seo-button>
        </form>
    </div>
</div>
