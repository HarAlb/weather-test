<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = [
        'temp',
        'city_id',
        'temp_min',
        'temp_max',
        'humidity',
        'date'
    ];
}
