<?php

namespace App\Weather\Entity\Weather\DTO;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Support\Collection;

final class CitiesWeatherDTO
{
    private Collection $cities;
    private Collection $updateWeathers;

    public function __construct()
    {
        $this->cities = collect();
        $this->updateWeathers = collect();
    }

    public function addCity(City $city)
    {
        $this->cities->add($city);
    }

    /**
     * @return Collection<City>
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addWeatherForUpdate(Weather $weather)
    {
        $this->updateWeathers->add($weather);
    }

    /**
     * @return Collection<Weather>
     */
    public function getUpdateWeathers(): Collection
    {
        return $this->updateWeathers;
    }
}
