<?php

namespace App\Providers;

use App\Services\AdminService;
use App\Services\Implement\AdminServiceImplement;
use App\Services\Implement\KelahiranServiceImplement;
use App\Services\Implement\PernikahanServiceImplement;
use App\Services\Implement\PushNotificationServiceImplement;
use App\Services\Implement\SektorServiceImplement;
use App\Services\Implement\UnitServiceImplement;
use App\Services\Implement\UserServiceImplement;
use App\Services\KelahiranService;
use App\Services\PernikahanService;
use App\Services\PushNotificationService;
use App\Services\SektorService;
use App\Services\UnitService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
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
        $this->app->bind(AdminService::class, function(Application $app){
            return $app->make(AdminServiceImplement::class);
        });
        $this->app->bind(SektorService::class, function(Application $app){
            return $app->make(SektorServiceImplement::class);
        });
        $this->app->bind(UnitService::class, function(Application $app){
            return $app->make(UnitServiceImplement::class);
        });
        $this->app->bind(PernikahanService::class, function(Application $app){
            return $app->make(PernikahanServiceImplement::class);
        });
        $this->app->bind(KelahiranService::class, function(Application $app){
            return $app->make(KelahiranServiceImplement::class);
        });
        $this->app->bind(UserService::class, function(Application $app){
            return $app->make(UserServiceImplement::class);
        });
        $this->app->bind(PushNotificationService::class, function(Application $app){
            return $app->make(PushNotificationServiceImplement::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
