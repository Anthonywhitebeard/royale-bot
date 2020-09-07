<?php

namespace App\Providers;

use App\Models\BattlePlayer;
use App\Observers\BattlePlayerObserver;
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
        \App::setLocale(env('APP_LOCALE'));
        $this->app->singleton(Api::class);
        $this->app->singleton(TelegramSender::class);

        BattlePlayer::observe(BattlePlayerObserver::class);
    }
}
