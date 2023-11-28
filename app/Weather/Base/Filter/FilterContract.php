<?php

namespace App\Weather\Base\Filter;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface FilterContract
{
    public function filter(Builder $builder): void;
}
