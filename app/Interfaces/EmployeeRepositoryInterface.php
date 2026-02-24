<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface
{
    public function getAll(): Collection;
}