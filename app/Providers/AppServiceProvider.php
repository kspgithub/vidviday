<?php

namespace App\Providers;

use App\Models\AgencySubscription;
use App\Models\Order;
use App\Models\Page;
use App\Models\QuestionType;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourVoting;
use App\Models\UserQuestion;
use App\Models\UserSubscription;
use App\Observers\AgencySubscriptionObserver;
use App\Observers\OrderObserver;
use App\Observers\PageObserver;
use App\Observers\TestimonialObserver;
use App\Observers\TourObserver;
use App\Observers\TourVotingObserver;
use App\Observers\UserQuestionObserver;
use App\Observers\UserSubscriptionObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(125);

        Paginator::useBootstrap();

        View::share('questionTypes', QuestionType::query()->published()->get());

        Builder::macro('random', function ($count = 1) {
            $q = $this->inRandomOrder()->limit($count);
            return $count === 1 ? $q->first() : $q->get();
        });

        // Observers
        Order::observe(OrderObserver::class);
        UserQuestion::observe(UserQuestionObserver::class);
        UserSubscription::observe(UserSubscriptionObserver::class);
        AgencySubscription::observe(AgencySubscriptionObserver::class);
        Tour::observe(TourObserver::class);
        TourVoting::observe(TourVotingObserver::class);
        Page::observe(PageObserver::class);
        Testimonial::observe(TestimonialObserver::class);
    }
}
