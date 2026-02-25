<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CityRepositoryInterface
{
    public function getAll(): Collection;
}