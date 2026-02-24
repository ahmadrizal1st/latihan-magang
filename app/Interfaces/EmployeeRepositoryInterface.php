<?php

namespace App\Interfaces;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Employee;

    public function create(array $employee): Employee;

    function update(int $id, array $data): Employee;
    
    public function delete(int $id): bool;

    public function existsById(int $id): bool;
}