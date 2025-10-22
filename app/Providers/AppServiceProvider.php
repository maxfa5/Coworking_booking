<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User; 

use App\Models\Building;
class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination::default');
        Gate::define('destroy-building', function (User $user, building $building){
            return $user->is_super OR $building->city->name !='Москва';
        });
    
        Gate::define('edit-building', function (User $user, building $building){
            return $user->is_super OR $building->city->name !='Москва';
        });
        Gate::define('create-building', function(User $user, building $building){
            return $user->is_super OR $building->city->name !='Москва';
        });
    }
}
