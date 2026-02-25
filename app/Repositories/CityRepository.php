<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(
        private City $model
    ) {}

    public function getAll(): Collection
    {
        return $this->model
            ->orderBy('name')
            ->get();
    }
}