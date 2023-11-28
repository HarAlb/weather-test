<?php

namespace App\Weather\Entity\Weather\Jobs;

use App\Models\Weather;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UpdateWeather implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Collection $updateWeathers)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->updateWeathers->each(function ($weather) {
            Weather::query()->updateOrCreate(
                $weather->toArray(),
                [
                    'city_id' => $weather->city_id,
                    'date' => $weather->date
                ]
            );
        });
    }
}
