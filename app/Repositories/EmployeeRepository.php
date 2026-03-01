<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(
        private Employee $model
    ) {}

    /**
     * Get all employees with their related data.
     */
    public function getAll()
    {
        return $this->model->with([
            'employeeJob',
            'province',
            'city',
            'district',
            'village',
            'postalCode',
        ]);
    }

    /**
     * Find by id employees with their related data.
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Search employees by name or NIP.
     */
    public function search(string $keyword)
    {
        return Employee::whereLike('name', "%{$keyword}%")
            ->orWhereLike('nip', "%{$keyword}%")
            ->select('id', 'name', 'nip', 'job_id')
            ->with('employeeJob')
            ->orderBy('name')
            ->get();
    }

    /**
     * Create a new employee record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing employee record by ID.
     */
    public function update($id, array $data)
    {
        $employee = $this->model->findOrFail($id);
        $employee->update($data);
        return $employee;
    }

    /**
     * Delete an employee record by ID.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}