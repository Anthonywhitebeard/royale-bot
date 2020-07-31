<?php

namespace App\Providers;

use App\Services\EventHandlers\EventHandler;
use Illuminate\Support\ServiceProvider;
use Telegram\Bot\Api;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(EventHandler::class)
            ->needs(Api::class)
            ->give(Api::class);
        $this->app->singleton(Api::class);
    }
}
