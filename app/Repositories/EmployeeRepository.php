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

    public function getById(int $id): Employee
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Employee
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Employee
    {
        $employee = $this->model->findOrFail($id);
        $employee->update($data);

        return $employee->fresh();
    }

    public function delete(int $id): bool
    {
        return (bool) $this->model->findOrFail($id)->delete();
    }

    public function existsById(int $id): bool
    {
        return $this->model->where('id', $id)->exists();
    }
}