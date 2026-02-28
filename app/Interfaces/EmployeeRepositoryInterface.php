<?php

namespace App\Interfaces;

interface EmployeeRepositoryInterface
{
    /**
     * Get all employees with their related data.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getAll();

    /**
     * Find a single employee by ID with all related data.
     *
     * @param  int|string  $id
     * @return \App\Models\Employee
     */
    public function findById($id);

    /**
     * Search employees by name or NIP.
     *
     * @param  string  $keyword
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(string $keyword);

    /**
     * Create a new employee record.
     *
     * @param  array  $data
     * @return \App\Models\Employee
     */
    public function create(array $data);

    /**
     * Update an existing employee record by ID.
     *
     * @param  int|string  $id
     * @param  array       $data
     * @return \App\Models\Employee
     */
    public function update($id, array $data);

    /**
     * Delete an employee record by ID.
     *
     * @param  int|string  $id
     * @return int
     */
    public function delete($id);
}