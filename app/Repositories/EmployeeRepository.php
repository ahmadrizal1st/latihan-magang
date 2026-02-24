<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(
        private Employee $model
    ) {}

    public function getAll(): Collection
    {
        return $this->model
            ->orderBy('name')
            ->get();
    }
}