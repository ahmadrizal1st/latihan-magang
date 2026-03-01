<?php

namespace App\Interfaces;

interface EmployeeJobRepositoryInterface
{
    /**
     * Get all employee jobs with their related data.
     */
    public function getAll();

    /**
     * Search employee jobs by name.
     */
    public function search(string $keyword);

    /**
     * Create a new employee job record.
     */
    public function create(array $data);

    /**
     * Update an existing employee job record by ID.
     */
    public function update($id, array $data);

    /**
     * Delete an employee job record by ID.
     */
    public function delete($id);
}