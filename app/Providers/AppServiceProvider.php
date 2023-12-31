<?php

namespace App\Providers;

use App\Models\AgencySubscription;
use App\Models\Order;
use App\Models\OrderNote;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\TourVoting;
use App\Models\UserQuestion;
use App\Models\UserSubscription;
use App\Observers\AgencySubscriptionObserver;
use App\Observers\OrderNoteObserver;
use App\Observers\OrderObserver;
use App\Observers\PageObserver;
use App\Observers\TestimonialObserver;
use App\Observers\TourObserver;
use App\Observers\TourVotingObserver;
use App\Observers\UserQuestionObserver;
use App\Observers\UserSubscriptionObserver;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Models\VisualOption;
use Storage;

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
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->singleton('seo-buttons', fn($app) => new Repository($app['config']->get('buttons')));
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

        Builder::macro('random', function ($count = 1) {
            $q = $this->inRandomOrder()->limit($count);
            return $count === 1 ? $q->firstOrNew() : $q->get();
        });

        // Observers
        Order::observe(OrderObserver::class);
        OrderNote::observe(OrderNoteObserver::class);
        UserQuestion::observe(UserQuestionObserver::class);
        UserSubscription::observe(UserSubscriptionObserver::class);
        AgencySubscription::observe(AgencySubscriptionObserver::class);
        Tour::observe(TourObserver::class);
        TourVoting::observe(TourVotingObserver::class);
        Page::observe(PageObserver::class);
        Testimonial::observe(TestimonialObserver::class);

        // Marcos
        Request::macro('isAdmin', fn() => $this->segment(1) === 'admin');

        $giftImage = VisualOption::where('key', 'gift_image')->first();
        $giftImageUrl = $giftImage->value ? Storage::url($giftImage->value) : '/img/gift-certificate.jpg';
        View::share('giftImage', asset($giftImageUrl));
    }
}
