<?php

namespace App\Weather\Entity\Weather\Providers;

use App\Weather\Entity\Weather\Contracts\WeatherServiceContract;
use App\Weather\Entity\Weather\Strategies\OpenWeatherStrategy;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Регистрация любых служб приложения.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherServiceContract::class, OpenWeatherStrategy::class);
    }
}
