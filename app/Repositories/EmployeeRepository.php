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
     *
     * @return \Illuminate\Database\Eloquent\Builder
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
     * Find a single employee by ID with all related data.
     *
     * @param  int|string  $id
     * @return \App\Models\Employee
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findById($id)
    {
        return $this->model->with([
            'employeeJob',
            'province',
            'city',
            'district',
            'village',
            'postalCode',
        ])->findOrFail($id);
    }

    /**
     * Search employees by name or NIP.
     *
     * @param  string  $keyword
     * @return \Illuminate\Database\Eloquent\Collection
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
     *
     * @param  array  $data
     * @return \App\Models\Employee
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing employee record by ID.
     *
     * @param  int|string  $id
     * @param  array       $data
     * @return \App\Models\Employee
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update($id, array $data)
    {
        $employee = $this->model->findOrFail($id);
        $employee->update($data);
        return $employee;
    }

    /**
     * Delete an employee record by ID.
     *
     * @param  int|string  $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}