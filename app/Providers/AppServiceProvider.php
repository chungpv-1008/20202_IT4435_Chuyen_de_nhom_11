<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Application\ApplicationRepositoryInterface;
use App\Repositories\Application\ApplicationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            ApplicationRepositoryInterface::class,
            ApplicationRepository::class
        );

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
