<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function __construct(
        private City $model
    ) {}

    public function getAll()
    {
        return $this->model->with("employees");
    }
}