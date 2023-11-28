<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = file_get_contents(__DIR__ . '/cities.json');
        $cities = json_decode($cities, true);
        foreach (array_chunk($cities, 1000) as $chunkedCities) {
            City::query()->insert(array_map(fn ($item) => [
                'name' => $item['name'],
                'country' => $item['country'],
                'latitude' => $item['lat'],
                'longitude' => $item['lon'],
            ], $chunkedCities));
        }
    }
}
