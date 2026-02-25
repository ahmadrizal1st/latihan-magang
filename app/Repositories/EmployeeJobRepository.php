<?php

namespace App\Repositories;

use App\Interfaces\EmployeeJobRepositoryInterface;
use App\Models\EmployeeJob;
use Illuminate\Database\Eloquent\Collection;

class EmployeeJobRepository implements EmployeeJobRepositoryInterface
{
    public function __construct(
        private EmployeeJob $model
    ) {}

    public function getAll(): Collection
    {
        return $this->model
            ->orderBy('name')
            ->get();
    }
}