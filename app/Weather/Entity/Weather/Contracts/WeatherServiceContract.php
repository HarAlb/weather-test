<?php

namespace App\Weather\Entity\Weather\Contracts;

use App\Models\City;
use App\Models\User;
use App\Weather\Entity\Weather\DTO\CitiesWeatherDTO;

interface WeatherServiceContract
{
    public function getFromApiByUser(User $user): CitiesWeatherDTO;

    public function getByCity(City $city);
}
