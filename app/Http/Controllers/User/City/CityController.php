<?php

namespace App\Http\Controllers\User\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\UserCity;
use App\Weather\Entity\City\Filter\Filter;
use App\Weather\Entity\City\Requests\StoreRequest;

final class CityController extends Controller
{
    public function index(Filter $filter)
    {
        $cities = City::query();

        $filter->filter($cities);

        return response()->json($cities->paginate());
    }

    public function mine(Filter $filter)
    {
        $cities = auth()->user()->cities();

        $filter->filter($cities);

        return response()->json($cities->paginate());
    }

    public function store(StoreRequest $request)
    {
        $cities = array_map(fn ($item) => [
            'city_id' => (int) $item,
            'user_id' => auth()->user()->id
        ], $request->cities);
        UserCity::query()->where('user_id', auth()->user()->id)->delete();
        UserCity::query()->insert($cities);

        return response()->json(auth()->user()->cities()->paginate());
    }
}
