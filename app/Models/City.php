<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    protected $fillable = [
        'name',
        'country',
        'latitude',
        'longitude'
    ];

    public $timestamps = false;

    public function weather(): HasOne
    {
        return $this->hasOne(Weather::class);
    }

    public function weathers(): HasMany
    {
        return $this->hasMany(Weather::class);
    }
}
