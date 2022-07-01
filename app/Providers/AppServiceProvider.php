<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\TourVoting;
use App\Models\UserQuestion;
use App\Observers\OrderObserver;
use App\Observers\TourVotingObserver;
use App\Observers\UserQuestionObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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

        // Observers
        Order::observe(OrderObserver::class);
        UserQuestion::observe(UserQuestionObserver::class);
        TourVoting::observe(TourVotingObserver::class);
    }
}
