<?php

namespace App\Repositories;

use App\Interfaces\EmployeeJobRepositoryInterface;
use App\Models\EmployeeJob;

class EmployeeJobRepository implements EmployeeJobRepositoryInterface
{
    public function __construct(
        private EmployeeJob $model
    ) {}

    public function getAll()
    {
        return $this->model->with("employees");
    }
}