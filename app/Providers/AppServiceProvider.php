<?php

namespace App\Providers;

use App\Services\BattleProcess\BattleDriver;
use App\Services\EventHandlers\EventHandler;
use App\Services\TelegramSender;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
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
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(\Reliese\Coders\CodersServiceProvider::class);
        }
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
        $this->app->when(BattleDriver::class)
            ->needs(TelegramSender::class)
            ->give(TelegramSender::class);
        $this->app->singleton(TelegramSender::class);
    }
}
