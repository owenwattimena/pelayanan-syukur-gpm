<?php

namespace App\Providers;

use App\Repositories\AdminRepository;
use App\Repositories\Implement\AdminRepoImplement;
use App\Repositories\Implement\JemaatRepoImplement;
use App\Repositories\Implement\KelahiranRepoImplement;
use App\Repositories\Implement\PernikahanRepoImplement;
use App\Repositories\Implement\SektorRepoImplement;
use App\Repositories\Implement\UnitRepoImplement;
use App\Repositories\Implement\UserRepoImplement;
use App\Repositories\JemaatRepository;
use App\Repositories\KelahiranRepository;
use App\Repositories\PernikahanRepository;
use App\Repositories\SektorRepository;
use App\Repositories\UnitRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepository::class, function(Application $app){
            return $app->make(AdminRepoImplement::class);
        });
        $this->app->bind(SektorRepository::class, function(Application $app){
            return $app->make(SektorRepoImplement::class);
        });
        $this->app->bind(UnitRepository::class, function(Application $app){
            return $app->make(UnitRepoImplement::class);
        });
        $this->app->bind(PernikahanRepository::class, function(Application $app){
            return $app->make(PernikahanRepoImplement::class);
        });
        $this->app->bind(KelahiranRepository::class, function(Application $app){
            return $app->make(KelahiranRepoImplement::class);
        });
        $this->app->bind(UserRepository::class, function(Application $app){
            return $app->make(UserRepoImplement::class);
        });
        $this->app->bind(JemaatRepository::class, function(Application $app){
            return $app->make(JemaatRepoImplement::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
