<?php

namespace App\Weather\Entity\Weather\Strategies;

use App\Models\City;
use App\Models\User;
use App\Weather\Entity\Weather\Contracts\WeatherServiceContract;
use App\Weather\Entity\Weather\DTO\CitiesWeatherDTO;
use RakibDevs\Weather\Weather;

final class OpenWeatherStrategy implements WeatherServiceContract
{
    // USED FOR CHANGE EXISTS ROWS WHEN EXPIRED THIS TIME
    // Notice: Write it by seconds
    const UPDATE_TIME = 3600;

    public function __construct(private readonly Weather $weather)
    {

    }

    public function getFromApiByUser(User $user): CitiesWeatherDTO
    {
        $cities = $user->cities()->with([
            'weather' => function ($q) {
                $q->whereRaw('updated_at >= \'' . date('Y-m-d H:i:s', strtotime('-' .  self::UPDATE_TIME . ' SECONDS')). '\'');
            }
        ])->select(['cities.id', 'latitude', 'longitude'])->get();

        $citiesDTO = new CitiesWeatherDTO();

        foreach ($cities as &$city) {
            if (!$city->weather) {
                $weater = $this->weather->getCurrentByCord((string)$city->latitude, (string)$city->longitude);
                $city->weather = new \App\Models\Weather([
                    'temp' => $weater->main->temp,
                    'temp_min' => $weater->main->temp_min,
                    'temp_max' => $weater->main->temp_max,
                    'humidity' => $weater->main->humidity,
                    'date' => date('Y-m-d'),
                    'city_id' => $city->id
                ]);
                $citiesDTO->addWeatherForUpdate($city->weather);
            }
            $citiesDTO->addCity($city);
        }

        return $citiesDTO;
    }

    public function updateWeathers()
    {

    }

    public function getByCity(City $city)
    {
        // TODO: Implement getByCity() method.
    }
}
