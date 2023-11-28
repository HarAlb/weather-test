<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Weather\Entity\Weather\Contracts\WeatherServiceContract;
use App\Weather\Entity\Weather\Jobs\UpdateWeather;

class WeatherController extends Controller
{
    public function index(WeatherServiceContract $contract)
    {
        $citiesByWhether = $contract->getFromApiByUser(auth()->user());

        if($citiesByWhether->getUpdateWeathers()->isNotEmpty()){
            UpdateWeather::dispatch($citiesByWhether->getUpdateWeathers());
        }
        // Ответ нужно генерировать используя resource так как у нашей системе есть места присвоивание
        return $citiesByWhether->getCities();
    }
}
