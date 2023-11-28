<?php

namespace App\Weather\Entity\City\Filter;


use App\Weather\Base\Filter\FilterContract;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

final class Filter implements FilterContract
{
    private ?string $search;

    public function __construct(Request $filterRequest)
    {
        $this->search = $filterRequest->search;
    }

    public function filter(Builder $builder): void
    {
        if ($this->getSearch()) {
            $search = "%{$this->getSearch()}%";
            $builder->where(function ($q) use ($search) {
                $q->where('cities.name', 'like', $search)
                    ->orWhere('cities.country', 'like', $search);
            });
        }
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }
}
