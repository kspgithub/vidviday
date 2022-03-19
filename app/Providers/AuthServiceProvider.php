<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\TourSchedule;
use App\Policies\OrderPolicy;
use App\Policies\TourSchedulePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        TourSchedule::class => TourSchedulePolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('order-admin-comments', [OrderPolicy::class, 'adminComments']);
        Gate::define('order-duty-comments', [OrderPolicy::class, 'dutyComments']);
        //
    }
}
